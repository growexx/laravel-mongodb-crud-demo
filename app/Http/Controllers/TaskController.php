<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {

        $tasks = Task::latest()->paginate(10);

        $statusMap = Task::$statusMap;

        return view('index', compact('tasks', 'statusMap'));
    }

    public function create()
    {

        $statusMap = Task::$statusMap;

        return view('create', compact('statusMap'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'status' => 'required|numeric|min:0|not_in:0',
            'hoursRequired' => 'numeric|nullable|min:0|not_in:0',
            'hoursConsumed' => 'numeric|nullable|min:0|not_in:0',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {

        return view('show', compact('task'));
    }

    public function edit(Task $task)
    {

        $statusMap = Task::$statusMap;

        return view('edit', compact('task', 'statusMap'));
    }

    public function update(Request $request, Task $task)
    {

        $request->validate([
            'title' => 'required',
            'status' => 'required|numeric|min:0|not_in:0',
            'hoursRequired' => 'numeric|nullable|min:0|not_in:0',
            'hoursConsumed' => 'numeric|nullable|min:0|not_in:0',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
