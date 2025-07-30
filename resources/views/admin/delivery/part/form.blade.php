@csrf
<div class="form-group">
    <input type="text" class="form-control w-25 d-inline mr-4" name="name" placeholder="Название службы доставки"
           required value="{{ old('name') ?? $delivery->name ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control w-25 d-inline mr-4" placeholder="Данные API"
           name="api_data" value="{{ old('api_data') ?? $delivery->api_data ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control w-25 d-inline mr-4" name="max_weight" placeholder="Максимальный мес отправки"
           value="{{ old('max_weight') ?? $delivery->max_weight ?? '' }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
