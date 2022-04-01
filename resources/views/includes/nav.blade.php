<nav>
    <div class="nav nav-tabs">
        <a class="nav-link{{ request()->routeIs(['task.main', 'task.get']) ? ' active' : '' }}" href="{{ route('task.main') }}">Мои задачи</a>
        <a class="nav-link{{ request()->routeIs('task.all') ? ' active' : '' }}" href="{{ route('task.all') }}">Все задачи</a>
        <a class="nav-link{{ request()->routeIs('task.create') ? ' active' : '' }}" href="{{ route('task.create') }}">Новая задача</a>
    </div>
</nav>
