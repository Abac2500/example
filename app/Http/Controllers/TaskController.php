<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Вывод списка задач.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(string $view)
    {
        switch ($view) {
            case 'all':
                $tasks = new Task();
                break;
            case 'user':
                $tasks = auth()->user()->tasks();
                break;
        }
        $tasks = $tasks->orderByDesc('expiration_at')->paginate(5);

        $title = 'Список задач';

        return view('page.task.index', compact('tasks', 'title'));
    }

    /**
     * Редактирование или создание задачи.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function manage(Request $request, Task $task)
    {
        $has = $request->route()->hasParameter('task');
        if ($has) {
            $this->authorize('update', $task);
        }
        $users = User::all();

        $title = $has ? "Редактирование - " . $task->name : 'Новая задача';

        return view('page.task.manage', compact('task', 'users', 'title'));
    }

    /**
     * Сохранение задачи.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function save(Request $request, Task $task)
    {
        $has = $request->route()->hasParameter('task');
        if ($has) {
            $this->authorize('update', $task);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string|max:1024',
            'user_id' => 'required|integer|exists:App\Models\User,id',
            'expiration_at' => 'required|date'
        ], [], [
            'name' => 'Название',
            'text' => 'Описание',
            'user' => 'Исполнитель',
            'expiration_at' => 'Дата окончания срока'
        ]);

        if (!$has) {
            $task = new Task();
        }
        $task->name = $request->name;
        $task->text = $request->text;
        $task->user_id = $request->user_id;
        $task->expiration_at = $request->expiration_at;
        $task->save();

        return to_route('task.manage', ['task' => $task->id])->with('success', 'Задача успешно сохранена');
    }

    /**
     * Удаление задачи.
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Вы успешно удалили задачу');
    }
}
