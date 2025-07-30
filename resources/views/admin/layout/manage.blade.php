@extends('layout.admin')

@section('content')
<div>
        <ul class="nav nav-tabs mb-3 d-flex gap-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}" 
                   href="{{ route('admin.category.index') }}">Категории</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/product*') ? 'active' : '' }}" 
                   href="{{ route('admin.product.index') }}">Товары</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/order*') ? 'active' : '' }}" 
                   href="{{ route('admin.order.index') }}">Покупки</a>
            </li>
        </ul>

        <div class="content">
            @yield('manage-content')
        </div>
    </div>
@endsection