@props(['label' => null])

<span {{ $attributes->class(['ui-status-badge']) }}>{{ $label ?? $slot }}</span>
