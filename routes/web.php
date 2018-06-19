<?php
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Display All Tasks
 */
Route::get('/', function () {
    $tasks = \App\Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * Add a New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new \App\Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});
/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    \App\Task::findOrFail($id)->delete();

    return redirect('/');
});


