@csrf
<div class="form-group">
    <input type="text" class="form-control w-25 d-inline mr-4" name="percent" placeholder="Дисконт в процентах"
           required maxlength="2" value="{{ old('percent') ?? $discount->percent ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control w-25 d-inline mr-4" placeholder="При сумме заказов от"
           name="amount" required value="{{ old('amount') ?? $discount->amount ?? '' }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
