<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10),
    ]);
})->name('tasks.index');

Route::get('/tasks/create', function () {
    return view('create');
})->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task,
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    // The findOrFail and firstOrFail methods will retrieve the first result of the query; however, if no result is found, an Illuminate\Database\Eloquent\ModelNotFoundException will be thrown:
    // If the ModelNotFoundException is not caught, a 404 HTTP response is automatically sent back to the client:
    return view('show', [
        'task' => $task,
    ]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()
        ->route('tasks.show', $task->id)
        ->with('success', 'Task created successfully.');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()
        ->route('tasks.show', $task->id)
        ->with('success', 'Task updated successfully.');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()
        ->route('tasks.index')
        ->with('success', 'Task deleted successfully.');
})->name('tasks.destroy');

Route::fallback(function () {
    return 'Sorry, the page you are looking for could not be found.';
});
