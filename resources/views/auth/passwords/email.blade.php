@extends('layout.site')

@section('content')


            <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4"></circle></svg></span><li class="breadcrumb-item active">Восстановление пароля</li></ol>
        </div>
    </div>
</section>
            <section class="lk">
                <div class="lk-bg-1"></div>
                <div class="lk-bg-2"></div>
                <div class="wrapper parent-animation">
                    <h1 style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">Личный кабинет</h1>
                    <div id="office-auth-form" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
    <form method="post" class="lk-block" id="office-auth-login"  method="POST" action="{{ route('user.password.email') }}">
                    @csrf
        <div class="office-auth-login-time-br"></div>
        <div class="office-auth-login-time">
            <p>Если Вы были авторизованы на старом сайте, Вам придет ссылка на почту, по ней Вы сможете активировать аккаунт со всеми привелегиями, которые у Вас были.</p>
        </div>
        <h2>Восстановление пароля</h2>
        <div class="lk-block-item form-group">
            <label for="office-auth-login-email" class="col-md-3 col-form-label">
                Email&nbsp;<span class="red">*</span>
            </label>
            <h3>Email</h3>
             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
        </div>

        <div class="lk-block-item-agreement form-group">
            <input type="checkbox" id="agreement" class="agreement-input-auth-js">
            <label for="agreement" class="agreement-auth-js">Даю согласие на обработку персональных данных</label>
        </div>
        <div class="form-group">
            <input type="hidden" name="action" value="auth/formLogin">
            <input type="hidden" name="return" value="">
            <div class="offset-md-3 col-md-9">
                <button type="submit" class="btn btn-primary auth-js">Вход</button>
            </div>
        </div>
    </form>
        </div>
                </div>
            </section>







@endsection
