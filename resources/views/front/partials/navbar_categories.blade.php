<div class="catalogDropWrap">
    <div class="catalogDrop">
        @if (count($navbarCategories))

            <div class="catalogDrop__left">
            @foreach($navbarCategories as $category)
                @if($category->isActive() && $category->depth == 0)

                <a data-nav="{{ $category->id }}" href="{{ $category->getPath() }}" class="catalogDrop__item @if($loop->first) catalogDrop__item-active @endif">
                    {{ $category->title }}
                </a>
                @endif
            @endforeach
            </div>

            @foreach($navbarCategories as $k=>$category)
                @if($category->isActive())
                    @if($category->depth == 0)
                        @if($k == 0)
                            <div data-parent="{{ $category->id }}" class="catalogDrop__right catalogDrop__right-show">
                        @else
                            @if($navbarCategories[$k-1]->depth - $category->depth > 0)
                                </div>
                            @endif
                            </div>
                            <div data-parent="{{ $category->id }}" class="catalogDrop__right">
                        @endif
                    @else
                        @if($category->depth == 1)
                            @if($navbarCategories[$k-1]->depth - $category->depth > 0)
                                </div>
                            @endif
                            <div class="catalogDrop__menu">
                                <a href="{{ $category->getPath() }}">
                                    {{ $category->title }}
                                </a>
                        @else
                            <a href="{{ $category->getPath() }}">
                                {{ $category->title }}
                            </a>
                        @endif
                    @endif

                @endif
            @endforeach

            </div>
        @endif
    </div>
</div>


<div class="burgerDropWrap">
    <div class="burgerDrop">
        <div class="burgerDrop__close">
            <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="26px" height="9px">
                <path fill-rule="evenodd"  fill="rgb(51, 51, 51)"
                      d="M4.129,3.499 L26.000,3.499 L26.000,5.499 L4.129,5.499 L6.258,7.500 L4.710,9.000 L0.000,4.499 L4.710,-0.001 L6.258,1.500 L4.129,3.499 Z"/>
            </svg>
        </div>
        <div class="burgerDrop__title">
            Категории товаров
        </div>
        <form>
        <div class="burgerDropNav">
            @if (count($navbarCategories))
                @foreach($navbarCategories as $k=>$category)
                    @if($category->isActive())
                        @if($category->depth == 0)
                            <label class="burgerDropNav__item">
                                <input type="radio" name="cat" value="{{ $category->id }}">
                                <div class="radio">
                                    <span></span>
                                </div>
                                <span>{{ $category->title }}</span>
                                @if(isset($navbarCategories[$k+1]))
                                    @if($navbarCategories[$k+1]->depth > 0)
                                        @include('layouts.partials.front.item_mob_nav', ['navbarCategories' => $navbarCategories, 'current' => $k+1])
                                    @endif
                                @endif
                            </label>
                        @endif

                    @endif

                @endforeach


            @endif
        </div>
        <button class="burgerDrop__btn btn">
            Посмотреть
        </button>
        </form>
    </div>
</div>
