<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskListRequest;
use App\Models\Permission;
use App\Models\Share;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function store(TaskListRequest $taskListRequest): RedirectResponse
    {
        $user = auth()->user();

        TaskList::create([
            'title' => $taskListRequest->get('title'),
            'user_id' => $user->id,
        ]);

        return back();
    }

    public function getMyLists(): View|Application|Factory
    {
        $user = auth()->user();
        $taskList = TaskList::all()->where('user_id', $user->id);

        return view('lists.showMyTaskLists', [
            'taskLists' => $taskList,
        ]);
    }

    public function getTasks(?int $taskListId): View|Application|Factory
    {
        $user = auth()->user();
        $tasks = $user->tasks()->where('task_list_id', $taskListId)->paginate(5);
        $permissions = Permission::all();
        $otherUsers = User::query()->select('users.*')->whereNotIn('users.id',[$user->id])->get();

        return view('tasks.showMyTasks', [
            'taskListId' => $taskListId,
            'tasks' => $tasks,
            'otherUsers' => $otherUsers,
            'permissions' => $permissions,
        ]);
    }

    public function getSharedTaskLists()
    {
        $user = auth()->user();
        $taskLists = $user->shares()->paginate(5);
        $shares = Share::with('tasks')
            ->where('shared_user_id','=',[$user->id])
            ->get();
        $otherUsers = User::query()
            ->select('users.*')
            ->whereNotIn('users.id',[$user->id])
            ->get();

        return view('lists.sharedTaskLists', [
            'taskLists' => $taskLists,
            'shares' => $shares,
            'otherUsers' => $otherUsers,
        ]);
    }

    public function delete(TaskList $taskList, Request $request): RedirectResponse
    {
        $taskList = $taskList->first()->where('id', $request->input('taskListId'));

        $taskList->delete();


        return back();
    }
}
