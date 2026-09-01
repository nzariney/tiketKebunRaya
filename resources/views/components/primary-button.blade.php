<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-brand-orange border border-transparent rounded-md font-bold text-xs text-brand-green uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-brand-green focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>
