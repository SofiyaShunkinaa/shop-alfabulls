@extends('layout.admin', ['title' => 'Создание товара'])

@section('content')
    <h1>Создание нового Промокод</h1>
    <form method="post" action="{{ route('admin.promo.store') }}" enctype="multipart/form-data">
        @include('admin.promo.part.form')
    </form>
@endsection
