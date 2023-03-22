@props(['disabled' => false, 'value' => '', 'name' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-800 text-gray-200 border-gray-700 border-[1px] px-4 py-2 rounded-lg w-full focus:outline-none focus:border-gray-400'])!!} name="{{$name}}" value="{{$value}}">
