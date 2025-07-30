@extends('admin.layout.manage', ['title' => 'Все категории каталога'])

@section('manage-content')




    <div class="table-con p-3 mb-4" style="width: max-content;">
        <div class='flex_catalog'>

            <div>
                <div class="flex_zag">
                    <p class="zag">Категории</p>
                    <p class='save_cat save_cat_categori'>Редактировать</p>
                </div>

                <div class="flex_categori">
                    @foreach($items as $item)
                        <div data-podcat='podcat{{ $item->id }}' data-id='{{ $item->id }}' ><textarea readonly>{{ $item->name }}</textarea><img class="del_box" src="/img/del.png"></div>
                    @endforeach
                    <!-- <div data-podcat='podcat2'><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                    <div data-podcat='podcat3'><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                    <div data-podcat='podcat4'><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div> -->
                </div>
                <img class="dob_cat" src="/img/cat.png">

            </div>

            <div>

                <div class="flex_zag">
                    <p class="zag">Подкатегории</p>
                    <p class='save_cat save_cat_podcategori'>Редактировать</p>
                </div>

                <div class="all_podcat">
                @foreach($items as $item)
                    <div class="flex_podcat podcat{{ $item->id }}">
                        <div><textarea readonly>Сухой корм для собак{{ $item->id }}</textarea><img class="del_box" src="/img/del.png"></div>
                        <div><textarea readonly>Сухой корм для собак{{ $item->id }}</textarea><img class="del_box" src="/img/del.png"></div>
                        <div><textarea readonly>Сухой корм для собак{{ $item->id }}</textarea><img class="del_box" src="/img/del.png"></div>
                        <div><textarea readonly>Сухой корм для собак{{ $item->id }}</textarea><img class="del_box" src="/img/del.png"></div>
                    </div>
                @endforeach

                <!-- <div class="flex_podcat podcat2">
                    <div><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                    <div><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                    <div><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                </div>


                <div class="flex_podcat podcat3">
                    <div><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                    <div><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                    <div><textarea readonly>Сухой корм для собак</textarea><img class="del_box" src="/img/del.png"></div>
                </div> -->

                </div>

                 <img class="dob_podcat" src="/img/cat.png">

            </div>

        </div>


        <style type="text/css">


            .dob_cat{
                    width: 210.64px;
                    margin-top: 16px;
                    display: none;
                    cursor: pointer;
            }

            .del_box{
                position: absolute;
                right: 9px;
                top: 9px;
                cursor: pointer;
                display: none;
            }

            .dob_podcat{
                width: 210.64px;
                    margin-top: 16px;
                    display: none;
                    cursor: pointer;
            }




            .zag{
                    display: inline-block;
    font-family: 'Buyan';
    font-weight: 700;
    font-size: 60px;
    line-height: 105%;
    background: #fff;
    color: transparent;
    background-clip: text;
    -webkit-background-clip: text;
            }

            .flex_catalog{
                    display: flex;
                gap: 60px;
            }

            .flex_zag{
                display: flex;
                align-items: flex-end;
                gap: 63px;
                    margin-bottom: 20px;
                        justify-content: space-between;
            }


            .save_cat{
                    background-color: #9CC3FF;
    color: #000000;
    padding: 12px 25px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 700;
    text-align: center;
    transition: background-color 0.2s;
        margin-bottom: 9px;
            }

            .save_cat_activ{
                background-color: #FFD9AD;
            }

            .flex_categori{
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
                    max-width: 432px;
            }

            .flex_categori div{
                    padding: 10px 30px 10px 30px;
    background-color: #737373;
    border-radius: 10px;
    width: 205.64px;
    height: 123.47px;
    text-align: center;
    align-content: center;
    -webkit-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    -moz-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    line-height: 1;
    font-size: 19px;
    font-weight: 700;
    position: relative;
    cursor: pointer;
            }

            .flex_podcat{
                  display: flex;
                gap: 20px;
                flex-wrap: wrap;
                max-width: 659px;
            }

            .flex_podcat div{
                 padding: 10px 30px 10px 30px;
    background-color: #737373;
    border-radius: 10px;
    width: 205.64px;
    height: 123.47px;
    text-align: center;
    align-content: center;
    -webkit-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    -moz-box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    box-shadow: 0px 0px 26px -12px rgba(13, 16, 19, 1), 0px 5px 10px 2px rgba(217, 217, 217, 0.2) inset;
    line-height: 1;
    font-size: 19px;
    font-weight: 700;
    position: relative;
    cursor: pointer;
            }

            .flex_categori div.activ_type{
                background-color: #00A6FF;
            }

             .flex_podcategori_activ div.activ_type{
                background-color: #00A6FF;
            }

            .dob_cat_activ{
                display: block;
            }

            .dob_podcat_activ{
                display: block;
            }

            .flex_categori_activ .activ_type .del_box{
                display: block;
            }

            .flex_podcategori_activ .activ_type .del_box{
                display: block;
            }

            .flex_categori textarea{
                width: 100%;
    text-align: center;
    resize: none;
    overflow: hidden;
    background: none;
    background-color: #86868600 !important;
    border: 1px solid #86868600;
    min-width: 145px;
    min-height: 40px;
            }

            .flex_podcat textarea{
                  width: 100%;
    text-align: center;
    resize: none;
    overflow: hidden;
    background: none;
    background-color: #86868600 !important;
    border: 1px solid #86868600;
    min-width: 145px;
    min-height: 40px;
            }
        </style>

 <script>
        function getRandomInt(max) {
          return Math.floor(Math.random() * max);
        }


         $( "body" ).on( "click", ".dob_cat", function() {
            redon();
            var randpodcat = getRandomInt(999999);
            $('.flex_categori_activ').append('<div data-podcat="' + randpodcat + '" class=""><textarea readonly></textarea><img class="del_box" src="/img/del.png"></div>');

             $('.all_podcat').append('<div class="flex_podcat ' + randpodcat + '"></div>');
          })

           $( "body" ).on( "click", ".dob_podcat", function() {


             $('.flex_podcategori_activ').append('<div><textarea readonly></textarea><img class="del_box" src="/img/del.png"></div>');
          })




           function redon(){
                $('textarea').prop('readonly', true);
                $('.flex_categori_activ textarea').prop('readonly', false);
                $('.flex_podcategori_activ textarea').prop('readonly', false);
           }






        $( "body" ).on( "click", ".del_box", function() {
            redon();
            var podcat = $(this).parent().data('podcat');
            $(this).parent().detach();
            $('.' + podcat).detach();
          })


         function changeCount(){
            redon();
                 $('.flex_categori div').each(function() {
                var rating = $(this).data('podcat');

                if(!$(this).hasClass('activ_type')){

                    $('.' + rating).css('display', 'none');
                }else{
                     $('.' + rating).css('display', 'flex');
                };
             });
            }


          changeCount();


            $( "body" ).on( "click", ".flex_categori div", function() {
                 $('.flex_categori div').removeClass("activ_type");
                 $(this).addClass("activ_type");

                 $( ".flex_podcat" ).removeClass('flex_podcategori_activ');

                 $( ".save_cat_podcategori" ).html('Редактировать');
                 $( ".dob_podcat" ).removeClass('dob_podcat_activ');
                   $( ".save_cat_podcategori" ).removeClass('save_cat_activ');
                  changeCount();
             });



             $( "body" ).on( "click", ".flex_podcategori_activ div", function() {

                 $('.flex_podcategori_activ div').removeClass("activ_type");
                 $(this).addClass("activ_type");
                 redon();


             });


              $('.save_cat_categori').click(function(){

                $(this).toggleClass('save_cat_activ');
                $('.flex_categori').toggleClass('flex_categori_activ');

                $('.dob_cat').toggleClass('dob_cat_activ');
                 $( ".save_cat_podcategori" ).removeClass('save_cat_activ');
                $( ".dob_podcat" ).removeClass('dob_podcat_activ');
                 $( ".save_cat_podcategori" ).html('Редактировать');
                 $( ".flex_podcat" ).removeClass('flex_podcategori_activ');
                 if($(this).hasClass('save_cat_activ')){
                     $( ".save_cat_categori" ).html('Сохранить');
                    }else{
                       $( ".save_cat_categori" ).html('Редактировать');
                    }
                    redon();
             });

              $('.save_cat_podcategori').click(function(){
                $(this).toggleClass('save_cat_activ');


               var podcatactiv = $('.flex_categori .activ_type').data('podcat');
                    $('.' + podcatactiv + '.flex_podcat').toggleClass('flex_podcategori_activ');

                $('.flex_categori').removeClass('flex_categori_activ');
                $('.dob_podcat').toggleClass('dob_podcat_activ');
                $( ".save_cat_categori" ).removeClass('save_cat_activ');
                $( ".dob_cat" ).removeClass('dob_cat_activ');
                $( ".save_cat_categori" ).html('Редактировать');

                 if($(this).hasClass('save_cat_activ')){
                     $( ".save_cat_podcategori" ).html('Сохранить');
                    }else{
                       $( ".save_cat_podcategori" ).html('Редактировать');
                    }
                    redon();
             });


    </script>






