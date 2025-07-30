@extends('layout.admin', ['title' => 'Все доставки'])

@section('content')
    <h1>Все доставки</h1>
    <ul>

    </ul>
    <a href="{{ route('admin.delivery.create') }}" class="btn btn-success mb-4">
        Создать доставку
    </a>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Название</th>
            <th width="30%">Данные api</th>
            <th width="30%">Максимальный вес(кг.)</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->api_data }}</td>
            <td>{{ $item->max_weight }}</td>
            <td>
                <a href="{{ route('admin.delivery.edit', ['delivery' => $item->id]) }}">
                    <i class="far fa-edit"></i>
                </a>
            </td>
            <td>
                <form action="{{ route('admin.delivery.destroy', ['delivery' => $item->id]) }}"
                      method="post" onsubmit="return confirm('Удалить этот метод доставки?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                        <i class="far fa-trash-alt text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $items->links() }}
@endsection
