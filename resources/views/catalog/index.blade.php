@extends('layout.site', ['title' => 'Каталог товаров'])

@section('content')

    <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">Каталог</li></ol>
        </div>
    </div>
</section>
            <section class="catalog">
                <div class="catalog-bg-1"></div>
                <div class="catalog-bg-2"></div>
                <div class="catalog-bg-2 catalog-bg-2-2"></div>
                <div class="catalog-bg-2 catalog-bg-2-3"></div>
                <div class="catalog-bg-3"></div>
                <div class="catalog-bg-3 catalog-bg-3-2"></div>
                <div class="catalog-bg-3 catalog-bg-3-3"></div>
                <div class="wrapper">
                    <h1 class="anim-title">Каталог</h1>
                    <div class="catalog-nav">
                        <ul class="">



                        @foreach ($roots as $root)
                            @include('catalog.part.category', ['category' => $root])
                        @endforeach
                    </div>
                    <h2 class="anim-title"></h2>
                    <div class="catalog-items parent-animation">



                           @foreach ($products as $product)
           @include('catalog.part.product', ['product' => $product])
        @endforeach






                    </div>

                </div>
            </section>

            <div class="to-top" data-action="gotop">
                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 8H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 13H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 18H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 20V4L20 8" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>




 <script>


         function changeCount(){
                 $('.type_flex div').each(function() {
                var rating = $(this).data('class');

                if(!$(this).hasClass('activ_type')){

                    $(this).parent().parent().parent().find('.' + rating).css('display', 'none');
                }else{
                     $(this).parent().parent().parent().find('.' + rating).css('display', 'inline');
                };
             });
            }


          changeCount();


             $('.type_flex div').click(function(){
                 event.preventDefault();
                  $(this).parent().parent().parent().find('.type_flex div').removeClass("activ_type");
                  let variantId = $(this).data('variantid');
                  let wrapper = $(this).closest('.catalog-item-desc');

                  

                    wrapper.find('input[name="variant_id"]').val(variantId);
                 console.log(wrapper);
                  $(this).addClass("activ_type");

                  changeCount();
             })
    </script>

    <style>
                                .type_flex{
                                    display: flex;
                                    align-items: center;
                                        gap: 13px;
                                    margin-bottom: 22px;
                                    margin-top: -20px;
                                }

                                .type_flex div{
                                      min-width: 44px;
    text-align: center;
    border: 1px solid #807A74;
    color: #807A74;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 9px 0px 8px;
    font-family: 'Buyan';
    border-radius: 10px;
    cursor: pointer;

                                }

                                 .type_flex div.activ_type{
                                    border: 1px solid #fff;
                                        color: #fff;
                                 }


                                 .nonvisibl{
                                    display: none;
                                 }

                                 .dont_visibl{
                                    opacity: 0;
                                 }
                            </style>


@endsection


