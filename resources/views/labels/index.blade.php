<x-app-layout>
    <x-header>
        {{ __('Labels')}}
    </x-header>

    @auth
    <div>
        <x-primary-link href="{{ route('labels.create') }}">
            {{ __('Create label') }}
        </x-primary-link>
    </div>
    @endauth

    <table class="mt-4 dark:text-neutral-200">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('Description') }}</th>
                @auth
                    <th>{{ __('Actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <td>{{  $label->id }}</td>
                    <td>{{  $label->name   }}</td>
                    <td>{{  $label->description   }}</td>
                    <td>{{  $label->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('labels.destroy', $label)  }}">
                                {{ __('Delete') }}
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label)  }}">
                                {{ __('Change') }}
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $labels->links('pagination::tailwind') }}
    </div>
</x-app-layout>