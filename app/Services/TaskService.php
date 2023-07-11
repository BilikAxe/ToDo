<?php

namespace App\Services;

use App\Exceptions\SaveTaskExceptions;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function __construct(private TagService $tagService, private ImageService $imageService)
    {
    }

    /**
     * @throws SaveTaskExceptions
     */
    public function createTask(array $data, ?UploadedFile $image): void
    {
        DB::beginTransaction();

        try {
            $task = new Task();
            $task->title = $data['title'];
            $task->task_list_id = $data['taskListId'];
            $task->description = $data['description'];
            $task->user_id = auth()->id();
            $task->status = $data['status'];

            $task->save();

            $this->tagService->createTags($data['tags'], $task->id);

            if (!empty($image)) {
                $this->imageService->saveImage($task, $image);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new SaveTaskExceptions("Don't save task with images",0, $e);
        }
    }

    /**
     * @throws SaveTaskExceptions
     */
    public function updateTask(array $data, ?UploadedFile $image, Task $task, bool $deleteImage)
    {
        $task->title = $data['title'];
        $task->status = $data['status'];
        $task->description = $data['description'];
        $task->save();

        if (!empty($data['tags'])) {
            $this->tagService->deleteTags($task['id']);
            $this->tagService->createTags($data['tags'], $task['id']);
        }

        if (!empty($image)) {
            $this->imageService->updateImage($task, $image);
        }

        if ($deleteImage) {
            $this->imageService->deleteImage($task);
        }

    }

    public function deleteTask(Task $task): void
    {
        $task->delete();
        $this->imageService->deleteImage($task);
    }
}
