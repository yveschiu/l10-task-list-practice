@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    <nav class="mb-4">
        <a class="link" href="{{ route('tasks.create') }}">Create new
            task</a>
    </nav>
    <div>
        <ul>
            @forelse ($tasks as $task)
                <li>
                    <a @class(['font-bold', 'line-through' => $task->completed]) href="{{ route('tasks.show', ['task' => $task->id]) }}">
                        {{ $task->title }}
                    </a>
                </li>
            @empty
                <p>no tasks</p>
            @endforelse
        </ul>

        @if ($tasks->count())
            <nav class="mt-4">
                {{ $tasks->links() }}
            </nav>
        @endif
    </div>
@endsection
