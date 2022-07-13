<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    const VALIDATION = "numeric|nullable|min:0|not_in:0";
    const ROUTETOINDEX = "tasks.index";

    public function index()
    {

        $tasks = Task::latest()->paginate(10);

        $statusMap = Task::$statusMap;

        return view('index', compact('tasks', 'statusMap'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|numeric|min:0|not_in:0',
            'hoursRequired' => $this::VALIDATION,
            'hoursConsumed' => $this::VALIDATION,
        ]);

        Task::create($request->all());

        return redirect()->route($this::ROUTETOINDEX)
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
            'hoursRequired' => $this::VALIDATION,
            'hoursConsumed' => $this::VALIDATION,
        ]);

        $task->update($request->all());

        return redirect()->route($this::ROUTETOINDEX)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route($this::ROUTETOINDEX)
            ->with('success', 'Task deleted successfully.');
    }
}
