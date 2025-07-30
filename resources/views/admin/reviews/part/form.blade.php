@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Имя"
           required maxlength="100" value="">
</div>

    <div class="ec-form__row ec-input-parent">
        <label for="reviewVideoForm-rating" style="margin-right: 7px;" class="control-label">Оценка:</label>
        <input type="hidden" name="rating" id="reviewVideoForm-rating" value="5">
        <div class="ec-rating ec-clearfix" data-storage-id="reviewVideoForm-rating">
            <div class="ec-rating-stars ec-rating-stars--default">
                <span data-rating="1" data-description="Плохо" class="active"></span>
                <span data-rating="2" data-description="Есть и получше" class="active"></span>
                <span data-rating="3" data-description="Средне" class="active"></span>
                <span data-rating="4" data-description="Хорошо" class="active"></span>
                <span data-rating="5" data-description="Отлично! Рекомендую!" class="active"></span>
            </div>

        </div>
        <span class="ec-error help-block" id="reviewVideoForm-rating-error"></span>
    </div>

    <div class="form-group">
        <label for="reviewVideoForm-text" class="control-label">Ваше сообщение</label>
        <textarea name="text" class="form-control" placeholder="Комментарий" rows="5" id="reviewVideoForm-text"></textarea>
        <span class="ec-error help-block" id="reviewVideoForm-text-error"></span>
    </div>

            <div class="form-group">
            <label for="reviewVideoForm-files" style="margin-right: 7px;" class="control-label">Вложения</label>
            <input type="file" name="file" id="reviewVideoForm-files" multiple="multiple">
            <!-- <span class="ec-error help-block" id="reviewVideoForm-files-error"></span> -->
        </div>
<input type="hidden" name="isAdmin" value=1>    

            <div style="display:none">
            <label>
                <input type="checkbox" name="agree" value="1" checked> Я даю свое согласие на обработку персональных данных            </label>
        </div>

    <div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
