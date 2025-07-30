@extends('layout.admin', ['title' => 'Редактирование товара'])

@section('content')
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    <div class="content">
     <h1  class="mb-4 dog-h1">Редактировать</h1>
      <div class="table-con" style="overflow-x: hidden;padding: 33px;width: 1000px;">

    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.dogs.update', ['dog' => $dog->id]) }}">
        @method('PUT')
        @include('admin.dogs.part.form')
    </form>
     </div>















        </div>
@endsection
