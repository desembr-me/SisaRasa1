@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-300 bg-indigo-100 focus:outline-none focus:text-indigo-300 focus:bg-indigo-200 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[var(--ink-soft)] hover:text-[var(--ink)] hover:bg-[var(--paper-warm)] hover:border-[var(--line)] focus:outline-none focus:text-[var(--ink)] focus:bg-[var(--paper-warm)] focus:border-[var(--line)] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
