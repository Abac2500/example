<nav>
    <div class="nav nav-tabs">
        <a @class([
            'nav-link',
            'active' => request()->routeIs('task.index') && request()->view === 'user'
        ]) href="{{ route('task.index', ['view' => 'user']) }}">Мои задачи</a>
        <a @class([
            'nav-link',
            'active' => request()->routeIs('task.index') && request()->view === 'all'
        ]) href="{{ route('task.index', ['view' => 'all']) }}">Все задачи</a>
        <a @class([
            'nav-link',
            'active' => request()->routeIs('task.manage')
        ]) href="{{ route('task.manage') }}">{{ request()->routeIs('task.manage') ? $title : 'Новая задача' }}</a>
    </div>
</nav>
