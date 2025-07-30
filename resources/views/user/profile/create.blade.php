@extends('layout.site', ['title' => 'Создание профиля'])

@section('content')



            <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="/">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4"></circle></svg></span><li class="breadcrumb-item active"><img src="/images/icons/icon-lk.svg" alt="Alfabulls Личный кабинет"></li></ol>
        </div>
    </div>
</section>
            <section class="profile">
                <div class="profile-bg-1"></div>
                <div class="profile-bg-2"></div>
                <div class="wrapper parent-animation">
                    <h1 style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">Личный кабинет</h1>

    <form action="111" method="post" class="profile-form" id="office-profile-form" enctype="multipart/form-data" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">

        <div class="profile-form-items">
            <h3>Личная информация</h3>
            <div class="profile-form-item profile-form-item-info">

                <div class="profile-form-item-desc">        
                        @include('user.profile.part.form')
                </div>

            </div>
        </div>

    </form>


<br>




                </div>
            </section>








@endsection
