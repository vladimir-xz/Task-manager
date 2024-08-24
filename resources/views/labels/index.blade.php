<x-app-layout>
    <x-header>
        {{ __('Labels')}}
    </x-header>

    @can('create', App\Models\Label::class)
        <div>
            <x-primary-link href="{{ route('labels.create') }}">
                {{ __('Create label') }}
            </x-primary-link>
        </div>
    @endcan

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
                    <td>{{  __((string) $label->name)   }}</td>
                    <td>{{  $label->description   }}</td>
                    <td>{{  $label->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('delete', $label)
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('labels.destroy', $label)  }}">
                                {{ __('Delete') }}
                            </a>
                        @endcan
                        
                        @can('update', $label)
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label)  }}">
                                {{ __('Change') }}
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $labels->links('pagination::tailwind') }}
    </div>
</x-app-layout>