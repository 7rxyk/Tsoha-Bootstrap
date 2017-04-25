<?php

class TaskController extends BaseController {

    public static function findWithSearch() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $params = $_GET;
        $options = array('person_id' => $user_logged_in->id);

        if (isset($params['search'])) {
            $options['search'] = $params['search'];
        }

        $tasks = Task::allWithOption($options);

        View::make('/task/list.html', array('tasks' => $tasks));
    }

    public static function newTask() {
        self::check_logged_in();
        View::make('/task/new.html');
    }

    public static function userTasks() {
        self::check_logged_in();

        $person = $_SESSION['person'];
        $tasks = Task::findUser($person);
        View::make('/task/list.html', array('tasks' => $tasks));
    }

    public static function userTaskOnLogin() {
        self::check_logged_in();
        View::make('/task/list.html', array('message' => 'Welcome back ' . $person->username . '!'));
    }

    public static function findTask($id) {
        View::make('/task/taskPage.html', array('task' => Task::findTask($id)));
    }

    public static function createNewTask() {
        self::check_logged_in();
        $params = $_POST;

        $category = $params['category'];
        $priority_id = $params['priority_id'];
        $status_id = $params['status_id'];

        $attributes = array(
            'taskname' => $params['taskname'],
            'info' => $params['info'],
            'deadline' => $params['deadline'],
            'category' => $category,
            'priority_id' => $priority_id,
            'status_id' => $status_id
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) == 0) {
            $task->save();
            Redirect::to('/list' . $task->id, array('message' => 'New task is added to your to do -list!'));
        } else {
            View::make('/task/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        View::make('/task/edit.html');
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;

        $category = $params['category'];
        $priority_id = $params['priority_id'];
        $status_id = $params['status_id'];

        $attributes = array(
            'taskname' => $params['taskname'],
            'info' => $params['info'],
            'deadline' => $params['deadline'],
            'category' => $category,
            'priority_id' => $priority_id,
            'status_id' => $status_id
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) > 0) {
            View::make('/task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $task->update();

            Redirect::to('/list' . $task->id, array('message' => 'Task updated succesfully!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $task = new Task(array('id' => $id));
        $task->destroy();
        Redirect::to('/list', array('message' => 'Task deleted succesfully!'));
    }

}
