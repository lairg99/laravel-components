@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'radio',
    'class' => 'full-rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 dark:bg-gray-900 dark:border-gray-800 dark:focus:ring-gray-900 dark:focus:border-gray-600 dark:focus:ring-offset-gray-900 focus:ring-opacity-50'
]) !!}>
