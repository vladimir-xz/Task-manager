<a {{ $attributes->merge(['class' => 'items-center bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded tracking-widest active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150']) }}>
    {{ $slot  }}
</a>