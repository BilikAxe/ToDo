<div class="modal fade" id="createTaskListModal" tabindex="-1" role="dialog" aria-labelledby="createTaskListFormModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskListModalLabel">Создать список</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lists.store') }}" method="POST" id="createTaskListFormModal">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text"  class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} "
                               id="title" name="title">
                        @if($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="createTaskListSubmitBtn">Создать список</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

