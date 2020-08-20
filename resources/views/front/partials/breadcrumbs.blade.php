@if (count($breadcrumbs))
<div class="block-bc">
    <div class="wrapper">
        <div class="bc">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                    <span>></span>
                @else
                    <a class="active">{{ $breadcrumb->title }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endif