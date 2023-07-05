<?php

namespace App\Http\Controllers;

use App\Exceptions\SaveTaskExceptions;
use App\Http\Requests\ShareRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Permission;
use App\Models\Share;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
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

        return redirect()->route('tasks.showMyTasks');
    }

    /**
     * @throws SaveTaskExceptions
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->all();
        $deleteImage = $request->has('delete_image');
        $this->taskService->updateTask($data, $request->file('image'), $task, $deleteImage);

        return back();
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

    public function showMyTasks(): View|Factory|Application
    {
        $user = auth()->user();
        $tasks = $user->tasks()->paginate(5);
        $permissions = Permission::all();
        $otherUsers = User::query()->select('users.*')->whereNotIn('users.id',[$user->id])->get();

        return view('tasks.showMyTasks', [
            'tasks' => $tasks,
            'otherUsers' => $otherUsers,
            'permissions' => $permissions,
        ]);
    }

    public function filter(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $permissions = Permission::all();
        $user = auth()->user();
        $otherUsers = User::query()->select('users.*')->whereNotIn('users.id',[$user->id])->get();

        $tag = $request->input('tag');

        $tasks = Task::query()
            ->select('tasks.*',)
            ->where('user_id', [$user->id])
            ->distinct()
            ->when($tag, function($query, $tags)
            {
                return $query
                    ->join('tags', 'tasks.id','=','tags.task_id')
                    ->where('tags.name', '!=', $tags);
            }
        )->paginate();

        return view('tasks.showMyTasks', [
            'tasks' => $tasks,
            'otherUsers' => $otherUsers,
            'permissions' => $permissions,
        ]);
    }

    public function share(ShareRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $userIdShared = $request->input('userIdShared');
        $access = $request->input('access');

        Share::create([
            'owner_id' => $user->id,
            'shared_user_id' => $userIdShared,
            'access' => $access,
        ]);

        return back();
    }

    public function getSharedTasks(): View|Factory|Application
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
