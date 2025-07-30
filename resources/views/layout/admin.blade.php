
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="yandex-verification" content="29728ba900d765ba" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{csrf_token() }}">
    <title>{{ $title ?? 'Панель управления' }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ru-RU.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- new panel -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
		crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"/>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- end new panel -->

    <link rel="stylesheet" href="/css/style.css">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://alfabulls.com/images/icons/favicons/apple-touch-icon.png">

    <link rel="icon" type="image/png" sizes="16x16" href="https://alfabulls.com/images/icons/favicons/favicon-16x16.png">

    <link rel="mask-icon" href="/images/icons/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/icons/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#252525">
    <meta name="msapplication-config" content="/images/icons/favicons/browserconfig.xml">
    <meta name="theme-color" content="#252525">
    <meta name="format-detection" content="telephone=no">
    <meta name="yandex-verification" content="29728ba900d765ba" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/minishop2/css/web/default.css?v=667ec14321" type="text/css" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/minishop2/css/web/lib/jquery.jgrowl.min.css" type="text/css" />
<script>miniShop2Config = {"close_all_message":"\u0437\u0430\u043a\u0440\u044b\u0442\u044c \u0432\u0441\u0435","cssUrl":"\/assets\/components\/minishop2\/css\/web\/","jsUrl":"\/assets\/components\/minishop2\/js\/web\/","actionUrl":"\/assets\/components\/minishop2\/action.php","ctx":"web","price_format":[2,"."," "],"price_format_no_zeros":true,"weight_format":[3,"."," "],"weight_format_no_zeros":true};</script>
<link rel="stylesheet" href="https://alfabulls.com/assets/components/ajaxform/css/default.css" type="text/css" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/mspromocode2/css/web/main.css?v=1744967774" type="text/css" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/easycomm/css/web/ec.default.css" type="text/css" />
<script type="text/javascript">easyCommConfig = {"ctx":"web","jsUrl":"\/assets\/components\/easycomm\/js\/web\/","cssUrl":"\/assets\/components\/easycomm\/css\/web\/","imgUrl":"\/assets\/components\/easycomm\/img\/web\/","actionUrl":"\/assets\/components\/easycomm\/action.php","reCaptchaSiteKey":""}</script>
<link rel="stylesheet" href="https://alfabulls.com/assets/components/discontrol/css/web/default.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"/>
</head>

<body>
    <div class="shell">

  <header class="header">
    <div class="header-bg-1"></div>
    <div class="wrapper">
        <div class="header__inner">
            <div class="logo">
                <a href="/" class="logo-src">
                    <img src="/images/icons/logo_alfabulls.svg" alt="Alfabulls">
                </a>
            </div>
            <div class="navigation">
                <div class="navigation-menu">
                    <nav class="menu">
                        <ul>
                        </li>
                        <li class="{{ request()->routeIs('admin.statistic.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.statistic.index') }}">Статистика</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.user.index') }}">Пользователи</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.category.index', 'admin.product.index', 'admin.order.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.category.index') }}" 
                            class="nav-link">
                                Управление товарами
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.dogs.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.dogs.index') }}">Управление щенками</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.promo.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.promo.index') }}">Промокоды</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.reviews.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.reviews.index') }}">Отзывы</a>
                         <li class="nav-item">
                            <form action="{{ route('user.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="nav-link">Выйти</button>
                            </form>
                            
                        </li>




                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</header>

    <style type="text/css">
        .menu ul li a {
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    width: min-content;
    margin-right: 0;
    text-align: center;
}

.menu ul {
    justify-content: space-between;
}
.nav-link {
    display: block;
    padding: 0px;
}

.table, table, td, th{
    color: #fff;

}

.main {
    flex: 1 1 auto;
    margin-top: 170px;
}

body{
    background:#434343;
}

.header {

    background-color: #434343;
}

@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');


.dog-h1 {
	font-family: 'Buyan';
	font-weight: 700;
	font-size: 60px;
	line-height: 105%;
}


.product-card {
	padding: 10px 30px 10px 30px;
	background-color: #676767;
	border-radius: 10px;
}


.nav-tabs {
	border-bottom: none;
}

.nav-tabs .nav-link {
	background-color: #FFF;
	color: #505050;
	border: none;
	border-radius: 0.5rem;
	margin-right: 0.5rem;
	padding: 0.6rem 1.2rem;
	font-weight: bold;
	transition: 0.3s;
}


