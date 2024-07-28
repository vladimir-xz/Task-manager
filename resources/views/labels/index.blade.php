<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Labels')}}</h1>
    </x-slot>

    @auth
    <div>
        <x-primary-link href="{{ route('labels.create') }}">
            {{ __('Create label') }}
        </x-primary-link>
    </div>
    @endauth

    <table class="mt-4 dark:text-neutral-400">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <td>{{  $label->id }}</td>
                    <td>{{  $label->name   }}</td>
                    <td>{{  $label->description   }}</td>
                    <td>{{  $label->created_at->format('d.m.Y') }}</td>
                    <td>
                        @auth
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('labels.destroy', $label)  }}">
                                {{ __('Delete') }}
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label)  }}">
                                {{ __('Change') }}
                            </a>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $labels->links('pagination::tailwind') }}
    </div>
</x-app-layout>