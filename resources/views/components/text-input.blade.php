@props(['disabled' => false, 'value' => '', 'name' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] px-4 py-2 rounded-lg w-full focus:outline-none focus:border-gray-400'])!!} name="{{$name}}" value="{{ html_entity_decode($value, ENT_QUOTES) }}">
