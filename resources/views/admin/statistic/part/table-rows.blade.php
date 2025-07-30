<table class="w-full text-left table-bordered">
      <thead class="table-header">
        <tr style="background-color: #9A9A9A;">
          <th class="table-cell">Наименование товара</th>
          <th class="table-cell">Продано</th>
          <th class="table-cell">Остаток шт</th>
          <th class="table-cell">Статус</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr class="border-t border-gray-700 table-row">
          <td class="table-cell" style="
    text-align: left;
">{{ $product->name }}</td>
          <td class="table-cell">{{ $soldCounts[$product->id] ?? 0 }}</td>
          <td class="table-cell">{{ $product->col }}</td>
          @if ($product->col <= 400)
            <td style="white-space: nowrap;" class="table-cell"><span style="
       width: 100%;
           min-width: 140px;
    display: block;
    background-color: #FF0000;
    padding: 8px 0px !important;
    font-size: 14px;
    line-height: 1;
    text-align: center;
    font-weight: bold;
    border-radius: 10px;
">Заканчивается</span></td>
            @else
            <td style="white-space: nowrap;" class="table-cell"><span style="
       width: 100%;
           min-width: 140px;
    display: block;
    background-color: #00DE3B;
    padding: 8px 0px !important;
    font-size: 14px;
    line-height: 1;
    text-align: center;
    font-weight: bold;
    border-radius: 10px;
">В наличии</span></td>
          @endif
          
        </tr>
        @endforeach
      </tbody>
    </table>
@if ($products->links())
    <div class="py-6">
        <div class="max-w-full overflow-x-auto">
            <div class="inline-block min-w-full">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endif