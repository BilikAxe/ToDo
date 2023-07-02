<?php

namespace App\Http\Controllers;

use App\Exceptions\SaveTaskExceptions;
use App\Http\Requests\ShareRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Permission;
use App\Models\Share;
use App\Models\Task;
use App\Models\User;
use App\Services\ShareService;
use App\Services\TaskService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService, private ShareService $shareService)
    {
    }

    /**
     * Display a listing of the resource.
     * @param TaskRequest $request
     * @return RedirectResponse
     * @throws SaveTaskExceptions
     */

    public function store(TaskRequest $request): RedirectResponse
    {
        $data = $request->all();
        $image = $request->file('image');
        $this->taskService->createTask($data, $image);

        return redirect()->route('tasks.showTasks');
    }

    /**
     * @throws SaveTaskExceptions
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->all();
        $deleteImage = $request->has('delete_image');
        $this->taskService->updateTask($data, $request->file('image'), $task, $deleteImage);

        return redirect()->route('tasks.shared');
    }

    public function edit(Task $task): Factory|View|Application
    {
        return view('tasks.edit', compact('task'));
    }

    public function delete(Task $task): RedirectResponse
    {
        $userId = auth()->id();

        if ($task->user_id === $userId) {
            $this->taskService->deleteTask($task);
        }

        return back();
    }

    public function showTasks(): Factory|View|Application
    {
        $user = auth()->user();
        $tasks = $user->tasks()->paginate(5);
        $permissions = Permission::all();
        $otherUsers = User::query()->select('users.*')->whereNotIn('users.id',[$user->id])->get();

        return view('tasks.showTasks', [
            'tasks' => $tasks,
            'permissions' => $permissions,
            'otherUsers' => $otherUsers,
        ]);
    }

    public function showMyTasks(): View|Factory|Application
    {
        $user = auth()->user();
        $tasks = $user->tasks()->paginate(5);

        return view('tasks.showMyTasks', [
            'tasks' => $tasks,
        ]);
    }

    public function filter(Request $request): Factory|View|Application
    {
        $permissions = Permission::all();
        $user = auth()->user();
        $otherUsers = User::query()->select('users.*')->whereNotIn('users.id',[$user->id])->get();
        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');
        $tag = $request->input('tag');

        $tasks = Task::query()->select('tasks.*',)->distinct()->when($title, function($query, $title) {
            return $query->where('tasks.title', 'like', '%'.$title.'%');
        })->when($description, function($query, $description) {
            return $query->where('tasks.description', 'like', '%'.$description.'%');
        })->when($status, function($query, $status) {
            return $query->where('tasks.status', $status);
        })->when($tag, function($query, $tags) {
            return $query->join('tags', 'tasks.id','=','tags.task_id')->whereIn('tags.name', $tags);
        })->paginate();

        return view('tasks.showTasks', [
            'tasks' => $tasks,
            'otherUsers' => $otherUsers,
            'permissions' => $permissions,
        ]);
    }

    public function share(ShareRequest $request): RedirectResponse
    {
        $userIdShared = $request->input('userIdShared');
        $access = $request->input('access');
        $this->shareService->create($userIdShared, $access);

        return redirect()->route('tasks.showTasks');
    }

    public function getMySharedTasks(): View|Factory|Application
    {
        $user = auth()->user();
        $tasks = $user->tasks()->paginate(5);
        $shares = Share::with('tasks')->where('shared_user_id','=',[$user->id])->get();
        $otherUsers = User::query()->select('users.*')->whereNotIn('users.id',[$user->id])->get();

        return view('tasks.sharedTasks', [
            'tasks' => $tasks,
            'otherUsers' => $otherUsers,
            'shares' => $shares,
        ]);
    }
}
