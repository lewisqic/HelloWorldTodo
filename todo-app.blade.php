@extends('layouts.todo-layout')

@section('content')

    <div id="todo">
        <h1 class="is-size-1">HelloWorld Todo App</h1>

        <div v-cloak>

            <ul class="has-mb-30 has-font-20">
                <li class="task-row" v-for="task in taskList">
                    <label>
                        <input type="checkbox" @change="toggleStatus(task)" :checked="task.status === 'completed'" />
                        @{{ task.content }}
                    </label>
                    <a @click="deleteTask(task)" class="delete-task has-ml-20 has-text-danger has-font-14"><i class="fal fa-trash-alt"></i></a>
                </li>
            </ul>

            <div class="new-task-wrapper has-mb-20" v-if="showNewTask">
                Task: <input type="text" class="input" v-model="newTask.content" @keydown.enter="saveNewTask" />
                <div class="has-mt-10">
                    <a @click="saveNewTask" class="button is-success is-small"><i class="fal fa-check"></i> Save</a>
                    <a @click="cancelNewTask" class="button is-small">Cancel</a>
                </div>
                <div class="error-message-wrapper notification is-danger has-mt-10" v-if="errorMessage !== null">@{{ errorMessage }}</div>
            </div>

        </div>

        <a @click="addNewTask" class="button is-success" v-if="!showNewTask"><i class="fal fa-plus-circle"></i> New Task</a>

        <div class="has-mt-20">
            <a @click="toggleCompleted">@{{ hideCompleted ? 'Show' : 'Hide' }} Completed</a>
        </div>

    </div>

@endsection

@push('scripts')

    <script>
        const app = new Vue({
            el: '#todo',
            data: {
                showNewTask: false,
                newTask: {},
                errorMessage: null,
                tasks: [],
                hideCompleted: false,
            },
            mounted() {
                this.getTasks();
            },
            computed: {
                taskList() {
                    let tasks = this.tasks.filter((row) => {
                        if (this.hideCompleted) {
                            return row.status === 'pending';
                        }
                        return true;
                    });
                    return tasks;
                }
            },
            methods: {
                toggleCompleted() {
                    this.hideCompleted = !this.hideCompleted;
                },
                getTasks() {
                    axios.get('/todo/tasks').then((res) => {
                        this.tasks = res.data.data;
                    });
                },
                addNewTask() {
                    this.showNewTask = true;
                },
                cancelNewTask() {
                    this.newTask = {};
                    this.showNewTask = false;
                },
                saveNewTask() {
                    if (this.newTask.content === undefined || this.newTask.content === '') {
                        alert('Task field is required');
                        return false;
                    }
                    axios.post('/todo/tasks', {
                        content: this.newTask.content
                    }).then((res) => {
                        this.getTasks();
                        this.showNewTask = false;
                    }).catch((error) => {
                        this.errorMessage = error.response.data.message;
                    });
                },
                toggleStatus(task) {
                    let newStatus = task.status === 'pending' ? 'completed' : 'pending';
                    axios.put('/todo/tasks/' + task.id, {
                        status: newStatus
                    }).then((res) => {
                        this.getTasks();
                    }).catch((error) => {
                        this.errorMessage = error.response.data.message;
                    });
                },
                deleteTask(task) {
                    axios.delete('/todo/tasks/' + task.id).then((res) => {
                        this.getTasks();
                    }).catch((error) => {
                        this.errorMessage = error.response.data.message;
                    });
                }
            }
        });
    </script>

@endpush
