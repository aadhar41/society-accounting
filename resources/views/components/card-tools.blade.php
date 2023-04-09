<div class="card-tools">
    @if((Request::is('*/list')))
    <a href="{{ $route }}" class="btn btn-{{ $type }}">
        <i class="fas fa-recycle"></i>&nbsp;
        {{ $title }}
    </a>
    @endif
    &nbsp;
    <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
    </button>
    <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
    </button>
</div>