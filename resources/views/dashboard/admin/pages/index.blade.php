@extends('layouts.admin')
@push('scripts')
    <script>
        $(document).ready(function () {
            $(".destroy-page").on("click", function (e) {
                e.preventDefault();

                const id = $(this).data("id");
                const action = $("#destroy-form").attr("action").replace(/0$/, id);

                $("#destroy-form")
                    .attr("action", action)
                    .submit();
            });
        });
    </script>
@endpush
@section('content')
    <div class="lcPageContentData">
        <a href="{{ route('admin.page.create') }}" style=" width: 200px" class="lcPageContentSort__btn btn">Добавить</a>
        <br><br>
        {{ Form::open(['route' => ['admin.page.destroy', ['page' => 0]], 'method' => 'delete', 'id' => 'destroy-form']) }}{{Form::close()}}
        <div class="lcPageContentTable">
            <div class="lcPageContentRow">
                <div class="lcPageContentCol ">
                    #
                </div>
                <div class="lcPageContentCol ">
                    Название
                </div>
                <div class="lcPageContentCol">
                    Url
                </div>
                <div class="lcPageContentCol">

                </div>
            </div>
            @foreach ($pages as $page)
                <div class="lcPageContentRow">
                    <div class="lcPageContentCol">
                        {{ $page->id }}
                    </div>
                    <div class="lcPageContentCol">
                        <a href="{{ route('admin.page.edit', $page) }}">
                            {{ $page->name }}
                        </a>
                    </div>
                    <div class="lcPageContentCol">
                        {{ $page->slug }}
                    </div>
                    <div class="lcPageContentCol">
                        <div class="lcPageContentCol__more">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="17px" height="5px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                      d="M14.250,4.219 C13.232,4.219 12.406,3.393 12.406,2.375 C12.406,1.357 13.232,0.531 14.250,0.531 C15.268,0.531 16.094,1.357 16.094,2.375 C16.094,3.393 15.268,4.219 14.250,4.219 ZM8.375,4.219 C7.357,4.219 6.531,3.393 6.531,2.375 C6.531,1.357 7.357,0.531 8.375,0.531 C9.393,0.531 10.219,1.357 10.219,2.375 C10.219,3.393 9.393,4.219 8.375,4.219 ZM2.469,4.219 C1.450,4.219 0.625,3.393 0.625,2.375 C0.625,1.357 1.450,0.531 2.469,0.531 C3.487,0.531 4.312,1.357 4.312,2.375 C4.312,3.393 3.487,4.219 2.469,4.219 Z"/>
                            </svg>
                            <div class="lcPageContentCol__drop">
                                <span>
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16px" height="16px">
                                        <path fill-rule="evenodd" fill="rgb(174, 174, 180)"
                                              d="M15.013,3.923 L14.346,4.590 L11.233,1.478 L11.900,0.810 C12.196,0.514 12.641,0.514 12.938,0.810 L15.013,2.886 C15.309,3.182 15.309,3.627 15.013,3.923 ZM6.080,12.896 L2.935,9.751 L10.168,2.519 L13.312,5.663 L6.080,12.896 ZM0.412,15.412 L1.894,10.816 L5.007,13.929 L0.412,15.412 Z"/>
                                   </svg>
                                   <a href="{{ route('admin.page.edit', $page->id) }}">
                                        Редактировать
                                   </a>
                                </span>
                                <span>
                                    <svg width="14px" xmlns="http://www.w3.org/2000/svg"
                                         version="1.1"
                                         id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M62.29,180l26.27,291.07C90.7,494.41,109.95,512,133.39,512H378.6c23.44,0,42.69-17.59,44.83-40.93L449.7,180H62.29z     M178.95,451.99c-0.24,0.01-0.47,0.01-0.68,0.01c-7.97,0-14.62-6.27-14.97-14.31l-9.55-212c-0.38-8.28,6.01-15.29,14.3-15.67    c9.37-0.27,15.29,6.05,15.64,14.29l9.55,212C193.62,444.59,187.24,451.61,178.95,451.99z M271,437c0,8.29-6.71,15-15,15    c-8.29,0-15-6.71-15-15V225c0-8.29,6.71-15,15-15c8.29,0,15,6.71,15,15V437z M348.69,437.69c-0.35,8.04-7,14.31-14.97,14.31    c-0.2,0-0.44,0-0.67-0.01c-8.29-0.38-14.68-7.4-14.3-15.68l9.55-212c0.38-8.24,6.33-14.44,15.65-14.29    c8.29,0.38,14.67,7.39,14.29,15.67L348.69,437.69z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M406,60h-45V45c0-24.81-20.19-45-45-45H196c-24.82,0-45,20.19-45,45v15h-45c-41.37,0-75,33.65-75,75v15h450v-15    C481,93.65,447.36,60,406,60z M331,60H181V45c0-8.28,6.73-15,15-15h120c8.26,0,15,6.72,15,15V60z"/>
                                            </g>
                                        </g>

                                        </svg>
                                    <a href="" data-id="{{ $page->id }}" class="destroy-page">
                                        Удалить
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection