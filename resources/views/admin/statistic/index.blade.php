@extends('layout.admin', ['title' => 'Статистика'])

@section('content')
<style>
  .time-btn {
    
    background-color: transparent;
    color: #FFFFFF;
  }

  .time-btn:hover,
  .time-btn.active {
    background-color: #2D2D2D;
    color: #FFFFFF;
  }

   .container {
      background-color: #606060;
      padding: 20px;
      border-radius: 20px;
      width: 100%;
      margin-bottom:26px;
    }

    .title {
      text-align: center;
      font-weight: bold;
      font-size: 20px;
      margin-bottom: 20px;
    }

    .source {
      margin-bottom: 15px;
    }

    .source-label {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin-bottom: 4px;
    }

    .progress-bar {
      height: 10px;
      border-radius: 5px;
      background-color: #555;
      overflow: hidden;
    }

    .progress {
      height: 100%;
      border-radius: 5px;
    }

    .green { background-color: #a2ff00; }
    .yellow { background-color: #ffd000; }
    .orange { background-color: #ff8c00; }
    .red { background-color: #ff5030; }

    #products-table nav{
      margin-left: 0px;
    }
    #products-table nav ul li span, #products-table nav ul li a{
      background: transparent;
      color:#ffffff;
      
    }
#products-table nav ul li.active span{
border-color:rgb(16, 234, 0);
}
#statPl .rounded{
  border-radius: 20px !important;
  height:155px;
}
#statPl .text-sm{
height: 39px;
    font-size: 14px;
    font-weight: 700;
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    border-radius: 20px 20px 0px 0px;
}
#statPl .text-2xl{
height: 106px;
    font-size: 50px;
    font-weight: 800;
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    border-radius: 0px 0px 20px 20px;
}
#statPl .bg-purple-500 .text-sm{
background:rgba(193, 65, 230, 1);
}
#statPl .bg-green-500 .text-sm{
background:rgba(3, 195, 108, 1);
}
#statPl .bg-teal-400 .text-sm{
background:rgba(1, 188, 170, 1);
}
#statPl .bg-blue-400 .text-sm{
background:rgba(0, 156, 224, 1);
}
    
.filter-panel {
  display: flex;
  /* gap: 10px; */
  flex-wrap: wrap;
  align-items: center;
  width: calc(100% - 446px - 26px);
  justify-content: space-between;
}

.input-wrapper {
  position: relative;
  width: 203px;
}

.filter-input {
  width: 100%;
  padding: 8px 12px;
  border-radius: 8px;
  background-color: #888;
  color: white;
  border: none;
  font-size: 14px;
  appearance: none;
  position: relative;
  z-index: 2;
  height:40px;
  width:203px;
}

.placeholder-label {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #ccc;
  font-size: 13px;
  pointer-events: none;
  transition: 0.2s ease;
  z-index: 1;
}

.filter-input:focus + .placeholder-label,
.filter-input:not(:placeholder-shown) + .placeholder-label,
.filter-input:valid + .placeholder-label {
  opacity: 0;
  visibility: hidden;
}

.select-wrapper {
  position: relative;
  width: calc(100% - 203px - 203px - 230px - 30px);
}

.filter-select {
  background-color: #888;
  border: none;
  color: white;
  height:40px;
  padding: 8px 28px 8px 12px;
  border-radius: 8px;
  font-size: 14px;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='20,50 70,100 120,50' stroke='white' stroke-width='15' fill='none'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 10px;
  width: 100%;
}

.filter-button {
  background-color: #a3f46c;
  color: black;
  font-weight: bold;
  padding: 9px 16px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.2s;
  width:230px;
}

.filter-button:hover {
  background-color: #90e75d;
}
   

</style>

    <h1 class="dog-h1 mb-4">Статистика</h1>

<div class="flex items-center rounded text-white text-sm overflow-hidden w-fit py-4"
style=" width: 100%; justify-content: space-between; align-items: flex-end;">
    <div class="flex items-center rounded text-white text-sm overflow-hidden w-fit" style="border: 1px solid #BCBCBC; border-radius: 6px;">
        <button class=" border-r font-semibold focus:outline-none time-btn" data-range="week" style="
    width: 153px;
    padding: 19px 0px !important;
    font-size: 20px;
">
            Неделя
        </button>
        <button class=" border-r focus:outline-none time-btn" data-range="month" style="
    width: 153px;
    padding: 19px 0px !important;
    font-size: 20px;    border-left: 1px solid #BCBCBC;
    border-right: 1px solid #BCBCBC;
">
            Месяц
        </button>
        <button class="focus:outline-none time-btn" data-range="year" style="
    width: 153px;
    padding: 19px 0px !important;
    font-size: 20px;
">
            Год
        </button>
    </div>


    <div class="filter-panel">
  <div class="input-wrapper">
    <!--<input type="date" id="date-from" class="filter-input" />
    <label for="date-from" class="placeholder-label">Выбрать заказы с</label>
-->


                        <lable style="
    display: flex;
    align-items: center;
">
    <input type="text" class="date-input placeholder-white" id="date-from" style="   padding: 9px 18px !important;
    width: 166px;
    align-self: center;
    border-radius: 7px 0px 0px 7px;" name="date_from" placeholder='Выбрать заказы с'>
    <span style="
    display: block;
    width: 38px;
    align-items: center;
    background: #A6A6A6;
    text-align: center;
    padding: 10px 0px;
    border-radius: 0px 10px 10px 0px;
"><img style="
    margin: auto;
" src="/img/calenadr.png"></span>
                        </lable>
  </div>

  <div class="input-wrapper">
   <!-- <input type="date" id="date-to" class="filter-input" />
    <label for="date-to" class="placeholder-label">Выбрать заказы по</label>-->


      <lable style="
    display: flex;
    align-items: center;
">
    <input type="text"  id="date-to" class="date-input date-input2 placeholder-white"  style="   padding: 9px 18px !important;
    width: 166px;
    align-self: center;
    border-radius: 7px 0px 0px 7px;" name="date_from" placeholder='Выбрать заказы по'>
    <span style="
    display: block;
    width: 38px;
    align-items: center;
    background: #A6A6A6;
    text-align: center;
    padding: 10px 0px;
    border-radius: 0px 10px 10px 0px;
"><img style="
    margin: auto;
" src="/img/calenadr.png"></span>
                        </lable>
  </div>

  <!-- Категория -->
  <div class="select-wrapper">
    <select id="category" class="filter-select">
      <option value="">Категория</option>
      @foreach($categories as $category)
      <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
  </div>

  <!-- Кнопка -->
  <button id="filter-button" class="filter-button">Показать</button>
</div>
    
</div>

  <div class="grid grid-cols-4 gap-4 mb-4" id="statPl">

    <div class="bg-purple-500 rounded flex flex-col items-center shadow-md">
      <div class="text-sm opacity-80 mb-1">Общее число заказов</div>
      <div class="text-2xl font-bold">{{ $orders->count() }}</div>
    </div>
    <div class="bg-green-500 rounded flex flex-col items-center shadow-md">
      <div class="text-sm opacity-80 mb-1">Выручка</div>
      <div class="text-2xl font-bold">{{ number_format($totalAmount, 2, ',', ' ') }}</div>
    </div>
    <div class="bg-teal-400 rounded flex flex-col items-center shadow-md">
      <div class="text-sm opacity-80 mb-1">Чистая прибыль</div>
    <div class="text-2xl font-bold">{{ number_format($totalAmount, 2, ',', ' ') }}</div>
  </div>
    <div class="bg-blue-400 rounded flex flex-col items-center shadow-md">
      <div class="text-sm opacity-80 mb-1">Средний чек</div>
      <div class="text-2xl font-bold">{{ number_format($averageCheck, 2, ',', ' ') }}</div>
    </div>
  </div>


  <div style="display:flex;">
    <div style="width:443px; margin-right:26px;">
      <div class="container">
        <div class="title">Источники заказов</div>
        <div id="sources"></div>
      </div>
      <div class="container">
        <div class="title">Структура доходов</div>
        <div style="
    width: 360px;
    margin: auto;
"><canvas id="incomePie" height="100"></canvas></div>
        <div style="
    width: 360px;
    margin: auto;
" id="customLegend" class="mt-4"></div>
      </div>
    </div>

    <div style="width: calc(100% - 433px - 26px);">
      <div class="container" style="padding-top: 48px;">
        <canvas id="ordersChart" height="170"></canvas>
          <div class="flex gap-4 my-4">
          <div id="btn-orders" class="rounded cursor-pointer chart-btn" style="
    font-size: 14px;
    padding: 14px 22px;
    line-height: 1;
    border-radius: 7px;
    background: #D851FF;
">Число заказов</div>
          <div id="btn-revenue" class="rounded cursor-pointer"style="
    font-size: 14px;
    padding: 14px 22px;
    line-height: 1;
    border-radius: 7px;
    background: #01DF7A;
">Стоимость заказов</div>
          <div id="btn-profit" class="cursor-pointer"style="
    font-size: 14px;
    padding: 14px 22px;
    line-height: 1;
    border-radius: 7px;
    background: #00CEBA;
">Чистая прибыль</div>
          <div id="btn-average" class="cursor-pointer"style="
    font-size: 14px;
    padding: 14px 22px;
    line-height: 1;
    border-radius: 7px;
    background: #01AEFA;
