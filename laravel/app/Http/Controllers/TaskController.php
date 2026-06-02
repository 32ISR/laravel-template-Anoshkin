<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $tasks = $user
            ->tasks()
            ->with('categories')
            ->latest()
            ->paginate(10);

            return view('tasks.index', compact('tasks'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            "title"     => "string|max:255",
            "description"    => "string|nullable|required",
            "status" => "required|in:pending,in_progress,done",
            "priority" => "required|in:low,medium,high",
            "due_date" => "nullable|after_or_equal:today",
            "category_id" => "nullable|exists:categories:id"
        ]);
        /** @var User $user */
        $user = Auth::user();
        $user->tasks()->create($data);
        return redirect()->route('tasks.index')->with('success', 'Задача создана');
    }
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        $categories = $user->categories()->get();
        return view('tasks.create', compact('categories'));
    }
    public function edit()
    {

    }
    public function update()
    {

    }
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', '');
    }
}
