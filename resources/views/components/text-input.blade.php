@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-[var(--paper-card)] text-[var(--ink)] border-[var(--line)] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