">Средний чек</div>
          </div>
      </div>

      <div class="container">
        <div class="title">Остатки</div>

        <div class="mb-4 flex items-center gap-2" style="justify-content: space-between;">
          <select id="filter-status" class=" p-1 rounded" style="align-self: center; background-color: #868686; color: #ffffff; border-radius: 7px; width:230px;">
            <option value="">Все статусы</option>
            <option value="available">В наличии</option>
            <option value="low">Заканчивается</option>
          </select>

          <div class="lypa" style="
    position: relative;
    width: calc(100% - 230px - 168px - 26px);
">
             <input type="text" id="filter-name" style="align-self: center;background-color: #868686;color: #ffffff;border-radius: 7px; width: 100%" class=" p-1 rounded" placeholder="Поиск">

            <img src="/img/lypa.png" style="
    position: absolute;
    right: 12px;
    top: 6px;
">
        </div>


          <button id="filter-btn" class="px-4 py-1 rounded" style="background-color: rgba(177, 255, 135, 1); width:168px; color:#000000;">Показать</button>
        </div>

        <div id="products-table">      
          @include('admin.statistic.part.table-rows', ['products' => $products, 'soldCounts' => $soldCounts])
        </div>

      </div>
    </div>
  </div>

  

<script>
  // Автозагрузка при старте
$(document).ready(function() {
let currentRange = 'all';

function createLineChart(ctx, labels, dataset) {
  return new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [dataset]
    },
    options: {
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { color: '#FFFFFF' }
        },
        x: {
          ticks: { color: '#FFFFFF' }
        }
      }
    }
  });
}

function createDoughnutChart(ctx, labels, data) {
  return new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: generateColors(data.length)
      }]
    },
    options: {
      plugins: { legend: { display: false } }
    }
  });
}

function generateColors(count) {
  const baseColors = ['#FFDD00', '#10EA00', '#FF9500', '#FF00E5', '#00FF77', '#AE00FF', '#FF0000', '#7B00FF'];
  return Array.from({ length: count }, (_, i) => baseColors[i % baseColors.length]);
}

// Основной график
const ctx = document.getElementById('ordersChart').getContext('2d');
let chart = createLineChart(ctx, {!! json_encode($chartLabels) !!}, {
  label: 'Стоимость заказов',
  data: {!! json_encode($chartRevenue) !!},
  borderColor: '#FFC800'
});
let currentKey = 'revenue';

// Пирог
const pieCtx = document.getElementById('incomePie').getContext('2d');
let pieChart = createDoughnutChart(pieCtx, Object.keys({!! json_encode($categorySums) !!}), Object.values({!! json_encode($categorySums) !!}));
createCustomLegend(pieChart, 'customLegend');

// Обновление line-графика
function updateDataset(key) {
  currentKey = key;

  fetch(`/admin/chartData?range=${currentRange}`)
    .then(res => res.json())
    .then(data => {
      const colorMap = {
        orders: '#A855F7',
        revenue: '#FFC800',
        average: '#3B82F6',
        profit: '#22C55E'
      };

      chart.data.labels = data.labels;
      chart.data.datasets = [{
        label: getLabel(key),
        data: data[key],
        borderColor: colorMap[key]
      }];
      chart.update();

      document.querySelectorAll('.chart-btn').forEach(btn => btn.classList.remove('opacity-100', 'ring'));
      const btn = document.getElementById(`btn-${key}`);
      if (btn) btn.classList.add('opacity-100', 'ring', 'ring-white');
    });
}

// Получение label по ключу
function getLabel(key) {
  return {
    orders: 'Число заказов',
    revenue: 'Стоимость заказов',
    profit: 'Чистая прибыль',
    average: 'Средний чек'
  }[key];
}

// Обновление пирога
function updatePieChart(range) {
  fetch(`/admin/pieData?range=${range}`)
    .then(res => res.json())
    .then(data => {
      pieChart.data.labels = Object.keys(data);
      pieChart.data.datasets[0].data = Object.values(data);
      pieChart.data.datasets[0].backgroundColor = generateColors(Object.keys(data).length);
      pieChart.update();
      createCustomLegend(pieChart, 'customLegend');
    });
}

// Обработчики переключения метрик
['orders', 'revenue', 'profit', 'average'].forEach(key => {
  const btn = document.getElementById(`btn-${key}`);
  if (btn) {
    btn.classList.add('chart-btn');
    btn.addEventListener('click', () => updateDataset(key));
  }
});

// Обработчики переключения диапазона
document.querySelectorAll('.time-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    currentRange = btn.dataset.range;

    document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('bg-white', 'text-black', 'font-semibold'));
    btn.classList.add('bg-white', 'text-black', 'font-semibold');

    updateDataset(currentKey);
    updatePieChart(currentRange);
    statsAll(null,null,null,currentRange);
    
  });
});

