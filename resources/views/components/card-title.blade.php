<div>
    <h3 class="card-title">
        <a href="{{ $route }}" class="btn btn-{{ $type }}">
            @if(str_contains($route, 'create'))
            <i class="fa fa-plus-circle"></i>&nbsp;
            @else
            <i class="fas fa-arrow-circle-left"></i>&nbsp;
            @endif
            {{ $title }}
        </a>
    </h3>
</div>