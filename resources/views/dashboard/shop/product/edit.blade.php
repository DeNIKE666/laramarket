@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Редактирование товара</h4>
                    {{ Form::open(['route' =>  ['products.update', $product], 'files' => true, 'method' => 'put', 'class' => 'forms-sample']) }}
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Название</label>
                                {{ Form::text('title', $product->title, ['class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="form-group">
                                {!! $product->getImage('thumb') !!}
                                <br>
                                {{ Form::file('image') }}
                            </div>
                            <div class="form-group">
                                {{ Form::textarea('content', $product->content, ['class' => 'form-control']) }}
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Цена</label>
                                        {{ Form::number('price', $product->price, ['class' => 'form-control', 'required' => 'required']) }}
                                        <p>Процент кэшбэка - <b>{{ $product->part_cashback }}%</b></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Старая цена</label>
                                        {{ Form::number('old_price', $product->old_price, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Тип товара</label>
                                {{ Form::select(
                                        'group_product',
                                        [
                                            \App\Models\Product::TYPE_PRODUCT_FIZ => 'физический',
                                            \App\Models\Product::TYPE_PRODUCT_INFO => 'информационый'
                                        ],
                                       $product->group_product,
                                       ['class' => 'form-control', 'required' => 'required']
                                       )
                               }}
                            </div>

                            <div class="form-group">
                                <label for="document">Галерея</label>
                                <div class="needsclick dropzone" id="document-dropzone">

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                        <div class="col-lg-4">
                            @include('dashboard.shop.product.block.list_categories', ['categories' => $categories, 'active' => $product->category_id])
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    @parent
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
                    @if($product->getGallery())
                var files =
                {!! json_encode($gallery) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="gallery[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection
