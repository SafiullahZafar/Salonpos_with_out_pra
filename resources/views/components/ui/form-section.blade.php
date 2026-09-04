@props(['title', 'description' => null])

<section {{ $attributes->class(['ui-form-section']) }}>
    <div class="ui-form-section__header">
        <h2>{{ $title }}</h2>
        @if($description)<p>{{ $description }}</p>@endif
    </div>
    <div class="ui-form-section__body">{{ $slot }}</div>
</section>
