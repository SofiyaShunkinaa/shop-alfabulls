@extends('layout.admin', ['title' => 'Создание новой доставки'])

@section('content')
    <h1>Создание новой доставки</h1>
    <form method="post" action="{{ route('admin.delivery.store') }}" enctype="multipart/form-data">
        @include('admin.delivery.part.form')
    </form>
@endsection
