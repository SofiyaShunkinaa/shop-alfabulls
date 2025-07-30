@extends('layout.admin', ['title' => 'Редактирование доставки'])

@section('content')
    <h1>Редактирование доставки</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.delivery.update', ['discount' => $delivery->id]) }}">
        @method('PUT')
        @include('admin.delivery.part.form')
    </form>
@endsection
