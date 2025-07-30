@extends('layout.admin', ['title' => 'Редактирование товара'])

@section('content')
    <h1>Редактирование товара</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.promo.update', ['promo' => $promo->id]) }}">
        @method('PUT')
        @include('admin.promo.part.form')
    </form>
@endsection