.active-tab {
    color: #FFCC8F !important;
    border-radius: 0.5rem;
}


.nav-tabs .nav-link.active {
	background-color: #FFCC8F;
	color: #505050;
	box-shadow: 0 0 0.25rem rgba(0, 0, 0, 0.2);
}

.products {
	padding: 10px 30px 10px 30px;
	background-color: #676767;
	border-radius: 10px;
	width: 205.64px;
	height: 123.47px;
	text-align: center;
	align-content: center;
	-webkit-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1);
	-moz-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1);
	box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1);
}


.butn {
	padding: 10px 20px 10px 20px;
}


.p-c-u {
	font-family: "Montserrat", sans-serif;
	font-size: 20px;
	line-height: 108%;
	font-weight: 800;
}

.search-user {
	align-self: center;
	background-color: #7E7E7E;
	width: 650px;
	height: 50px;
	border-radius: 20px;
}

.category-btn {
	color: white;
	border-radius: 10px;
	padding: 0.5rem 1rem;
	border: 0.7px solid #fff;
    flex: 1 0 auto;
    text-align: center;
}

.category-btn.active, .category-btn:hover {
	background-color: #FFCC8F;
	color: #505050;
    border-color: #FFCC8F;
    text-decoration: none;
}

body {
	background-color: #434343;
	color: #ffffff;
	font-family: 'Inter', sans-serif;
}

nav {

	border-radius: 10px;
	justify-content: space-evenly;
	width: 100%;
	margin-left: 40px;
}

.jcse {
	justify-content: space-between;
}


.table-con {
	background-color: #606060;
	border-radius: 20px;
	width: -webkit-fill-available;
}


.tabl,
.table-row {
	border: 1px solid #fff;
}

.table-cell {
	padding: 0.75rem;
	text-align: center;
	vertical-align: middle;
}

.edit-button {
	background-color: #9CC3FF;
	color: #695B4B;
	padding: 0.5rem 1rem;
	border-radius: 8px;
	transition: background-color 0.2s;
}

.save-button {
	background-color: #FFD9AD;
	color: #695B4B;
	padding: 0.5rem 1rem;
	border-radius: 8px;
	transition: background-color 0.2s;
}

.add-button {
	background-color: #B1FF87;
	color: #000000;
	padding: 0.75rem 1.5rem;
	border-radius: 8px;
	transition: background-color 0.2s;
}

.delete-button {
	color: #FF9191;
	transition: color 0.2s;
}

.delete-button:hover {
	color: #dc2626;
}

.play-button {
	background-color: #6b7280;
	color: white;
	width: 2rem;
	height: 2rem;
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	transition: background-color 0.2s;
}

.play-button:hover {
	background-color: #4b5563;
}

input{
    background-color: #868686 !important;
    color: #ffffff !important;
    border: 1px solid #868686;
}

select{
     background-color: #868686 !important;
    color: #ffffff !important;
    border: 1px solid #868686;
}

textarea{
     background-color: #868686 !important;
    color: #ffffff !important;
    border: 1px solid #868686;
}

input::placeholder{
    color: #fff !important;
}

select:placeholder{
    color: #fff !important;
}

textarea:placeholder{
    color: #fff !important;
}

input[type="checkbox"] {
	appearance: none;
	width: 1.25rem;
	height: 1.25rem;
	border: 2px solid #6b7280;
	border-radius: 4px;
	background-color: transparent;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
}

input[type="checkbox"]:checked {
	background-color: #60a5fa;
	border-color: #60a5fa;
}

input[type="checkbox"]:checked::before {
	content: "✓";
	color: white;
	font-size: 0.75rem;
	font-weight: bold;
}



    </style>

  <style type="text/css">
        .menu ul li a {
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    width: min-content;
    margin-right: 0;
    text-align: center;
}

.menu ul {
    justify-content: space-between;
}
.nav-link {
    display: block;
    padding: 0px;
}

.table, table, td, th{
    color: #fff;

}

.main {
    flex: 1 1 auto;
    margin-top: 170px;
}

body{
    background:#434343;
}

.header {

    background-color: #434343;
}

@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');


