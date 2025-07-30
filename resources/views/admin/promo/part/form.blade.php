@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Наименование"
           required maxlength="100" value="{{ old('name') ?? $promo->name ?? '' }}">
</div>


<div class="form-group">
    <!-- цена (руб) -->
    <input type="text" class="form-control w-25 d-inline mr-4" placeholder="наминал (руб.)"
           name="pric" required value="{{ old('price') ?? $promo->pric ?? '' }}">
    <!-- новинка -->


</div>
<div class="form-group">
  <lable>  Дата старта
<input type="datetime-local" class="form-control w-25 d-inline mr-4" placeholder="Старая цена! (руб.)"
           name="datastart" required value="{{ old('datastart') ?? $promo->datastart ?? '' }}">
       </lable>

       <lable>
        Дата конца
<input type="datetime-local" class="form-control w-25 d-inline mr-4" placeholder="Колличество! (руб.)"
           name="datastop" required value="{{ old('datastop') ?? $promo->datastop ?? '' }}">
       </lable>
</div>




<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
