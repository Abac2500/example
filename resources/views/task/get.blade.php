@extends('layouts.default')
@section('title', 'Редактирование - Example')
@section('content')
    @include('includes.nav')
    <div class="mt-3">
        <form method="POST" action="{{ route('task.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $task->id }}">
            <div class="mb-3">
                <label for="task-name" class="form-label">
                    <span class="text-danger">*</span>
                    Название
                </label>
                <input class="form-control" id="task-name" type="text" name="name" placeholder="Название" value="{{ old('name', $task->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="task-text" class="form-label">
                    <span class="text-danger">*</span>
                    Описание
                </label>
                <textarea class="form-control" id="task-text" name="text" placeholder="Описание" rows="5" required>{{ old('text', $task->text) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="task-user" class="form-label">
                    <span class="text-danger">*</span>
                    Исполнитель
                </label>
                <select class="form-select" id="task-user" name="user" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"{{ old('user', $task->user_id) == $user->id ? ' selected' : '' }}>{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="task-count" class="form-label">
                    <span class="text-danger">*</span>
                    Срок в днях
                </label>
                <input class="form-control" id="task-count" type="number" name="count" placeholder="Срок в днях" value="{{ old('count', $task->count) }}" required>
            </div>
            <div class="mb-3">
                <label for="task-last" class="form-label">
                    <span class="text-danger">*</span>
                    Дата окончания срока
                </label>
                <input class="form-control" id="task-last" type="date" name="last" placeholder="Дата окончания срока" value="{{ old('last', $task->last->format('Y-m-d')) }}" required>
            </div>
            <button class="btn btn-primary px-5 py-2" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
