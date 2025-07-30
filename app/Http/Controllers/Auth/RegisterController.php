<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       return Validator::make($data, [
    'name' => ['required', 'regex:/^[А-Яа-яЁёA-Za-z\s\-]+$/u', 'max:255'],
    'surname' => ['required', 'regex:/^[А-Яа-яЁёA-Za-z\s\-]+$/u', 'max:255'],
    'username' => ['required', 'string', 'max:50', 'unique:users', 'regex:/^[a-zA-Z0-9_-]+$/'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'phone' => ['required', 'string', 'regex:/^\+?[0-9]{10,15}$/'],
    'password' => ['required', 'string', 'min:8', 'confirmed'],
    'agreement' => ['accepted'], 
], [
    'agreement.accepted' => 'Вы должны дать согласие на обработку персональных данных.', // ✅ свое сообщение
]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Склеиваем имя и фамилию
        $fullName = $data['name'] . ' ' . $data['surname'];

        // Создаем пользователя
        $user = User::create([
            'name' => $fullName,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username']
        ]);

        // Создаем профиль
        $user->profiles()->create([
            'user_id' => $user->id,
            'name'    => $fullName,
            'email'   => $data['email'],
            'phone'   => $data['phone'],
            'title'   => null,
            'address' => null,
            'comment' => null,
            'avatar'  => null,
        ]);

        return $user;
    }

    /**
     * Сразу после регистрации выполняем редирект и устанавливаем flash-сообщение
     */
    protected function registered(Request $request, $user) {
        return redirect()->route('user.index')
            ->with('success', 'Регистрация на сайте прошла успешно');
    }
}
