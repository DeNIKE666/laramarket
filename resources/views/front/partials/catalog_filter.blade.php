<div class="catalogFilter">
    <form method="get" action="">

        <input type="hidden" name="fiter" value="1">
        <div class="catalogFilter__title catalogFilter-xs">
            <span>Фильтр</span>
            <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="12px" height="6px">
                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                      d="M-0.000,-0.001 L12.000,-0.001 L6.000,6.000 L-0.000,-0.001 Z"/>
            </svg>
        </div>
        <div class="catalogFilterWrap">
        <div class="catalogFilter__title">
             <span>Цена</span>
            <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="12px" height="6px">
                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                      d="M-0.000,-0.001 L12.000,-0.001 L6.000,6.000 L-0.000,-0.001 Z"/>
            </svg>
        </div>
        <div class="catalogFilter__price">
            <div class="filterPrices" data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}">
                <div class="filterPrice">
                     <span>от</span>
                    @if(request()->get('min_price') != '')
                        {{ Form::text('min_price', request()->get('min_price'), ["class" => "filterPrice-min", "onkeyup" => "this.value = this.value.replace(/[^\d]/g,'')"]) }}
                    @else
                        {{ Form::text('min_price', $minPrice, ["class" => "filterPrice-min", "onkeyup" => "this.value = this.value.replace(/[^\d]/g,'')"]) }}
                    @endif
                </div>
                <div class="filterPrice">
                     <span>до</span>
                    @if(request()->get('max_price') != '')
                        {{ Form::text('max_price', request()->get('max_price'), ["class" => "filterPrice-max", "onkeyup" => "this.value = this.value.replace(/[^\d]/g,'')"]) }}
                    @else
                        {{ Form::text('max_price', $maxPrice, ["class" => "filterPrice-max", "onkeyup" => "this.value = this.value.replace(/[^\d]/g,'')"]) }}
                    @endif
                </div>
            </div>
            <div class="filterRange"></div>
        </div>

        @foreach($filterProps as $id => $prop)

                <div class="catalogFilter__title">
                    <span>{{ $prop['name'] }}</span>
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="12px" height="6px">
                        <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                              d="M-0.000,-0.001 L12.000,-0.001 L6.000,6.000 L-0.000,-0.001 Z"/>
                    </svg>
                </div>

                <div class="catalogFilter__checks">

                    @foreach($prop['list'] as $item)
                    <div class="catalogFilter__check">
                        <label>
                            {{ Form::checkbox("attr[$id][]", $item['value'], $item['status']) }}
                            <span>{{ $item['value'] }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>

        @endforeach



        <button type="submit" class="catalogFilter__btn btn">
            Применить
        </button>
        <button class="catalogFilter__btn btn btn-blue">
            Сбросить фильтры
        </button>
    </div>
    </form>
</div>
