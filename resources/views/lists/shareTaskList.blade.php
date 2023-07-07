<div class="modal fade" id="shareTasksModal" tabindex="-1" role="dialog" aria-labelledby="shareTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareTaskModalLabel">Поделиться списком</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form action="{{ route('tasks.share') }}" method="POST" id="shareTaskFormModal" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="modal-body">
                    <div class="form-group">
                        <label for="status" class="col-form-label">Выберите пользователя:</label>
                        <select class="form-control" id="userIdShared" name="userIdShared" required>
                            @foreach($otherUsers as $otherUser)
                                <option value={{ $otherUser->id }}>
                                    {{$otherUser->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Права доступа:</label>
                        <select class="form-control" id="access" name="access" required>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->code }}">{{ $permission->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="taskListId" value="{{ $taskListId }}">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Поделиться</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

