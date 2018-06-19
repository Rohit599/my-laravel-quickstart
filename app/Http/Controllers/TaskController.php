<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function delete(Task $task)
    {
        $task->delete();

        // if you really are doing this as an ajax call; you don't want to
        // return a redirect...
        return redirect()->route('/')->with('info', 'Task deleted successfully');
    }
}
