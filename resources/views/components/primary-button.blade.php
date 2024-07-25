<button {{ $attributes->merge(['type' => 'submit', 'class' => 'items-center bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded dark:bg-gray-200 dark:text-gray-800 tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>