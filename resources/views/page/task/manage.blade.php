@extends('layout.default')
@section('content')
    @include('include.nav')
    <div class="mt-3">
        <form method="POST" action="{{ route('task.save', ['task' => $task->id]) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="task-name">
                    <span class="text-danger">*</span>
                    Название
                </label>
                <input class="form-control" id="task-name" type="text" name="name" placeholder="Название" value="{{ old('name', $task?->name) }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="task-text">
                    <span class="text-danger">*</span>
                    Описание
                </label>
                <textarea class="form-control" id="task-text" name="text" placeholder="Описание" rows="5" maxlength="1024" required>{{ old('text', $task?->text) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="task-user">
                    <span class="text-danger">*</span>
                    Исполнитель
                </label>
                <select class="form-select" id="task-user" name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user', $task?->user_id) === $user->id)>{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="task-last">
                    <span class="text-danger">*</span>
                    Дата окончания срока
                </label>
                <input class="form-control" id="task-last" type="date" name="expiration_at" placeholder="Дата окончания срока" value="{{ old('expiration_at', $task?->expiration_at?->format('Y-m-d')) }}" required>
            </div>
            <button class="btn btn-primary px-5 py-2" type="submit">Продолжить</button>
        </form>
    </div>
@endsection
