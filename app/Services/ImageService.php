<?php

namespace App\Services;

use App\Exceptions\SaveTaskExceptions;
use App\Models\Task;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * @throws SaveTaskExceptions
     */
    public function saveImage(Task $task, ?UploadedFile $image): void
    {
        try {
            $imageOrigPath = $image->store('uploads', 'public');
            $imagePrevPath = $image->store('uploads/previews', 'public');

            if (!$imageOrigPath) {
                throw new SaveTaskExceptions("Don't save photo to uploads");
            }

            $prevPath = public_path('storage/' . $imagePrevPath);
            Image::make($prevPath)->resize(150, 150)->save($prevPath);

            $task->setImageOrigPath($imageOrigPath);
            $task->setImagePrevPath($imagePrevPath);
            $task->setImageOrigName($image->getClientOriginalName());

            $task->save();

        } catch (\Exception $e) {

            $this->deleteImage($task);

            throw new SaveTaskExceptions("Don't save images",0, $e);
        }
    }

    /**
     * @throws SaveTaskExceptions
     */
    public function updateImage(Task $task, ?UploadedFile $image): void
    {
        $this->deleteImage($task);
        $this->saveImage($task, $image);
    }

    public function deleteImage(Task $task): void
    {
        $imageOrigPath = $task->getImageOrigPath();
        $imagePrevPath = $task->getImagePrevPath();

        if(!empty($imageOrigPath) || !empty($imagePrevPath)) {
            Storage::disk('public')->delete($imageOrigPath);
            Storage::disk('public')->delete($imagePrevPath);
        }
    }
}
