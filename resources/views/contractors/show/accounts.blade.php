<x-card title="Accounts" class="h-100">
    <x-slot name="options">
        <a href="{{ route('users.create', ['contractor' => $contractor->id]) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $contractor->users->count() )
    <x-table class="align-middle">
        <x-slot name="thead">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th></th>
        </tr>
        </x-slot>
        @foreach($contractor->users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-end">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
