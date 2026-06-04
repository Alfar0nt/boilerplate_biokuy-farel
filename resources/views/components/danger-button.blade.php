<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 bg-danger text-white border-none rounded-btn px-6 py-2.5 font-semibold text-sm cursor-pointer hover:opacity-95 active:scale-[0.98] transition-all duration-150']) }}>
    {{ $slot }}
</button>
