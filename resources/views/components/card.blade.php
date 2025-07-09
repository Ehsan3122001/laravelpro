<div class="col-md-4 mb-4">
    <div class="card border-left-{{ $color ?? 'primary' }} shadow h-100 py-2">
        <div class="card-body">
            <h5>{{ $title ?? 'Title' }}</h5>
            <h3>{{ $value ?? 0 }} {{ $suffix ?? '' }}</h3>
        </div>
    </div>
</div>
