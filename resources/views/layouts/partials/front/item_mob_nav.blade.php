@if($navbarCategories[$current-1]->depth < $navbarCategories[$current]->depth)
<div class="burgerDropNav">
@endif
    <label class="burgerDropNav__item">
        <input type="radio" name="cat" value="{{ $navbarCategories[$current]->id }}">
        <div class="radio">
            <span></span>
        </div>
        <span>{{ $navbarCategories[$current]->title }}</span>
        @if(isset($navbarCategories[$current+1]))
            @if($navbarCategories[$current+1]->depth > 0 && $navbarCategories[$current+1]->depth > $navbarCategories[$current]->depth)
                @include('layouts.partials.front.item_mob_nav', ['navbarCategories' => $navbarCategories, 'current' => $current+1])
            @endif
        @endif
    </label>
    @if(isset($navbarCategories[$current+1]))
        @if($navbarCategories[$current+1]->depth > 0 && $navbarCategories[$current+1]->depth == $navbarCategories[$current]->depth)
            @include('layouts.partials.front.item_mob_nav', ['navbarCategories' => $navbarCategories, 'current' => $current+1])
        @endif
    @endif
@if($navbarCategories[$current-1]->depth < $navbarCategories[$current]->depth)
</div>
@endif