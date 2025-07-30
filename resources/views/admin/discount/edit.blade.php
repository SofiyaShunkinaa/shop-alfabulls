@extends('layout.admin', ['title' => 'Редактирование дисконта'])

@section('content')
    <h1>Редактирование дисконта</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.discount.update', ['discount' => $discount->id]) }}">
        @method('PUT')
        @include('admin.discount.part.form')
    </form>
@endsection
