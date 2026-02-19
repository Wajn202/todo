<table width="100%" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Owner</th>
            <th>Assigned to</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    @forelse($todos as $todo)
        <tr>
            <td>{{ $todo->name }}</td>

            {{-- Status --}}
            <td>
              @php
                    $userId = auth()->id();
                    $isOwner = optional($todo->project)->owner_id === $userId;
                    $isassignedUser = $todo->assigned_to && (int)$todo->assigned_to === $userId;
                @endphp

                @if($isOwner || $isassignedUser)
                    <form method="POST" action="{{ route('todos.status', $todo) }}">
                        @csrf
                        @method('PATCH')

                        <select name="status" onchange="this.form.submit()">
                            <option value="todo" {{ $todo->status === 'todo' ? 'selected' : '' }}>Todo</option>
                            <option value="in Progress" {{ $todo->status === 'in Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ $todo->status === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </form>
                @else
                    <span class="status {{ $todo->status }}">
                        {{ ucfirst(str_replace('_',' ', $todo->status)) }}
                    </span>
                @endif
            </td>

            {{-- Owner --}}
            <td>{{ $todo->creator->name }}</td>

            {{-- Assigned to --}}
            <td>
            @if($todo->assigned_to)
             {{ \App\Models\User::find($todo->assigned_to)->name ?? 'Unknown' }}
            @else
              Unassigned
            @endif
            </td>

            {{-- Actions --}}
            <td class="text-right">
                @if(auth()->id() === optional($todo->project)->owner_id)
                    <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary">Edit</a>

                    <form method="POST" action="{{ route('todos.destroy', $todo) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No tasks found.</td>
        </tr>
    @endforelse
    </tbody>
</table>