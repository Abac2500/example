<div class="card w-100 mt-3">
    <div class="card-header{{ $task->last < \Carbon\Carbon::now() ? ' text-danger' : '' }}">Дата окончания: {{ $task->last->format('d.m.Y') }}</div>
    <div class="card-body">
        <h5 class="card-title">{{ $task->name }}</h5>
        <p class="card-text">{{ $task->text }}</p>
        @can(['delete', 'update'], $task)
            <div class="d-flex gap-3 mb-3">
                <a href="{{ route('task.get', $task->id) }}" class="btn btn-success">Изменить</a>
                <form method="POST" action="{{ route('task.delete', $task->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        @endcan
        <p class="card-text">
            <small class="text-muted d-block">Последнее обновление {{ $task->updated_at->diffForHumans() }}</small>
            <small class="text-muted d-block">Создана {{ $task->created_at->diffForHumans() }}</small>
        </p>
    </div>
    <div class="card-footer text-muted">Автор: {{ $task->user->email }}</div>
</div>