.dog-h1 {
        display: inline-block;
    font-family: 'Buyan';
    font-weight: 700;
    font-size: 60px;
    line-height: 105%;
    background-image: radial-gradient(159.48% 598.74% at 19.84% 55.71%, #FFFFFF 0%, rgba(255, 255, 255, 0) 100%);
    color: transparent;
    background-clip: text;
    -webkit-background-clip: text;
}

.menu ul {
    display: flex;
    align-items: center;
    padding: 15px 30px;
    border: 2px solid #999;
    border-radius: 20px;
    gap: 21px;
    width: 100%;
}

.product-card {
    padding: 10px 30px 10px 30px;
    background-color: #676767;
    border-radius: 10px;
}


.nav-tabs {
    border-bottom: none;
}

.nav-tabs .nav-link {
        width: 162px;
    text-align: center;
        background-color: #737373;
    color: #ffffff;
    box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    border: none;
    border-radius: 0.5rem;
    margin-right: 0.5rem;
    padding: 0.6rem 1.2rem;
    font-weight: bold;
    transition: 0.3s;
}


.active-tab {
    color: #FFCC8F !important;
    border-radius: 0.5rem;
}


.nav-tabs .nav-link.active {
        background-color: #FFDDB5;
    color: #505050;
    box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px -4px 10px 3px rgba(115, 115, 115, 0.4) inset;
}

.products {
    padding: 10px 30px 10px 30px;
        background-color: #737373;
    border-radius: 10px;
    width: 205.64px;
    height: 123.47px;
    text-align: center;
    align-content: center;
    -webkit-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    -moz-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
        line-height: 1;
}

.products a{
    color:#000;
}


.butn {
     padding: 6px 32px 6px 32px;
}


.p-c-u {
    font-family: "Montserrat", sans-serif;
    font-size: 20px;
    line-height: 108%;
    font-weight: 800;
}

.search-user {
    align-self: center;
    background-color: #7E7E7E;
    width: 650px;
    height: 50px;
    border-radius: 20px;
}

.category-btn {
    color: white;
    border-radius: 10px;
    padding: 0.5rem 1rem;
    border: 0.7px solid #fff;
    flex: 1 0 auto;
    text-align: center;
}

.category-btn.active, .category-btn:hover {
    background-color: #FFCC8F;
    color: #505050;
    border-color: #FFCC8F;
    text-decoration: none;
}

body {
    background-color: #434343;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
}

nav {

    border-radius: 10px;
    justify-content: space-evenly;
    width: 100%;
    margin-left: 40px;
}

.jcse {
    justify-content: space-between;
}


.table-con {
    background-color: #606060;
    border-radius: 20px;
    width: -webkit-fill-available;
}


.tabl,
.table-row {
    border: 1px solid #fff;
}

.table-cell {
        padding: 10px 8px;
    text-align: center;
    vertical-align: middle;
}

.edit-button {
    background-color: #9CC3FF;
    color: #695B4B;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: background-color 0.2s;
}

.save-button {
    background-color: #FFD9AD;
    color: #695B4B;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: background-color 0.2s;
}

.add-button {
    background-color: #B1FF87;
    color: #000000;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: background-color 0.2s;
}

.delete-button {
    color: #FF9191;
    transition: color 0.2s;
}

.delete-button:hover {
    color: #dc2626;
}

.play-button {
    background-color: #6b7280;
    color: white;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s;
}

.play-button:hover {
    background-color: #4b5563;
}

input{
    background-color: #868686 !important;
    color: #ffffff !important;
    border: 1px solid #868686;
}

select{
     background-color: #868686 !important;
    color: #ffffff !important;
    border: 1px solid #868686;
}

textarea{
     background-color: #868686 !important;
    color: #ffffff !important;
    border: 1px solid #868686;
}

input::placeholder{
    color: #fff !important;
}

select:placeholder{
    color: #fff !important;
}

textarea:placeholder{
    color: #fff !important;
}

input[type="checkbox"] {
    appearance: none;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #6b7280;
    border-radius: 4px;
    background-color: transparent;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

input[type="checkbox"]:checked {
    background-color: #60a5fa;
    border-color: #60a5fa;
}

input[type="checkbox"]:checked::before {
    content: "✓";
    color: white;
    font-size: 0.75rem;
    font-weight: bold;
}


.wrapper {
    width: 100%;
    max-width: 1500px !important;
    padding: 0 30px;
    margin: 0 auto;
}

table{
    font-size: 14px;
    border-collapse: separate;
    font-weight: normal;
}

.table-bordered {
    border: 0px solid #dee2e6;
}

tr{
    background: #7E7E7E;
    border: 0px;
}

/*.table-bordered th, .table-bordered td {
    border: 0px solid #dee2e6;
}

.tabl, .table-row {
    border: 0px solid #fff;
}

.table-bordered>:not(caption)>* {
    border-width: 0px;
}*/

table tbody tr:last-child td:first-child {
    border-radius: 0 0 0 20px;
}
table tbody tr:last-child td:last-child {
    border-radius: 0 0 20px 0;
}
table thead tr th:first-child {
    border-radius: 20px 0 0 0;
}
table thead tr th:last-child {
    border-radius: 0 20px 0 0;
}

.table tbody tr:last-child td{
    border-bottom: 1px solid #fff;
}

.table tr th:first-child, .table tr td:first-child {
    border-left: 1px solid #fff;
}
.table tr th:last-child, .table tr td:last-child {
    border-right: 1px solid #fff;
}


.table thead th {

    border-top: 1px solid #fff;
}

.table-bordered>:not(caption)>*>* {
    border-width: 1px var(--bs-border-width);
}

.mb-3{
        margin-top: -23px;
    margin-bottom: 40px !important;
}

.p-3 {
    padding: 24px !important;
}

.bg-green-600 {
    --tw-bg-opacity: 1;
    background-color: #00DE3B;
    padding: 8px 32px !important;
      width: 131px;
}

.bg-red-600 {
    --tw-bg-opacity: 1;
    background-color: #FF0000;
    padding: 8px 32px !important;
    width: 131px;
}

.table-bordered thead th, .table-bordered thead td {
    border-bottom-width: 1px;
}


.edit-button{
    font-weight: bold;
}

    </style>
        <main class="main">


<div class="wrapper">
    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible mt-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
 </div>




</main>



</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.form-cart-change');

        // Функция для инициализации обработчиков
        function initializeForms() {
            forms.forEach(function(form) {
                const inputCount = form.querySelector('input[name="count"]');
                const plusButton = form.querySelector('[data-plus]');
                const minusButton = form.querySelector('[data-minus]');
                const submitButton = form.querySelector('button[type="submit"]');

                // Удаляем старые обработчики, если они были
                if (plusButton) {
                    plusButton.removeEventListener('click', addCount);
                    plusButton.addEventListener('click', addCount);
                }

                if (minusButton) {
                    minusButton.removeEventListener('click', subtractCount);
                    minusButton.addEventListener('click', subtractCount);
                }

                function addCount() {
                    inputCount.value = parseInt(inputCount.value) + 1;
                    submitButton.click();
                }

                function subtractCount() {
                    let currentValue = parseInt(inputCount.value);
                    if (currentValue > 1) {
                        inputCount.value = currentValue - 1;
                        submitButton.click();
                    }
                }
            });
        }

        // Инициализируем формы при загрузке страницы
        initializeForms();

        // Подписываемся на событие изменения количества товара
        miniShop2.Callbacks.add('Cart.change.response.success', 'restrict_cart', function() {
            console.log('Кол-во товара изменено');
            // Переинициализируем формы после изменения
            initializeForms();
        });
    });
