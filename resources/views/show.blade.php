@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <p>{{ $task->description }}</p>
    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endif

    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>

    <div>
        <button>
            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit</a>
        </button>
    </div>

    <div>
        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
