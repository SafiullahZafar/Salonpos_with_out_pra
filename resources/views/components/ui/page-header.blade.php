@props([
    'title',
    'description' => null,
    'eyebrow' => null,
])

<header {{ $attributes->class(['ui-page-header']) }}>
    <div>
        @if($eyebrow)
            <div class="ui-page-header__eyebrow">{{ $eyebrow }}</div>
        @endif
        <h1 class="ui-page-header__title">{{ $title }}</h1>
        @if($description)
            <p class="ui-page-header__description">{{ $description }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="ui-page-header__actions">{{ $actions }}</div>
    @endisset
</header>
