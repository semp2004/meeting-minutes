<button {{ $attributes->merge(['type' => 'submit', 'class' => 'middle none center mr-3 rounded-lg border border-green-400 py-3 px-6 font-sans text-xs font-bold uppercase text-green-400 transition-all hover:opacity-75 focus:ring focus:ring-green-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none']) }}>
    {{ $slot }}
</button>

