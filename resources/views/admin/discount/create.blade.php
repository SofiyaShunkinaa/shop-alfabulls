@extends('layout.admin', ['title' => 'Создание дисконта'])

@section('content')
    <h1>Создание нового дисконта</h1>
    <form method="post" action="{{ route('admin.discount.store') }}" enctype="multipart/form-data">
        @include('admin.discount.part.form')
    </form>
@endsection
