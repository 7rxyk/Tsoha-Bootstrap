<?php
require 'app/models/task.php';
class TaskController extends BaseController {

    public static function index() {
        $tasks = Task::all();
        View::make('task/index.html', array('tasks' => $tasks));
    }

    public static function newTask() {
        self::check_logged_in();
        View::make('task/new.html');
    }

    public static function showTask($id) {
        View::make('/task/taskPage.html', array('task' => Task::findOne($id)));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = new Task(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'deadline' => $params['deadline'],
            'priority_id' => $params['priority_id'],
            'status_id' => $params['status_id'],
        ));

        $task = new Task($attributes);
        $errors = $task->errors();

        if(count($errors) == 0){
            $task->save();
            Redirect::to('/task/' . $task->id, array('message' => 'New task is added to your to do -list!'));
            }else{
                View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }

    }

    public static function edit($id) {
        self::check_logged_in();
        View::make('task/edit.html');
    }

    public static function update($id){
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'description' => $params['description'],
            'deadline' => $params['deadline'],
            'priority_id' => $params['priority_id'],
            'status_id' => $params['status_id'],
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if(count($errors) > 0){
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
            $task->update();

            Redirect::to('/task/' . $task->id, array('message' => 'Task updated succesfully!'));
        }
    }

   public static function destroy($id){
        self::check_logged_in();
        $task = new Task(array('id' => $id));
        $task->destroy();
        Redirect::to('/task', array('message' => 'Task deleted succesfully!'));
        }
    }
}
