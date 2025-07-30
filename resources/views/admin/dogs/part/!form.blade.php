@csrf

<div class="dublicates">

        <div class="dublicates_box">

            <p class='zag_digl'>Фото</p>

            <div class="flex_dovl_flex">

                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


            </div>

            <br>

            <p class='zag_digl'>Видео</p>

            <div class="flex_dovl_flex">

                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


                <div>
                    <label>
                        <input type="file" name="">
                        <img src="/img/dovn.png">
                    </label>
                </div>


            </div>

            <br>
    </div>

    <div class='flex_form_profuct'>
            <div class="form-group_flex">
            <p>Название</p>
            <input type="text" class='willi'  name="name" placeholder="Название"
                   required maxlength="100" value="">
        </div>
        <div class="form-group_flex">
            <p>Порода</p>
            <input type="text" class='willi' name="slug" placeholder="Порода"
                   required maxlength="100" value="">
        </div>


            <div class="flex_input">
                <div><p>Дата рождения</p> <input type="text"></div>
                <div><p>Цена</p> <input type="text"></div>
                <div><p>Старая цена</p> <input type="text"></div>

                <div><p>Скидка</p> <input type="text"></div>
                <div><p>Себестоимость</p> <input type="text"></div>
            </div>
    </div>



 <br>


 <p class='zag_digl'>Описание</p>
 <textarea></textarea>





</div>


<!--<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Наименование"
           required maxlength="100" value="{{ old('name') ?? $dog->name ?? '' }}">
</div>
<div class="form-group">
    <input type="date" class="form-control" name="date" placeholder="ДР"
           required maxlength="100" value="{{ old('date') ?? $dog->date ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="pric" placeholder="Цена"
           required maxlength="100" value="{{ old('pric') ?? $dog->pric ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="type" placeholder="Тип"
            maxlength="100" value="{{ old('type') ?? $dog->type ?? '' }}">
</div>



<div class="form-group">
    <textarea class="form-control" name="opis" placeholder="Описание"
              rows="4">{{ old('opis') ?? $dog->opis ?? '' }}</textarea>
</div>
<div class="form-group">
    <textarea class="form-control" name="video" placeholder="Видео"
              rows="4">{{ old('video') ?? $dog->video ?? '' }}</textarea>
</div>
<div class="form-group">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($dog->image)
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">
            Удалить загруженное изображение
        </label>
    </div>
@endisset

-->
<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>




<style>

    .delit{
            position: absolute;
    top: 0;
    right: 0;
    cursor: pointer;
    }

    .dobivka{
            position: absolute;
    right: 0;
    width: 193px;
    text-align: center;
    background: #B1FF87;
    color: #000;
    font-size: 14px;
    font-weight: 700;
    padding: 13px;
    border-radius: 9px;
    cursor: pointer;
    bottom: 21px;
    }

    .dublicates_box{
        position: relative;
    }

    .flex_dovl_flex input{
        display: none;
    }

    .flex_dovl_flex{
        display: flex;
        align-items: center;
        gap: 12px;
        background:#868686;
        padding: 14px 19px;
        border-radius: 9px;
    }



    .btn-primary{
        font-size: 18px;
    width: 100%;
    padding-top: 24px;
    padding-bottom: 25px;
    margin-top: 22px;
    text-transform: capitalize;
    }

    .preview-image {
        position: relative;
        margin: 5px;
    }

    .preview-image img {
        width: 150px;
        height: auto;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .remove-image {
        position: absolute;
        top: -8px;
        right: -8px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 14px;
        cursor: pointer;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 18px;
    }

    .line{
        background: #ABABAB;
        width: 100%;
        height: 2px;
        margin-top: 20px;
        margin-bottom: 13px;
    }
</style>
<script>
let selectedFiles = [];

$(document).ready(function () {
    $('#image-input').on('change', function (event) {
        const files = Array.from(event.target.files);

        // Добавляем новые файлы в массив (для отправки потом)
        files.forEach(file => {
            selectedFiles.push(file);
        });

        renderPreviews();
    });

    // Удаление изображений из визуального интерфейса и массива
    $('#image-preview-container').on('click', '.remove-image', function () {
        const index = $(this).data('index');
        selectedFiles.splice(index, 1);
        renderPreviews();
    });

    // Подмена данных input перед отправкой формы
    $('form').on('submit', function (e) {
        e.preventDefault(); // отменяем стандартную отправку

        const formData = new FormData(this);

        // Добавляем изображения вручную
        selectedFiles.forEach(file => {
            formData.append('images[]', file);
        });

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert('Успешно сохранено!');
                window.location.reload();
            },
            error: function (xhr) {
                alert('Ошибка при сохранении');
                console.log(xhr.responseText);
            }
        });
    });
});

function renderPreviews() {
    $('#image-preview-container').empty();
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const html = `
                <div class="preview-image">
                    <button class="remove-image" data-index="${index}">&times;</button>
                    <img src="${e.target.result}" alt="preview">
                </div>`;
            $('#image-preview-container').append(html);
        };
        reader.readAsDataURL(file);
    });
}
</script>



<style type="text/css">
    .flex_form_profuct{
        display: flex;
    gap: 14px;
    flex-wrap: wrap;
    }

    .form-group_flex{
        width: 48%;
    }

   .form-group_flex p{
            font-size: 16px;
    font-weight: 700;
    margin-bottom: 9px;
    }

    .flex_input p{
          font-size: 16px;
    font-weight: 700;
    margin-bottom: 9px;
    }

    .flex_input{
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .flex_input input{
            border-radius: 9px;
    font-size: 14px;
    padding: 9px 14px !important;
        background-color: #868686 !important;
    color: #ffffff !important;
    border: 1px solid #868686;
        max-width: 132px;
    }

    .zag_digl{
         font-size: 16px;
    font-weight: 700;
    margin-bottom: 9px;
    }

     .form-group_flex input.willi{
            width: 100%;
    border-radius: 9px;
    font-size: 14px;
    padding: 9px 14px !important;
     }

      .form-group_flex textarea{
         width: 100%;
    border-radius: 9px;
    font-size: 14px;
    padding: 9px 14px !important;
    height: 119px;
    font-weight: 500;

      }

      textarea{
         width: 100%;
    border-radius: 9px;
    font-size: 14px;
    padding: 9px 14px !important;
    height: 147px;
    font-weight: 500;

      }

      #categoryDropdown{
            border-radius: 9px;
    font-size: 14px;
    padding: 9px 14px !important;
    background-color: #868686;
      }

      #dropdownContent{
            font-size: 14px;
    padding: 9px 14px !important;
    font-weight: 500;
    background-color: #868686 !important;
    z-index: 99;
      }

      input[type="checkbox"]:checked {

    background: #00AAFF;
}

      #dropdownContent input{
width: 16px;
    height: 16px;
    appearance: auto;
    margin-top: -4px !important;
    margin-right: 5px;
}

.subcategory {
        padding-left: 24px;
        margin-top: 8px !important;
}

#dropdownContent label{
    margin-top: 8px !important;
}

.flex_sticer{
    display: flex;
    gap: 10px;
}

.flex_sticer input{
    display: none;
}

.flex_sticer img{
    margin: auto;
}

.flex_sticer div{
    width: 85px;
    text-align: center;
    background: #fff;
    height: 48px;
    margin: auto;
    border-radius: 9px;
    cursor: pointer;
}

.flex_sticer div.activ{
     background: #FFDAB0;
}
</style>