</script>

<!-- БД, сек 0.0457 s<br>
БД запросов 82<br>
PHP - 0.1179 s<br>
Генерация: 0.1636 s<br>
Память: 4 096 kb<br>
Кеш? cache<br> -->

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<!--<script type="text/javascript" src="/js/jquery.inputmask.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
<script src="/js/main.js@v=1"></script>
<!--<script src="https://unpkg.com/imask"></script>-->
<script type="text/javascript" src="/js/jquery.lazy.min.js"></script>
<script>
    const maskElements = document.querySelectorAll('input[type="tel"]');
    const maskOptions = {
        mask: '+{7}(000)000-00-00'
    };
    maskElements.forEach((elem) => {
        IMask(elem, maskOptions);
    })
</script>
<script>
    $(function() {
        $(window).on("scroll", function() {
            if($(window).scrollTop() > 50) {
                $(".header").addClass("active");
            } else {
                //remove the background property so it comes transparent again (defined in your css)
               $(".header").removeClass("active");
            }
        });
        //$('.tel, #phone').inputmask('+7 (999) 999 99 99',{
        //    clearMaskOnLostFocus: true,
        //    clearIncomplete: true
        //});
    });
</script>
<script>
window.replainSettings = { id: 'd85e2a64-c496-4224-bd7f-c0316aa9813d' };
(function(u){var s=document.createElement('script');s.async=true;s.src=u;
var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
})('https://widget.replain.cc/dist/client.js');
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(100413837, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/100413837" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    <script>
        function scrollContainer(containerId, direction) {
            const container = document.getElementById(containerId);
            if (!container) {
                console.error(`Container with ID ${containerId} not found.`);
                return;
            }
            const cardWidth = 271 + 20;
            const scrollAmount = cardWidth * 1;
            container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
        }
    </script>





<script>
    $(function() {
        $('.review-orders-title a').on( "click", function() {
            $('.review-order').toggle();
            return false;
        });

        $('.review-order-link').on( "click", function() {
            $('.review-orders').toggle();
            $('.review-order-select').toggle();
            $('.review-type').toggle();
            $('.review-order-select').text( $(this).text() );
            $('.review-subject').val( $('.review-subject').val() + ' ' + $(this).text() );
            $('.review-order').val( $(this).attr('data-order') );
            return false;
        });

        $('.review-types-title a').on( "click", function() {
            $('.review-type').toggle();
            return false;
        });

        $('.review-type-link').on( "click", function() {
            $('.review-types').toggle();
            $('.review-type-select').toggle();
            $('.review-type-select').text( $(this).text() );
            $('.review-subject').val( $('.review-subject').val() + ' ' + $(this).text() );
            return false;
        });

        $('.review-button-text').on( "click", function() {
            $('.review-form-text').toggle();
        });

        $('.review-button-photo').on( "click", function() {
            $('.review-form-photo').toggle();
        });

        $('.review-button-video').on( "click", function() {
            $('.review-form-video').toggle();
        });
    });
</script>

<script src="https://alfabulls.com/assets/components/minishop2/js/web/default.js?v=667ec14321"></script>
<script src="https://alfabulls.com/assets/components/minishop2/js/web/lib/jquery.jgrowl.min.js"></script>
<script src="https://alfabulls.com/assets/components/minishop2/js/web/message_settings.js"></script>
<script src="https://alfabulls.com/assets/components/ajaxform/js/default.js"></script>
<script type="text/javascript">AjaxForm.initialize({"assetsUrl":"\/assets\/components\/ajaxform\/","actionUrl":"\/assets\/components\/ajaxform\/action.php","closeMessage":"\u0437\u0430\u043a\u0440\u044b\u0442\u044c \u0432\u0441\u0435","formSelector":"form.ajax_form","pageId":1});</script>
<script src="https://alfabulls.com/assets/components/mspromocode2/js/web/main.js?v=1744967774"></script>
<script>
                    if (typeof(msPromoCode2MainCls) === "undefined") {
                        var msPromoCode2MainCls = new msPromoCode2Main({"assetsUrl":"\/assets\/components\/mspromocode2\/","actionUrl":"\/assets\/components\/mspromocode2\/action.php","ctx":"web"});
                    }
                </script>

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Русская локализация -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>


<script>msMCDMiniCartConfig ={"actionUrl":"\/assets\/components\/msmcd\/action.php","animate":false,"dropdown":false,"ctx":"web"}</script>
<script src="https://alfabulls.com/assets/components/msmcd/js/web/msmcdminicart.js"></script>
<script src="https://alfabulls.com/assets/components/easycomm/js/web/ec.default.js"></script>
<script src="https://alfabulls.com/assets/components/discontrol/js/web/default.js"></script>
<script type="text/javascript">Discontrol.initialize({"assetsBaseUrl":"\/assets\/","assetsUrl":"\/assets\/components\/discontrol\/","actionUrl":"\/assets\/components\/discontrol\/action.php","selector":".discontrol-selector","propkey":"704b95c76e372b87cbac50028e64db50f1a2f7b4","action":"","ctx":"web","miniShop2":{"version":"3.0.7-pl"}});</script>
</body>

</html>




























