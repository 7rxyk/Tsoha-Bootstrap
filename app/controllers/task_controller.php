<?php

class TaskController extends BaseController {

    public static function newTask() {
        self::check_logged_in();
        $categories = Category::findCategoriesByUser($_SESSION['person']);
        View::make('/task/new.html', array('categories' => $categories));
    }

    public static function userTasks() {
        self::check_logged_in();

        $person_id = $_SESSION['person'];
        $tasks = Task::findUsersTasks($person_id);
        View::make('/task/list.html', array('tasks' => $tasks));
    }

    public static function userTaskOnLogin() {
        self::check_logged_in();
        View::make('/task/list.html', array('message' => 'Welcome back ' . $person->username . '!'));
    }

    public static function findTask($id) {
        self::check_logged_in();
        if (Task::findTask($id) === null) {
            Redirect::to('/list');
        }
        View::make('/task/taskPage.html', array('task' => Task::findTask($id)));
    }

    public static function createNewTask() {
        self::check_logged_in();
        $params = $_POST;

        $person_id = self::get_user_logged_in()->id;

        $attributes = array(
            'taskname' => $params['taskname'],
            'info' => $params['info'],
            'deadline' => $params['deadline'],
            'priority_id' => $params['priority_id'],
            'status_id' => $params['status_id'],
            'person_id' => $person_id
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) == 0) {
            if (isset($_POST['categories'])) {
                $task->save($_POST['categories']);
            } else {
                $task->save();  
            }        
            Redirect::to('/list', array('message' => 'New task is added to your to do -list!'));
        } else {
            View::make('/task/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $task = Task::findTask($id);
        View::make('/task/edit.html', array('task' => $task, 'categories' => Category::findCategoriesByUser(self::get_user_logged_in()->id)));
    }

    public static function update($id) {
        self::check_logged_in();
        
        $task = Task::findTask($id);
        $params = $_POST;
        
        $attributes = array(
            'taskname' => $params['taskname'],
            'info' => $params['info'],
            'deadline' => $params['deadline'],
            'priority_id' => $params['priority_id'],
            'status_id' => $params['status_id'],
            'person_id' => $person_id
        );

        $taskNew = new Task($attributes);
        $errors = $taskNew->errors();

        if (count($errors) > 0) {
            View::make('/task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            if (isset($_POST['categories'])) {
                $taskNew->update($_POST['categories']);
            } else {
                $taskNew->update();
            }
            
            Redirect::to('/list' . $taskNew->id, array('message' => 'Task updated succesfully!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $task = new Task(array('id' => $id));
        $task->destroy();
        Redirect::to('/list', array('message' => 'Task deleted succesfully!'));
    }

}
