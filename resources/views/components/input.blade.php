@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-500 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm bg-gray-800 text-gray-200']) !!}>
