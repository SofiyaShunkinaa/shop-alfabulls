<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller {

    /**
     * Показывает список всех профилей
     *
     * @return \Illuminate\Http\Response
     */
public function index() {
    $user = auth()->user();

    // Если у пользователя ещё нет профилей — создаём первый
    if ($user->profiles()->count() === 0) {
        $user->profiles()->create([
            'name' => $user->name ?? '',
            'email' => $user->email ?? '',
            'phone' => $user->phone ?? '',
        ]);
    }

    $profiles = $user->profiles()->paginate(4);
    return view('user.profile.index', compact('profiles'));
}

    /**
     * Возвращает данные профиля в формате JSON
     *
     * @return \Illuminate\Http\Response
     */
    public function profile() {
        // TODO: здесь нужна какая-никакая проверка
        $profile = self::findOrFail();
        return response()->json($profile);
    }

    /**
     * Показывает форму для создания профиля
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('user.profile.create');
    }

    /**
     * Сохраняет новый профиль в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                'in:' . auth()->user()->id // проверяем, что user_id совпадает с текущим пользователем
            ],
            'title' => 'nullable|string|max:255',
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[А-Яа-яЁёA-Za-z\s\-]+$/u'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:profiles,email'
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^\+?[0-9]{10,15}$/'
            ],
            //'address' => 'required|string|max:255',
        ]);

        // Создаём профиль
        $profile = Profile::create($request->all());

        return redirect()
            ->route('user.index')
            ->with('success', 'Новый профиль успешно создан');
    }

    /**
     * Показывает информацию о профиле
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404); // это чужой профиль
        }
        return view('user.profile.show', compact('profile'));
    }

    /**
     * Показывает форму для редактирования профиля
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404); // это чужой профиль
        }
        return view('user.profile.edit', compact('profile'));
    }

    /**
     * Обновляет профиль (запись в таблице БД)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, Profile $profile)
{
    Log::info('--- [Profile Update] Начало обновления профиля ---');
    Log::info('ID профиля:', ['profile_id' => $profile->id]);
    Log::info('Входящие данные:', $request->all());

    $this->validate($request, [
        'user_id' => 'in:' . auth()->user()->id,
        'email' => [
            'required',
            'email',
            Rule::unique('profiles')->ignore($profile->id),
        ],
        'phone' => [
            'required',
            'string',
            'regex:/^\+?[0-9]{10,15}$/'
        ],
        'new_password' => 'nullable|min:8',
    ]);

    Log::info('--- [Profile Update] Валидация прошла успешно ---');

    // Обновляем профиль
    $updateResult = $profile->update($request->all());
    Log::info('Результат метода update():', ['success' => $updateResult]);

    Log::info('Данные профиля после update():', $profile->fresh()->toArray());

    // Если пользователь ввёл новый пароль — обновляем его
    if ($request->filled('new_password')) {
        Log::info('Обновляем пароль пользователя', ['user_id' => $request->user()->id]);
        $request->user()->update([
            'password' => Hash::make($request->input('new_password')),
        ]);
    } else {
        Log::info('Пароль не обновлялся (new_password пуст)');
    }

    Log::info('--- [Profile Update] Завершение метода ---');

    return redirect()
        ->route('user.index')
        ->with('success', 'Профиль был успешно отредактирован');
}

    /**
     * Обновляет аватар профиля
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request, Profile $profile)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($profile->avatar) {
            Storage::delete('public/'.$profile->avatar);
        }
    
        // Сохраняем новый аватар
        $path = $request->file('avatar')->store('avatars', 'public');
        $profile->update(['avatar' => $path]);
    
        return back()->with('success', 'Аватар обновлен');
    }

    /**
     * Удаляет профиль (запись в таблице БД)
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404); // это чужой профиль
        }
        $profile->delete();
        return redirect()
            ->route('user.profile.index')
            ->with('success', 'Профиль был успешно удален');
    }
}
