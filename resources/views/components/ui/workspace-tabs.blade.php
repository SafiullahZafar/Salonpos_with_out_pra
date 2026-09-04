@props(['label', 'tabs'])

<nav {{ $attributes->class(['ui-workspace']) }} aria-label="{{ $label }} workspace">
    <div class="ui-workspace__label">{{ $label }}</div>
    <div class="ui-workspace__tabs" role="list">
        @foreach($tabs as $tab)
            <a href="{{ $tab['href'] }}"
               class="ui-workspace__tab {{ $tab['active'] ? 'is-active' : '' }}"
               @if($tab['active']) aria-current="page" @endif>
                @if(!empty($tab['icon']))<span aria-hidden="true">{{ $tab['icon'] }}</span>@endif
                {{ $tab['label'] }}
            </a>
        @endforeach
    </div>
</nav>
