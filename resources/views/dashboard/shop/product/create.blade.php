@php
    /** @var \App\Models\Product $product */
    $product = $product ?? null;

    /** @var \Illuminate\Support\Collection $categories */
@endphp

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

        {{ Form::open(['route' => 'products.store', 'files' => true, 'method' => 'post']) }}
        <div class="lcPageAddContent">
            {{-- Основные данные --}}
            <div class="lcPageAddContentToggle lcPageAddInps">
                <div class="lcPageAddInp">
                    <span>Название товара</span>
                    {{ Form::text('title', optional($product)->title, ['placeholder' => 'Введите название']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>Производитель</span>
                    {{ Form::text('brand', optional($product)->brand, ['placeholder' => 'Введите бренд']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>Выбор категории</span>
                    @include('dashboard.shop.product.block.list_categories', ['categories' => $categories, 'active' => optional($product)->category_id])
                </div>
                <div class="lcPageAddInp lcPageAddInp-text">
                    <span>Описание товара</span>
                    {{ Form::textarea('content', optional($product)->content, ['class' => 'textarea']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>Цена товара (руб.)</span>
                    {{ Form::number('price', optional($product)->price, ['placeholder' => 'Введите цену']) }}
                </div>
                <div class="lcPageAddInp">
                    <span>Комиссия сервиса</span>
                    {{
                        Form::select(
                            'part_cashback',
                            [
                                30 => 30,
                                35 => 35,
                                40 => 40,
                                45 => 45,
                                50 => 50,
                                55 => 55,
                                60 => 60,
                                65 => 65,
                                70 => 70
                            ],
                           optional($product)->part_cashback,
                           ['class' => 'form-control select']
                        )
                   }}
                </div>
                <div class="lcPageAddInp">
                    <span>Тип товара</span>
                    {{
                        Form::select(
                            'group_product',
                            [
                                \App\Models\Product::TYPE_PRODUCT_REAL => 'физический',
                                \App\Models\Product::TYPE_PRODUCT_INFO => 'информационый'
                            ],
                           optional($product)->group_product,
                           ['class' => 'form-control select']
                        )
                   }}
                </div>
                <div class="lcPageAddInp">
                    <span>Старая цена товара (руб.)</span>
                    {{ Form::number('old_price', optional($product)->old_price, ['placeholder' => 'Введите цену']) }}
                </div>
                {{ Form::submit('Сохранить данные', ['class' => 'lcPageAddBtn btn']) }}
            </div>

            {{-- Изображения --}}
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
                                <svg xmlns="http://www.w3.org/2000/svg"
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
                                <svg xmlns="http://www.w3.org/2000/svg"
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

            {{-- Технические характеристики --}}
            <div
                    id="createProductAttribute"
                    class="lcPageAddContentToggle lcPageAddContentToggle-hide lcPageAddChars js_list_attributes"
                    data-url="{{ route('product_attributes') }}"
                    data-id="{{ optional($product)->id }}"
            >
                <div class="lcPageAddChars__title">
                    Технические характеристики
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection