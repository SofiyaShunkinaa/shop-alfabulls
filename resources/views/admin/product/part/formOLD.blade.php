@csrf


<div class='flex_form_profuct'>
    <div class="form-group_flex">
    <p>Наименование товара</p>
    <input type="text" class='willi'  name="name" placeholder="Наименование"
           required maxlength="100" value="{{ old('name') ?? $product->name ?? '' }}">
</div>
<div class="form-group_flex">
    <p>ЧПУ</p>
    <input type="text" class='willi' name="slug" placeholder="ЧПУ (на англ.)"
           required maxlength="100" value="{{ old('slug') ?? $product->slug ?? '' }}">
</div>

<div class="form-group_flex">
    <p>Описание товара</p>
    <textarea></textarea>
</div>


<div class="form-group_flex">
    <p>Состав</p>
    <textarea></textarea>
</div>


<div class="form-group_flex">
          <p>Категория</p>



            <div class="relative">
                <div  id="categoryDropdown" class="w-full   flex justify-between items-center">
                    <span id="selectedCategory">Выбрать категорию</span>
                    <i class="ri-arrow-down-s-line ri-lg"></i>
                </div>

                <div id="dropdownContent" class="dropdown-content hidden absolute left-0 right-0 top-full mt-1 rounded shadow-lg">
                    <div class="space-y-3">
                        <label class="flex  items-center">
                            <input type="checkbox"  class="mt-1">
                            <span>Раз</span>
                        </label>

                        <div class="subcategory space-y-3">
                            <label class="flex  items-center">
                                <input type="checkbox"    class="mt-1">
                                <span>Два</span>
                            </label>

                            <label class="flex  items-center">
                                <input type="checkbox"    class="mt-1">
                                <span>Два</span>
                            </label>


                        </div>

                        <label class="flex  items-center">
                            <input type="checkbox"     class="mt-1">
                            <span>Раз</span>
                        </label>

                        <label class="flex  items-center">
                            <input type="checkbox"   class="mt-1">
                            <span>Раз</span>
                        </label>


                    </div>
                </div>
            </div>
    </div>


    <div class="form-group_flex">
          <p>Стикер</p>

          <div class="flex_sticer">
                <label>
                    <div >
                      <input type="radio"  name="drone">
                      <img src="/img/stik1.png">
                    </div>
                </label>
                 <label>
                    <div >
                      <input type="radio"  name="drone">
                      <img src="/img/stik2.png">
                    </div>
                </label>
                 <label>
                    <div >
                      <input type="radio"  name="drone">
                      <img src="/img/stik3.png">
                    </div>
                </label>
                 <label>
                    <div >
                      <input type="radio"  name="drone">
                    </div>
                </label>
                 <label>
                    <div >
                      <input type="radio"  name="drone">
                    </div>
                </label>
          </div>

    </div>

</div>


<div class="line"></div>


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

            <div class="flex_input">
                <div><p>Размер/Вес</p> <input type="text"></div>
                <div><p>Цена</p> <input type="text"></div>
                <div><p>Старая цена</p> <input type="text"></div>
                <div><p>Себестоимость</p> <input type="text"></div>
                <div><p>Скидка</p> <input type="text"></div>
                <div><p>Размеры</p> <input type="text"></div>
                <div><p>Количество</p> <input type="text"></div>
                <div><p>Длина</p> <input type="text"></div>
                <div><p>Ширина</p> <input type="text"></div>
                <div><p>Высота</p> <input type="text"></div>
                <div><p>Вес</p> <input type="text"></div>
            </div>

            <p class="dobivka">Добавить</p>

            <div class="line"></div>


        </div>
</div>




<!--

<div class="form-group">

    <input type="text" class="form-control w-25 d-inline mr-4" placeholder="Новая цена! (руб.)"
           name="price" required value="{{ old('price') ?? $product->price ?? '' }}">

    <div class="form-check form-check-inline">
        @php
            $checked = false; // создание нового товара
            if (isset($product)) $checked = $product->new; // редактирование товара
            if (old('new')) $checked = true; // были ошибки при заполнении формы
        @endphp
        <input type="checkbox" name="new" class="form-check-input" id="new-product"
               @if($checked) checked @endif value="1">
        <label class="form-check-label" for="new-product">Новинка</label>
    </div>

    <div class="form-check form-check-inline">
        @php
            $checked = false; // создание нового товара
            if (isset($product)) $checked = $product->hit; // редактирование товара
            if (old('hit')) $checked = true; // были ошибки при заполнении формы
        @endphp
        <input type="checkbox" name="hit" class="form-check-input" id="hit-product"
               @if($checked) checked @endif value="1">
        <label class="form-check-label" for="hit-product">Лидер продаж</label>
    </div>

    <div class="form-check form-check-inline ">
        @php
            $checked = false; // создание нового товара
            if (isset($product)) $checked = $product->sale; // редактирование товара
            if (old('sale')) $checked = true; // были ошибки при заполнении формы
        @endphp
        <input type="checkbox" name="sale" class="form-check-input" id="sale-product"
               @if($checked) checked @endif value="1">
        <label class="form-check-label" for="sale-product">Распродажа</label>
    </div>
</div>
<div class="form-group">
  <lable>  Старая цена (Можно указать 0)<br>
<input type="text" class="form-control w-25 d-inline mr-4" placeholder="Старая цена! (руб.)"
           name="oldprice" required value="{{ old('oldprice') ?? $product->oldprice ?? '' }}">
       </lable>
</div>
<div class="form-group">
       <lable>
        Колличество<br>
