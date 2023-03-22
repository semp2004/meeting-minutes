<button {{ $attributes->merge(['type' => 'button', 'class' => 'middle none center mr-3 rounded-lg bg-pink-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-400/20 transition-all hover:shadow-lg hover:shadow-pink-400/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none']) }}>
 {{ $slot }}
</button>
