<div class="lcPageAddChars__title">
    Техническое характеристики
</div>
@foreach($attributes as $attribute)
<div class="lcPageAddChar">
    <span>{{ $attribute->name }}</span>
    @if(isset($productAttr[$attribute->id]))
        {{ Form::text("attribute[$attribute->id]", $productAttr[$attribute->id], ['class' => 'catalogTop__sort']) }}
    @else
        {{ Form::text("attribute[$attribute->id]", '', ['class' => 'catalogTop__sort']) }}
    @endif
</div>
@endforeach
