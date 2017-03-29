<?php

class Task extends BaseModel{
  // Attribuutit
  public $id, $person_id, $name, $done, $description, $deadline, $added, $priority, $status;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
  public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM Task');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $tasks = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      $tasks[] = new Task(array(
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
    }

    return $tasks;
  }
  
   public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
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

      return $task;
    }

    return null;
  }
  
   public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Task (name, deadline, description, priority_id, status_id) VALUES (:name, :deadline, :description, :priority_id, :status_id) RETURNING id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('name' => $this->name, 'deadline' => $this->deadline, 'description' => $this->description, 'priority_id' => $this->priority_id, 'status_id' => $this->status_id));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->id = $row['id'];
  }
}
