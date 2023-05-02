<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
use App\Models\Task;
use Facades\App\Services\TaskService;

class FrontendIndexController extends BaseController
{

    public function todoApp()
    {
        $data = [];
        return view('content.frontend.todo-app', $data);
    }

    public function getTasks()
    {
        $tasks = Task::orderBy('order', 'asc')->get();
        return \Output::data($tasks)->json();
    }

    public function createTask()
    {
        $input = request()->all();
        $result = TaskService::createTask($input);
        return \Output::data($result)->json();
    }

    public function updateTask($id) {
        $input = request()->all();
        $result = TaskService::updateTask($id, $input);
        return \Output::data($result)->json();
    }

    public function deleteTask($id) {
        $result = TaskService::deleteTask($id);
        return \Output::data($result)->json();
    }

}
