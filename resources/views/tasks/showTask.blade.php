<div class="modal fade" id="exampleModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $task->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Описание:</strong> {{ $task->description }}</p>
                <p><strong>Статус:</strong> {{ $task->status }}</p>
                <p><strong>Создана:</strong> {{ $task->created_at }}</p>
                <p><strong>Обновлена:</strong> {{ $task->updated_at }}</p>
                <p><strong>Теги:</strong>
                @foreach($task->tags as $tag)
                    <pre>{{ "#".$tag->name}}</pre>
                    @endforeach</p>
                    @if ($task->img_orig_path)
                        <a href="{{ asset('/storage/' . $task->img_orig_path) }}" target="_blank">
                            <img src="{{ asset('/storage/' . $task->img_orig_path) }}" alt="{{ $task->title }}" width="150" height="150">
                        </a>
                    @else
                        <img src="{{ asset('storage/images/no_image.jpg') }}" alt="Default Image" width="150" height="150">
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
