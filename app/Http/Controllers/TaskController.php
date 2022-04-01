<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Notifications\NewTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function main()
    {
        $tasks = Task::where('user_id', auth()->user()->getAuthIdentifier())
            ->orderByDesc('last')
            ->paginate(5);

        return view('task.main', compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function all()
    {
        $tasks = Task::orderByDesc('last')->paginate(5);

        return view('task.main', compact('tasks'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id)
    {
        $task = Task::find($id);

        $this->authorize('delete', $task);
        $task->delete();

        return redirect()
            ->route('task.main')
            ->with('success', 'Вы успешно удалили задачу.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function get($id)
    {
        $task = Task::findOrFail($id);

        $this->authorize('update', $task);
        $users = User::all();

        return view('task.get', compact('task', 'users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:App\Models\Task,id',
            'name' => 'required|string|min:3|max:250',
            'text' => 'required|string|min:3|max:999',
            'user' => 'required|integer|exists:App\Models\User,id',
            'count' => 'required|integer|min:1|max:100',
            'last' => 'required|date'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = Task::findOrFail($request->id);

        $this->authorize('update', $task);
        $task->user_id = $request->user;
        $task->name = $request->name;
        $task->text = $request->text;
        $task->count = $request->count;
        $task->last = $request->last;
        $task->save();

        return back()
            ->with('success', 'Задача успешно изменена');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $users = User::all();

        return view('task.create', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:250',
            'text' => 'required|string|min:3|max:999',
            'user' => 'required|integer|exists:App\Models\User,id',
            'count' => 'required|integer|min:1|max:100',
            'last' => 'required|date'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Task();
        $task->user_id = $request->user;
        $task->name = $request->name;
        $task->text = $request->text;
        $task->count = $request->count;
        $task->last = $request->last;
        $task->save();

        if ($task->user->id !== auth()->user()->getAuthIdentifier()) {
            $task->user->notify(new NewTask(auth()->user(), $task));
        }

        return redirect()->route('task.main')
            ->with('success', 'Задача успешно создана');
    }
}
