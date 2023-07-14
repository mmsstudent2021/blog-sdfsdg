<div {{ $attributes->merge(['class' => 'card '.$classes]) }}>
    <div class="card-header text-danger">{{ $cardTitle }}</div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
