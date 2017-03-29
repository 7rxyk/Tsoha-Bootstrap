<?php
require 'app/models/task.php';
class TaskController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $tasks = Task::all();
        View::make('task/index.html', array('tasks' => $tasks));
    }

    public static function newTask() {
        View::make('task/new.html');
    }

    public static function edit($id) {
        View::make('task/edit.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }
    
    public static function listTasks() {
        View::make('suunnitelmat/todo_list.html');
    }

    public static function showTask($id) {
        Kint::dump(Task::findOne($id));
        View::make('/task/taskPage.html', array('task' => Task::findOne($id)));
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Task-luokan olion käyttäjän syöttämillä arvoilla
        $task = new Task(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'deadline' => $params['deadline'],
            'priority_id' => $params['priority_id'],
            'status_id' => $params['status_id'],
            'added' => date('Y-m-d H:i:s')
        ));
        //Kint::dump($params);

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $task->save();
        //Kint::dump($params);
        //Kint::dump($task);
        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/task/' . $task->id, array('message' => 'New task is added to your to do -list!'));
    }

}
