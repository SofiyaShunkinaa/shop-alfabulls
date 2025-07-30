<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Сразу после входа выполняем редирект и устанавливаем flash-сообщение
     */
    protected function authenticated(Request $request, $user) {
        $route = 'user.index';
        $message = 'Вы успешно вошли в личный кабинет';
        if ($user->admin) {
            $route = 'admin.index';
            $message = 'Вы успешно вошли в панель управления';
        }
        return redirect()->route($route)
            ->with('success', $message);
    }

    /**
     * Сразу после выхода выполняем редирект и устанавливаем flash-сообщение
     */
    protected function loggedOut(Request $request) {
        return redirect()->route('user.login')
            ->with('success', 'Вы успешно вышли из личного кабинета');
    }
    
    public function login(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'agreement' => 'accepted',
        ], [
            'agreement.accepted' => 'Вы должны дать согласие на обработку персональных данных.',
        ]);

        // Попытка входа
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            return $this->authenticated($request, Auth::user())
                ?: redirect()->intended($this->redirectPath());
        }

        // Ошибка авторизации
        return back()->withErrors([
            'email' => 'Неверный логин или пароль.',
        ])->withInput($request->except('password'));
    }

}
