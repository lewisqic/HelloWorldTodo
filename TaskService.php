<?php

namespace App\Services;

use App\Models\Task;

class TaskService extends BaseService
{

    public function createTask($input)
    {
        $status = !empty($input['status']) ? $input['status'] : 'pending';
        $task = new Task;
        $task->content = $input['content'];
        $task->status = $status;
        if ($task->save()) {
            return $task;
        }
        fail('Unable to create task');
    }

    public function updateTask($id, $data)
    {
        $task = Task::findOrFail($id);
        $task->fill($data);
        if ($task->save()) {
            return $task;
        }
        fail('Unable to update task');
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return $task;
    }

}
