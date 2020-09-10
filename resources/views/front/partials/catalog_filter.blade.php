<div class="catalogFilter">
    {{ Form::open(['method' => 'get', 'id' => 'filter-form']) }}
    <div class="catalogFilter__title catalogFilter-xs">
        <span>Фильтр</span>
        <svg
                xmlns="http://www.w3.org/2000/svg"
                width="12px" height="6px">
            <path fill-rule="evenodd" fill="rgb(153, 153, 153)"
                  d="M-0.000,-0.001 L12.000,-0.001 L6.000,6.000 L-0.000,-0.001 Z"/>
        </svg>
    </div>
    <div class="catalogFilterWrap">
        <div class="catalogFilter__title">
            <span>Цена</span>
            <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="12px" height="6px">
                <path fill-rule="evenodd" fill="rgb(153, 153, 153)"
                      d="M-0.000,-0.001 L12.000,-0.001 L6.000,6.000 L-0.000,-0.001 Z"/>
            </svg>
        </div>
        <div class="catalogFilter__price">
            <div class="filterPrices">
                <div class="filterPrice">
                    <span>от</span>
                    {{ Form::text('min_price', $minPrice, ['id' => 'filter-price-min', "class" => "filterPrice-min", "onkeyup" => "this.value = this.value.replace(/[^\d]/g,'')"]) }}
                </div>
                <div class="filterPrice">
                    <span>до</span>
                    {{ Form::text('max_price', $maxPrice, ['id' => 'filter-price-max', "class" => "filterPrice-max", "onkeyup" => "this.value = this.value.replace(/[^\d]/g,'')"]) }}
                </div>
            </div>
            <div class="filterRange"></div>
        </div>

        {{ Form::text('attr', '', ['id' => 'filter-attr']) }}

        @foreach($catFilter as $filter)
            <div class="catalogFilter__title">
                <span>{{ $filter->name }}</span>
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="12px" height="6px">
                    <path fill-rule="evenodd" fill="rgb(153, 153, 153)"
                          d="M-0.000,-0.001 L12.000,-0.001 L6.000,6.000 L-0.000,-0.001 Z"/>
                </svg>
            </div>

            <div class="catalogFilter__checks catalog-filter">
                @foreach ($filter->children as $child)
                    <div class="catalogFilter__check">
                        <label class="check-inp">
                            {{ Form::checkbox('', $child->id) }}
                            <span>{{ $child['value'] }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        {{ Form::submit('Применить', ['class' => 'catalogFilter__btn btn']) }}
        <a href="{{ request()->url() }}" class="catalogFilter__btn btn btn-blue">
            Сбросить фильтры
        </a>
    </div>
    {{ Form::close() }}

</div>
@push('scripts')
    <script src="{{ asset('js/front/catalog.js') }}"></script>
@endpush