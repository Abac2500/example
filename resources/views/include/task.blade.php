<div class="card w-100 mt-3">
    <div @class([
        'card-header',
        'text-danger' => $task->expiration_at < now()
    ])>Дата окончания: {{ $task->expiration_at->format('d.m.Y') }}</div>
    <div class="card-body">
        <h5 class="card-title">{{ $task->name }}</h5>
        <p class="card-text">{{ $task->text }}</p>
        @can(['delete', 'update'], $task)
            <div class="d-flex gap-3 mb-3">
                <a href="{{ route('task.manage', ['task' => $task->id]) }}" class="btn btn-success">Изменить</a>
                <a href="{{ route('task.delete', ['task' => $task->id]) }}" class="btn btn-danger">Удалить</a>
            </div>
        @endcan
        <p class="card-text">
            <small class="text-muted d-block">Последнее обновление {{ $task->updated_at->diffForHumans() }}</small>
            <small class="text-muted d-block">Создана {{ $task->created_at->diffForHumans() }}</small>
        </p>
    </div>
    <div class="card-footer text-muted">Автор: {{ $task->user->email }}</div>
</div>
