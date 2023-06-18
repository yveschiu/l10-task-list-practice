@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    <button>
        <a href="{{ route('tasks.create') }}">Create new task</a>
    </button>
    <div>
        <ul>
            @forelse ($tasks as $task)
                <li>
                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}">
                        {{ $task->title }}
                    </a>
                </li>
            @empty
                <p>no tasks</p>
            @endforelse
        </ul>


        @if ($tasks->count())
            <nav>
                {{ $tasks->links() }}}
            </nav>
        @endif
    </div>
@endsection