<!--
        <div class="mb-3">
            <div class="d-flex" style="background-color: #868686; width: max-content; border-radius: 10px;">
            <a href="{{ route('admin.category.index') }}" class="butn {{ !$showArchived ? 'active' : '' }}"
            style="background-color: {{ !$showArchived ? '#fff' : '#A6A6A6' }}; color: {{ !$showArchived ? '#505050' : '#FFFFFF' }}; border-radius: 10px;">
                Активные
            </a>
            <a href="{{ route('admin.category.index', ['archived' => 1]) }}" class="butn {{ !$showArchived ? 'active' : '' }}"
            style="background-color: {{ $showArchived ? '#fff' : '#868686' }}; color: {{ $showArchived ? '#505050' : '#  ' }}; border-radius: 0 10px 10px 0;">
                Архив
            </a>
            </div>
        </div>
        <div class="gap-3">
        @foreach ($items->chunk(4) as $chunk)

        <div class="d-flex gap-3 pb-3" style="justify-content: space-around;">
            @foreach ($chunk as $category)
                <div class="products" style="position: relative;font-size: 21px;font-weight: bold;">
                    {{ $category->name }}

                    <div class="d-flex" style="font-size: 10px; font-weight: 600; gap: 10px; position: absolute; bottom: 0; right: 0; background-color:#393939; border-radius: 5px 0 5px 0;">
                        <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}" style="background-color:#9CC3FF; padding: 5px; border-radius: 5px 5px 0 0;">
                            редактировать
                        </a>
                        <form action="{{ route('admin.category.archive', ['category' => $category->id]) }}"
                        method="post" 
                        @if (!$showArchived)
                            onsubmit="return confirm('Переместить категорию в архив?')"
                        @else
                            onsubmit="return confirm('Восстановить категорию из архива?')"
                        @endif
                        >
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="m-0 border-0 bg-transparent" style="padding: 5px;">
                            @if (!$showArchived)
                                в архив
                            @else
                                из архива
                            @endif
                        </button>
                    </div>
 
            </form>
                </div>
            @endforeach
            
            {{-- Добавляем пустые div'ы если в последней группе меньше 4 элементов --}}
            @for ($i = 0; $i < 4 - $chunk->count(); $i++)
                <div class="products" style="visibility: hidden;"></div>
            @endfor
        </div>

        @endforeach
        </div>
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.category.create') }}" class="add-button whitespace-nowrap !rounded-button">Добавить</a>
        </div>
    -->

    </div>
@endsection
