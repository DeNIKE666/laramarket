@extends('layouts.admin')

@section('content')

    <div class="lcPageAdd">
        <div class="lcPageAddTop">
            <button class="active">
                Описание
            </button>
            <button>
                Изображения
            </button>
            <button>
                Характеристики
            </button>
        </div>
        {{ Form::open(['route' =>  'products.store', 'files' =>	true, 'method' => 'post']) }}
        <div class="lcPageAddContent">
            <div class="lcPageAddContentToggle lcPageAddInps">
                <div class="lcPageAddInp">
                    <span>
                        Название товара
                    </span>
                    {{ Form::text('title', '', ['placeholder' => 'Введите название', 'required' => 'required']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>
                        Производитель
                    </span>
                    {{ Form::text('brand', '', ['placeholder' => 'Введите бренд', 'required' => 'required']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>
                        Выбор категории
                    </span>
                    @include('dashboard.shop.product.block.list_categories', ['categories' => $categories, 'active' => ''])
                </div>
                <div class="lcPageAddInp lcPageAddInp-text">
                    <span>
                        Описание товара
                    </span>
                    {{ Form::textarea('content', '', ['class' => 'textarea']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>
                        Цена товара (руб.)
                    </span>
                    {{ Form::number('price', '', ['placeholder' => 'Введите цену', 'required' => 'required']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>
                        Комиссия сервиса
                    </span>
                    {{ Form::select(
                            'part_cashback',
                            [
                                30=>30,
                                35=>35,
                                40=>40,
                                45=>45,
                                50=>50,
                                55=>55,
                                60=>60,
                                65=>65,
                                70=>70
                            ],
                           null,
                           ['class' => 'form-control select', 'required' => 'required']
                           )
                   }}
                </div>
                <div class="lcPageAddInp">
                    <span>
                        Тип товара
                    </span>
                    {{ Form::select(
                            'group_product',
                            [
                                \App\Models\Product::TYPE_PRODUCT_FIZ => 'физический',
                                \App\Models\Product::TYPE_PRODUCT_INFO => 'информационый'
                            ],
                           \App\Models\Product::TYPE_PRODUCT_FIZ,
                           ['class' => 'form-control select', 'required' => 'required']
                           )
                   }}
                </div>
                <div class="lcPageAddInp">
                    <span>
                        Старая цена товара (руб.)
                    </span>
                    {{ Form::number('old_price', '', ['placeholder' => 'Введите цену']) }}
                </div>
                <button class="lcPageAddBtn btn" type="submit">
                    Сохранить данные
                </button>
            </div>
            <div class="lcPageAddContentToggle lcPageAddContentToggle-hide lcPageAddImgs">
                <div class="lcPageAddImgs__title">
                    Добавьте изображения товара:
                </div>
                <div class="lcPageAddImgs__wrap">
                    <div class="userRegRow">
                        <div class="userRegInp userRegInp-photo">
                            <span>Миниатюра</span>
                            <label for="file-upload">
                                <input name="image" multiple id="file-upload" type="file" readonly=""
                                       placeholder="Картинки">
                                <span>Картинки</span>
                            </label>
                            <div class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="22px" height="25px">
                                    <path fill-rule="evenodd" fill="rgb(35, 35, 35)"
                                          d="M21.712,9.718 C21.330,9.328 20.713,9.330 20.333,9.722 L8.608,21.808 C7.087,23.368 4.617,23.368 3.093,21.806 C1.570,20.244 1.570,17.711 3.093,16.149 L15.164,3.707 C16.114,2.733 17.658,2.733 18.610,3.709 C19.563,4.685 19.563,6.268 18.610,7.245 L8.610,17.498 C8.609,17.499 8.609,17.499 8.608,17.500 C8.227,17.889 7.612,17.888 7.231,17.498 C6.850,17.108 6.850,16.475 7.231,16.084 L12.058,11.134 C12.439,10.744 12.439,10.110 12.058,9.720 C11.677,9.329 11.060,9.329 10.679,9.720 L5.852,14.670 C4.709,15.842 4.709,17.741 5.852,18.912 C6.995,20.084 8.847,20.084 9.990,18.912 C9.991,18.911 9.992,18.910 9.993,18.908 L19.990,8.659 C21.704,6.901 21.704,4.052 19.990,2.294 C18.275,0.538 15.496,0.538 13.783,2.294 L1.712,14.737 C-0.571,17.078 -0.571,20.877 1.713,23.220 C3.999,25.563 7.705,25.563 9.989,23.220 L21.716,11.132 C22.096,10.741 22.094,10.107 21.712,9.718 Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lcPageAddImgs__wrap">
                    <div class="userRegRow">
                        <div class="userRegInp userRegInp-photo">
                            <span>Галерея</span>
                            <label for="file-upload2">
                                <input name="gallery[]" multiple id="file-upload2" type="file" readonly=""
                                       placeholder="Картинки">
                                <span>Картинки</span>
                            </label>
                            <div class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="22px" height="25px">
                                    <path fill-rule="evenodd" fill="rgb(35, 35, 35)"
                                          d="M21.712,9.718 C21.330,9.328 20.713,9.330 20.333,9.722 L8.608,21.808 C7.087,23.368 4.617,23.368 3.093,21.806 C1.570,20.244 1.570,17.711 3.093,16.149 L15.164,3.707 C16.114,2.733 17.658,2.733 18.610,3.709 C19.563,4.685 19.563,6.268 18.610,7.245 L8.610,17.498 C8.609,17.499 8.609,17.499 8.608,17.500 C8.227,17.889 7.612,17.888 7.231,17.498 C6.850,17.108 6.850,16.475 7.231,16.084 L12.058,11.134 C12.439,10.744 12.439,10.110 12.058,9.720 C11.677,9.329 11.060,9.329 10.679,9.720 L5.852,14.670 C4.709,15.842 4.709,17.741 5.852,18.912 C6.995,20.084 8.847,20.084 9.990,18.912 C9.991,18.911 9.992,18.910 9.993,18.908 L19.990,8.659 C21.704,6.901 21.704,4.052 19.990,2.294 C18.275,0.538 15.496,0.538 13.783,2.294 L1.712,14.737 C-0.571,17.078 -0.571,20.877 1.713,23.220 C3.999,25.563 7.705,25.563 9.989,23.220 L21.716,11.132 C22.096,10.741 22.094,10.107 21.712,9.718 Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="lcPageAddImgs__btn btn" type="submit">
                    Сохранить
                </button>
            </div>
            <div class="lcPageAddContentToggle lcPageAddContentToggle-hide lcPageAddChars">
                <div class="lcPageAddChars__title">
                    Техническое характеристики
                </div>
                <div class="lcPageAddChar">
                    <span>
                        Максимальное разрешение
                    </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd" fill="rgb(153, 153, 153)"
                                      d="M-0.000,-0.000 L12.000,-0.000 L6.000,6.000 L-0.000,-0.000 Z"/>
                            </svg>
                            <div class="catalogSort__drop">
                                                    <span>
                                                        Ещё одна категория
                                                    </span>
                                <span>
                                                        Другие товары
                                                    </span>
                                <span>
                                                        Новый продукт
                                                    </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{ Form::close() }}
    </div>



@endsection