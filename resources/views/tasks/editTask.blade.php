<div class="modal fade" id="editTaskModal{{ $task->id, $taskListId }}" tabindex="-1" role="dialog"
     aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="editTaskModalLabel">Изменение задачи "{{ $task->title }}"</h5>
                <button style="border-radius: 50%; width: 30px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form action="{{ route('tasks.update', $task->id, $taskListId) }}" method="POST" id="editTaskForm"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-form-label">Название задачи:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Описание задачи:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $task->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Статус:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="В процессе" {{ $task->status == 'В процессе' ? 'selected' : '' }}>В процессе
                            </option>
                            <option value="Выполнена" {{ $task->status == 'Выполнена' ? 'selected' : '' }}>Выполнена
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tags" class="col-form-label">Введите теги через пробел:</label>
                        <input type="text" class="form-control" id="tags" name="tags"
                               value="@foreach($task->tags as $tag){{$tag->name." "}}@endforeach">
                    </div>

                    <div class="image-preview">
                        @if ($task->getImagePrevPath())
                            <img src="{{ asset('storage/' . $task->getImagePrevPath()) }}" alt="Task Image" class="task-image">
                        @else
                            <img src="{{ asset('storage/images/no_image.jpg') }}" alt="Default Image"
                                 class="task-image">
                        @endif
                        <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="delete_image" name="delete_image">
                            <label class="form-check-label" for="delete_image">Удалить изображение</label>
                        </div>
                    </div>

                    <input type="hidden" name="taskListId" value="{{ $taskListId }}">
                    <input type="hidden" name="from" value="{{ $from }}">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
