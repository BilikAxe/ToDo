<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Создать задачу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.store') }}" method="POST" id="createTaskFormModal" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text"  class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} "
                               id="title" name="title" value="{{ old('title') }}">
                        @if($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tags">Введите теги через пробел</label>
                        <input type="text" class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" id="tags" name="tags" value="{{ old('tags') }}">
                        @if($errors->has('tags'))
                            <div class="invalid-feedback">{{ $errors->first('tags') }}</div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Статус:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option
                                value="Выберите статус" {{ old('status') == 'Выберите статус' ? 'selected' : '' }}>
                                Выберите статус
                            </option>
                            <option value="В процессе" {{ old('status') == 'В процессе' ? 'selected' : '' }}>В
                                процессе
                            </option>
                            <option value="Выполнена" {{ old('status') == 'Выполнена' ? 'selected' : '' }}>
                                Выполнена
                            </option>
                        </select>
                    </div>

                    <div>
                        <label>Изображение:</label><br>
                        <input type="file" name="image" id="image">
                    </div>

                    <input type="hidden" name="taskListId" value="{{ $taskListId }}">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="createTaskSubmitBtn">Создать задачу</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

