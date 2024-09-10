<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Brian2694\Toastr\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {

        // function for greetings
        $hour = Carbon::now()->hour;
        // dd($hour);
        $greeting = '';
        if ($hour >= 0 && $hour < 12) {
            $greeting = "Good Morning";
        } else if ($hour >= 12 && $hour < 15) {
            $greeting = "Good Noon";
        } else if ($hour >= 15 && $hour < 18) {
            $greeting = "Good Afternoon";
        } else {
            $greeting = "Good Evening";
        }

        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks', 'greeting'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Something went wrong');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $task = Task::create($request->all());
        if ($task) {
            toastr()->success('New task created successfully');
            return redirect()->route('task.index');
        }
        toastr()->error('Something went wrong');
        return redirect()->back();
    }

    public function update(Request $request, Task $task)
    {
        if ($task) {
            $task->update($request->all());
            toastr()->success('Task completed successfully');
            return redirect()->back();
        }
        toastr()->error('Something went wrong');
        return redirect()->back();

    }

    public function destroy(Task $task)
    {
        if ($task) {
            $task->delete();
            toastr()->error('Your task has been deleted');
            return redirect()->back();
        }
        toastr()->error('Something went wrong');
        return redirect()->back();
    }
}
