<?php

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
        View::make('/task/taskPage.html', array('item' => Task::findOne($id)));
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Task-luokan olion käyttäjän syöttämillä arvoilla
        $task = new Task(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'done' => $row['done'],
            'description' => $row['description'],
            'deadline' => $row['deadline'],
            'added' => $row['added'],
            'priority_id' => $row['priority_id'],
            'status_id' => $row['status_id']
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $task->save();

        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/task/' . $task->id, array('message' => 'New task is added to your to do -list!'));
    }

}