// Легенда для пирога
function createCustomLegend(chart, containerId) {
  const container = document.getElementById(containerId);
  container.innerHTML = '';

  const ul = document.createElement('ul');
  ul.style.listStyle = 'none';
  ul.style.padding = '0';
  ul.style.margin = '0';
  ul.style.display = 'grid';
  ul.style.gap = '0 20px';
  ul.style.gridTemplateColumns = '1fr 1fr';

  chart.data.labels.forEach((label, i) => {
    const li = document.createElement('li');
    li.style.display = 'flex';
    li.style.alignItems = 'center';
    li.style.marginBottom = '8px';

    const colorBox = document.createElement('span');
    colorBox.style.display = 'inline-block';
    colorBox.style.width = '12px';
    colorBox.style.height = '12px';
    colorBox.style.backgroundColor = chart.data.datasets[0].backgroundColor[i];
    colorBox.style.marginRight = '10px';
    colorBox.style.borderRadius = '3px';

    const text = document.createElement('span');
    text.textContent = label;
    text.style.flex = '1';
    text.style.textAlign = 'left';
    text.style.color = '#FFFFFF';
    text.style.fontSize = '12px';

    li.appendChild(colorBox);
    li.appendChild(text);
    ul.appendChild(li);
  });

  container.appendChild(ul);
}

// Стартовая инициализация
updateDataset('revenue');
updatePieChart(currentRange);

  //Фильт остатков
  function loadProducts(url = null) {
    const name = $('#filter-name').val();
    const status = $('#filter-status').val();

    $.ajax({
      url: url || '{{ route("admin.statistic.remains") }}',
      method: 'GET',
      data: {
        name: name,
        status: status
      },
      success: function (response) {
        $('#products-table').html(response);
      },
      error: function () {
        alert('Ошибка при загрузке данных');
      }
    });
  }

  // Кнопка фильтрации
  $('#filter-btn').on('click', function () {
    loadProducts();
  });

  // Пагинация
  $(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    const url = $(this).attr('href');
    loadProducts(url);
  });

    //Плашка источников
    // Функция рендера данных
    function renderSources(data) {
      const $container = $('#sources');
      $container.empty();

      data.forEach(item => {
        const html = `
          <div class="source">
            <div class="source-label">
              <span>${item.name}</span>
              <span>${item.value}</span>
            </div>
            <div class="progress-bar">
              <div class="progress ${item.color}" style="width: ${item.percent}%"></div>
            </div>
          </div>
        `;
        $container.append(html);
      });
    }

    // Загрузка по AJAX
    function loadSources() {
      $.ajax({
        url: '{{ route("admin.statistic.sources") }}', // Заменить на нужный URL
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          renderSources(response);
        },
        error: function() {
          console.error('Ошибка загрузки данных');
        }
      });
    }

    
      loadSources();
    
    $('#filter-button').on('click', function () {
        
        const fromDate = $('#date-from').val();
        const toDate = $('#date-to').val();
        const category = $('#category').val();
        statsAll(fromDate, toDate, category);
  });

    function statsAll(fromDate, toDate, category, time_range=false){
      if(time_range){
        const fromDate = $('#date-from').val('');
        const toDate = $('#date-to').val('');
        const category = $('#category').val('');
      }
      
      $.ajax({
            url: '{{ route("admin.statistic.filter") }}', // Замените на свой маршрут Laravel
            method: 'POST',
            data: {
                from: fromDate,
                to: toDate,
                category: category,
                timerange: time_range,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                // Предположим, что сервер возвращает объект:
                // { ordersCount: 123, totalAmount: "1 234,56", netProfit: "567,89", averageCheck: "123,45" }

                const values = [
                    response.ordersCount,
                    response.totalAmount,
                    response.netProfit,
                    response.averageCheck
                ];

                $('#statPl .text-2xl').each(function (index) {
                    $(this).text(values[index]);
                });
            },
            error: function () {
                alert('Ошибка загрузки данных');
            }
        });

}
  });
</script>


<script type="text/javascript">
    const input = document.querySelector('.date-input');

input.addEventListener('focus', function(){
  this.type = 'date';
  $(this).trigger('click');
});
input.addEventListener('blur', function(){
  if(this.value === '') {
    this.type = 'text';
  }
});
</script>

<script type="text/javascript">
    const input2 = document.querySelector('.date-input2');

input2.addEventListener('focus', function(){
  this.type = 'date';
  $(this).trigger('click');
});
input2.addEventListener('blur', function(){
  if(this.value === '') {
    this.type = 'text';
  }
});
</script>


@endsection


