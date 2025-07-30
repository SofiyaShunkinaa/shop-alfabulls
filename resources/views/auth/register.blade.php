@extends('layout.site', ['title' => 'Регистрация на сайте'])

@section('content')


<section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">Авторизация</li></ol>
        </div>
    </div>
</section>
  <section class="lk">
                <div class="lk-bg-1"></div>
                <div class="lk-bg-2"></div>
                <div class="wrapper parent-animation">
                    <h1>Личный кабинет</h1>
                    <div id="office-auth-form">

<form method="post" class="lk-block" id="office-auth-register" action="{{ route('user.register') }}">
    @csrf
    <h2>Регистрация</h2>

    <div class="lk-block-item form-group">
        <label for="office-auth-register-fullname" class="col-md-3 col-form-label">
            Имя
        </label>
        <h3>Имя*</h3>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="lk-block-item form-group">
        <label for="surname" class="col-md-3 col-form-label">
            Фамилия
        </label>
        <h3>Фамилия*</h3>
        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
               name="surname" value="{{ old('surname') }}" required>
        @error('surname')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="lk-block-item form-group">
        <label for="username" class="col-md-3 col-form-label">
            Логин
        </label>
        <h3>Логин*</h3>
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
               name="username" value="{{ old('username') }}" required>
        @error('username')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="lk-block-item form-group">
        <label for="office-auth-register-email" class="col-md-3 col-form-label">
            Email&nbsp;<span class="red">*</span>
        </label>
        <h3>Email*</h3>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="lk-block-item form-group">
        <label for="phone" class="col-md-3 col-form-label">
            Телефон
        </label>
        <h3>Телефон*</h3>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
               name="phone" value="{{ old('phone') }}" required>
        @error('phone')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="lk-block-item form-group">
        <label for="office-auth-register-password" class="col-md-3 col-form-label">
            Пароль
        </label>
        <h3>Пароль*</h3>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="lk-block-item form-group">
        <label for="office-auth-register-password" class="col-md-3 col-form-label">
            Подтверждение пароля
        </label>
        <h3>Подтверждение пароля*</h3>
        <input id="password-confirm" type="password" class="form-control"
               name="password_confirmation" required autocomplete="new-password">
    </div>

   <div class="lk-block-item-agreement form-group">
    <input type="checkbox" 
           id="agreement" 
           name="agreement"   {{-- ✅ добавили name --}}
           value="1"          {{-- ✅ Laravel любит когда у чекбоксов есть value --}}
           class="agreement-input-reg-js required @error('agreement') is-invalid @enderror"
           {{ old('agreement') ? 'checked' : '' }}> {{-- ✅ чтобы не сбрасывался при ошибке --}}
           
    <label for="agreement" class="agreement-reg-js">
        Даю согласие на обработку персональных данных
    </label>

    @error('agreement')
        <br>
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


    <div class="lk-block-item-p">
        <p>У вас уже есть аккаунт? <a href="{{ route('user.login') }}" class="login-js">Войти</a></p>
    </div>

    <div class="form-group">
        <input type="hidden" name="action" value="auth/formRegister"/>
        <div class="offset-md-3 col-md-9">
            <button type="submit" class="btn btn-danger reg-js-btn">Регистрация</button>
        </div>
    </div>
</form>

</div>

                </div>
            </section>









@endsection