<input type="text" class="form-control w-25 d-inline mr-4" placeholder="Колличество! (руб.)"
           name="col" required value="{{ old('col') ?? $product->col ?? '' }}">
       </lable>
</div>
<div class="form-group">
    <lable>Ширина mm<br>
     <input type="text" class="form-control w-25 d-inline mr-4" placeholder="Ширина"
           name="width" required value="{{ old('width') ?? $product->width ?? '' }}">
       </lable>
 </div>
 <div class="form-group">
    <lable>Высота mm<br>
     <input type="text" class="form-control w-25 d-inline mr-4" placeholder="Высота"
           name="height" required value="{{ old('height') ?? $product->height ?? '' }}">
       </lable>
 </div>
 <div class="form-group">
    <lable>Глубина mm<br>
     <input type="text" class="form-control w-25 d-inline mr-4" placeholder="Глубина"
           name="depth" required value="{{ old('depth') ?? $product->depth ?? '' }}">
       </lable>
 </div>
 <div class="form-group">
    <lable>Вес гр<br>
     <input type="text" class="form-control w-25 d-inline mr-4" placeholder="Вес"
           name="weight" required value="{{ old('weight') ?? $product->weight ?? '' }}">
       </lable>
 </div>
<div class="form-group">
    @php
        $category_id = old('category_id') ?? $product->category_id ?? 0;
    @endphp
    <select name="category_id" class="form-control" title="Категория">
        <option value="0">Выберите</option>
        @if (count($items))
            @include('admin.product.part.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>

<div class="form-group">
    <textarea class="form-control" name="content" placeholder="Описание"
              rows="4">{{ old('content') ?? $product->content ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="images">Загрузить изображения</label>
    <input type="file" class="form-control-file" name="images[]" id="image-input" multiple accept="image/*">
</div>

<div id="image-preview-container" class="d-flex flex-wrap mt-2"></div>


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


    <script>tailwind.config={theme:{extend:{colors:{primary:'#3b82f6',secondary:'#6b7280'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
   <script id="dropdownToggle">
      $('.flex_sticer div').click(function(){
                 $('.flex_sticer div').removeClass("activ");
                 $(this).addClass("activ");

                  changeCount();
             })

        $( "body" ).on( "click", ".dobivka", function() {
                 $('.dublicates').append('<div class="dublicates_box"> <p class="zag_digl">Фото</p> <div class="flex_dovl_flex"> <div> <label> <input type="file" name=""> <img src="/img/dovn.png"> </label> </div> <div> <label> <input type="file" name=""> <img src="/img/dovn.png"> </label> </div> <div> <label> <input type="file" name=""> <img src="/img/dovn.png"> </label> </div> <div> <label> <input type="file" name=""> <img src="/img/dovn.png"> </label> </div> <div> <label> <input type="file" name=""> <img src="/img/dovn.png"> </label> </div> <div> <label> <input type="file" name=""> <img src="/img/dovn.png"> </label> </div> </div> <br> <div class="flex_input"> <div><p>Размер/Вес</p> <input type="text"></div> <div><p>Цена</p> <input type="text"></div> <div><p>Старая цена</p> <input type="text"></div> <div><p>Себестоимость</p> <input type="text"></div> <div><p>Скидка</p> <input type="text"></div> <div><p>Размеры</p> <input type="text"></div> <div><p>Количество</p> <input type="text"></div> <div><p>Длина</p> <input type="text"></div> <div><p>Ширина</p> <input type="text"></div> <div><p>Высота</p> <input type="text"></div> <div><p>Вес</p> <input type="text"></div> </div> <p class="dobivka">Добавить</p> <div class="line"></div><img class="delit" src="/img/delit.png"></div>');
             });

         $( "body" ).on( "click", ".delit", function() {
            $(this).parent().detach();
          })

        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('categoryDropdown');
            const dropdownContent = document.getElementById('dropdownContent');
            const selectedCategory = document.getElementById('selectedCategory');
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Toggle dropdown
            dropdown.addEventListener('click', function() {
                dropdownContent.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.classList.add('hidden');
                }
            });

            // Update selected categories text
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateSelectedCategories();
                });
            });

            // Parent-child checkbox relationship for dry dog food
            const dryDogFood = document.getElementById('dryDogFood');
            const childCheckboxes = [
                document.getElementById('forPuppies'),
                document.getElementById('forPuppiesAllergy'),
                document.getElementById('forSmallBreeds'),
                document.getElementById('forLargeBreeds'),
                document.getElementById('forAdultAllergy')
            ];

            dryDogFood.addEventListener('change', function() {
                const isChecked = this.checked;
                childCheckboxes.forEach(function(checkbox) {
                    checkbox.disabled = !isChecked;
                    if (!isChecked) {
                        checkbox.checked = false;
                    }
                });
                updateSelectedCategories();
            });

            // Initialize child checkboxes state
            childCheckboxes.forEach(function(checkbox) {
                checkbox.disabled = !dryDogFood.checked;
            });

            function updateSelectedCategories() {
                const selectedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);

                if (selectedCheckboxes.length === 0) {
                    selectedCategory.textContent = 'Выбрать категорию';
                    selectedCategory.classList.add('text-gray-300');
                } else {
                    const selectedLabels = selectedCheckboxes.map(checkbox => {
                        return checkbox.nextElementSibling.textContent.trim();
                    });

                    if (selectedLabels.length <= 2) {
                        selectedCategory.textContent = selectedLabels.join(', ');
                    } else {
                        selectedCategory.textContent = `${selectedLabels.length} Выбрано категорий`;
                    }
                    selectedCategory.classList.remove('text-gray-300');
                }
            }
        });
    </script>