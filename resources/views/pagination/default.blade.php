@if ($paginator->lastPage() > 1)
    <div class="block-pag">
        <div class="wrapper">
            <div class="pag">
                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <a href="{{ $paginator->url($i) }}" class="pagItem {{ ($paginator->currentPage() == $i) ? ' pagItem-active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor
            </div>
        </div>
    </div>
@endif