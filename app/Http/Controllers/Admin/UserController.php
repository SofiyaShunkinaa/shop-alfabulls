<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    /**
     * Показывает список всех пользователей
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::paginate(5);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Показывает форму для редактирования пользователя
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Обновляет данные пользователя в базе данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'sometimes|max:20',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'discount_percent' => 'sometimes|numeric',
            'bonus_points' => 'sometimes|numeric',
            'remove' => 'sometimes|boolean'
        ]);

        // Обновляем основные данные пользователя
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],            
            'discount_percent' => $validated['discount_percent'] ?? $user->discount_percent,
            'bonus_points' => $validated['bonus_points'] ?? $user->bonus_points
        ]);

        // Подготовка данных профиля
        $profileData = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'birthday' => $request->input('birthday'),
        ];

        // Обработка изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение, если оно есть
            if ($user->profiles->first() && $user->profiles->first()->avatar) {
                Storage::delete('public/' . $user->profiles->first()->avatar);
            }
            
            // Сохраняем новое изображение
            $path = $request->file('image')->store('avatars', 'public');
            $profileData['avatar'] = $path;
           
        } 
        
        if ($request->has('remove_image') && $request->remove_image) {
            // Удаляем изображение, если отмечен чекбокс
            if ($user->profiles->first() && $user->profiles->first()->avatar) {
                Storage::delete('public/' . $user->profiles->first()->avatar);
            }
            $profileData['avatar'] = null;
        }

        // Обновляем или создаем профиль
        if ($user->profiles()->first()) {
            $user->profiles()->first()->update($profileData);
        } else {
            $user->profiles()->create($profileData);
        }

        return redirect()->route('admin.user.index')
            ->with('success', 'Данные пользователя успешно обновлены');
    }

    /**
     * Возвращает объект валидатора с нужными нам правилами
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    private function validator(array $data, int $id) {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // проверка на уникальность email, исключая
                // этого пользователя по идентифкатору
                'unique:users,email,'.$id.',id',
            ],
        ];
        if (isset($data['change_password'])) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        return Validator::make($data, $rules);
    }

    public function searchUser(Request $request)
    {
        $query = $request->input('name');

        if (!$query) {
            $users = User::paginate(5);
        } else {
            $users = User::where('name', 'like', "%{$query}%")
                ->paginate(5);
        }

        return view('admin.user.part.table-rows', compact('users'));
    }
}
