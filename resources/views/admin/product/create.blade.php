@extends('layout.admin', ['title' => 'Создание товара'])

@section('content')
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    <div class="content">
                <h1 class="mb-4 dog-h1">Создание нового товара</h1>
        <div class="table-con" style="overflow-x: hidden;padding: 33px;width: 1000px;">




         <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
              @include('admin.product.part.form')
        </form>

    </div>















        </div>
@endsection
