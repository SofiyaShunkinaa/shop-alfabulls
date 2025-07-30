@extends('layout.admin', ['title' => 'Все дисконты'])

@section('content')
    <h1>Все дисконты</h1>
    <ul>

    </ul>
    <a href="{{ route('admin.discount.create') }}" class="btn btn-success mb-4">
        Создать дисконт
    </a>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Процент скидки</th>
            <th width="30%">При сумме заказов от</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->percent }}%</td>
            <td>@money($item->amount)</td>
            <td>
                <a href="{{ route('admin.discount.edit', ['discount' => $item->id]) }}">
                    <i class="far fa-edit"></i>
                </a>
            </td>
            <td>
                <form action="{{ route('admin.discount.destroy', ['discount' => $item->id]) }}"
                      method="post" onsubmit="return confirm('Удалить этот дисконт?')">
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
