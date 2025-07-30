@csrf
<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

<div style="font-size: 38px; font-family: 'Buyan'; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; line-height: 128%;">
    {{ auth()->user()->name }}
</div>

{{-- EMAIL --}}
<div class="profile-form-item-desc-add form-group">
    <label class="col-md-2 col-form-label">Почта<sup class="red">*</sup></label>
    <div class="col-md-10">
        <div class="profile-form-item-desc-add-input-group">
            <span>Почта:</span>
            <input type="text" name="email" placeholder="Адрес почты"
                   required maxlength="255" 
                   value="{{ old('email', $profile->email ?? '') }}"
                   class="form-control @error('email') is-invalid @enderror">
        </div>
        {{-- Ошибка под полем --}}
        @error('email')
            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- PHONE --}}
<div class="profile-form-item-desc-add form-group">
    <label class="col-md-2 col-form-label">Телефон<sup class="red">*</sup></label>
    <div class="col-md-10">
        <div class="profile-form-item-desc-add-input-group">
            <span>Телефон:</span>
            <input type="text" name="phone" placeholder="Номер телефона"
                   required maxlength="255" 
                   value="{{ old('phone', $profile->phone ?? '') }}"
                   class="form-control @error('phone') is-invalid @enderror">
        </div>
        {{-- Ошибка под полем --}}
        @error('phone')
            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- PASSWORD --}}
<div class="profile-form-item-desc-add form-group">
    <label class="col-md-2 col-form-label">Новый пароль</label>
    <div class="col-md-10">
        <div class="profile-form-item-desc-add-input-group">
            <span>Пароль:</span>
            <input type="password" name="new_password" placeholder="Введите новый пароль"
                   class="form-control @error('new_password') is-invalid @enderror">
        </div>
        {{-- Ошибка под полем --}}
        @error('new_password')
            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
        @enderror
    </div>
</div>

<br>

<div class="form-group">
    <button style="width: 100%;" type="submit" class="btn btn-success">Сохранить</button>
</div>
