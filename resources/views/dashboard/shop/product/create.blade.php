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
                    <input type="text" placeholder="Введите название">
                </div>
                <div class="lcPageAddInp">
                    <span>
                        Производитель
                    </span>
                    <input type="text" placeholder="Введите бренд">
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
                    {{ Form::textarea('content', '', ['rows' => 'form-control']) }}
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
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span>30%</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                                      d="M-0.000,-0.000 L12.000,-0.000 L6.000,6.000 L-0.000,-0.000 Z"/>
                            </svg>
                            <div class="catalogSort__drop">
                                                    <span>
                                                        40%
                                                    </span>
                                <span>
                                                        50%
                                                    </span>
                                <span>
                                                        60%
                                                    </span>
                            </div>
                        </div>
                    </div>
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
                           ['class' => 'form-control', 'required' => 'required']
                           )
                   }}
                </div>
                <button class="lcPageAddBtn btn" type="submit">
                    Сохранить данные
                </button>
            </div>
            <div class="lcPageAddContentToggle lcPageAddContentToggle-hide lcPageAddImgs">
                <div class="lcPageAddImgs__title">
                    Добавьте изображения товара:
                </div>
                <p>Миниатюра</p>
                {{ Form::file('image') }}
                <p>Галерея</p>
                <div class="needsclick dropzone" id="document-dropzone"></div>

                <div class="lcPageAddImg">
                    <div class="lcPageAddImg__btns">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px">
                            <path fill-rule="evenodd"  fill="rgb(174, 174, 180)"
                                  d="M21.776,6.600 C20.733,4.825 19.317,3.420 17.529,2.384 C15.740,1.348 13.788,0.830 11.670,0.830 C9.553,0.830 7.600,1.348 5.811,2.384 C4.023,3.419 2.608,4.825 1.564,6.600 C0.520,8.375 -0.002,10.314 -0.002,12.416 C-0.002,14.518 0.520,16.456 1.564,18.231 C2.607,20.006 4.023,21.412 5.811,22.448 C7.600,23.484 9.552,24.001 11.670,24.001 C13.787,24.001 15.740,23.484 17.529,22.448 C19.317,21.412 20.732,20.006 21.776,18.231 C22.820,16.456 23.341,14.518 23.341,12.416 C23.341,10.314 22.820,8.375 21.776,6.600 ZM17.113,10.578 L11.649,16.090 C11.522,16.219 11.368,16.283 11.186,16.283 C11.012,16.283 10.861,16.219 10.734,16.090 L7.091,12.416 C6.971,12.294 6.910,12.142 6.910,11.959 C6.910,11.769 6.970,11.614 7.091,11.492 L8.007,10.578 C8.134,10.450 8.285,10.386 8.460,10.386 C8.634,10.386 8.785,10.450 8.913,10.578 L11.186,12.873 L15.292,8.741 C15.419,8.612 15.570,8.548 15.744,8.548 C15.919,8.548 16.070,8.612 16.197,8.741 L17.113,9.655 C17.234,9.776 17.294,9.932 17.294,10.121 C17.294,10.304 17.234,10.457 17.113,10.578 Z"/>
                        </svg>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="25px" height="24px">
                            <path fill-rule="evenodd"  fill="rgb(174, 174, 180)"
                                  d="M12.923,-0.012 C6.248,-0.012 0.838,5.360 0.838,11.987 C0.838,18.612 6.248,23.985 12.923,23.985 C19.601,23.985 25.012,18.612 25.012,11.987 C25.012,5.360 19.601,-0.012 12.923,-0.012 ZM18.120,15.236 L16.195,17.144 C16.195,17.144 13.150,13.901 12.922,13.901 C12.698,13.901 9.652,17.144 9.652,17.144 L7.726,15.236 C7.726,15.236 10.997,12.256 10.997,11.991 C10.997,11.722 7.726,8.742 7.726,8.742 L9.652,6.829 C9.652,6.829 12.723,10.074 12.922,10.074 C13.122,10.074 16.195,6.829 16.195,6.829 L18.120,8.742 C18.120,8.742 14.848,11.765 14.848,11.991 C14.848,12.207 18.120,15.236 18.120,15.236 Z"/>
                        </svg>
                    </div>
                    <div class="lcPageAddImg__img">
                        <img src="img/photos/22.png" alt="">
                    </div>
                </div>
                <div class="lcPageAddImg lcPageAddImg-empty">
                    <div class="lcPageAddImg__img">
                        <img src="img/photos/22.png" alt="">
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
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Тип видеопамяти
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Разрядность шины видеопамяти
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Использование тепловых трубок
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Дополнительное питание
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Частота процессора
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Производитель видеокарты
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Графический процессор
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            NVIDIA GeForce GTX 1060
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Частота графического процессора
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Видеопамять (Мб)
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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
                <div class="lcPageAddChar">
                                        <span>
                                            Частота видеопамяти (МГц)
                                        </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort">
                            <span></span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
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


@push('scripts')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.

        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('gallery') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="gallery[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="gallery[]"][value="' + name + '"]').remove()
            },
            init: function () {
            }
        }
    </script>
@endpush

