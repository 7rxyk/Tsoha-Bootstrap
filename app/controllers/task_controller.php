<?php

class TaskController extends BaseController{
	
  public static function index(){
    // Haetaan kaikki pelit tietokannasta
    $tasks = Task::all();
    // Renderöidään views/task kansiossa sijaitseva tiedosto index.html muuttujan $tasks datalla
    View::make('task/index.html', array('tasks' => $tasks));
  }
  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Task-luokan olion käyttäjän syöttämillä arvoilla
    $task = new Task(array(
		'id' => $row['id'],
        'person_id' => $row['person_id'],
        'task' => $row['task'],
        'done' => $row['done'],
        'description' => $row['description'],
        'deadline' => $row['deadline'],
        'added' => $row['added']
		'status_id' => $row['status_id'],
        'priority_id' => $row['priority_id']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $task->save();

    // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
    Redirect::to('/task/' . $task->id, array('message' => 'New task id added to your to do -list!'));
  }
}