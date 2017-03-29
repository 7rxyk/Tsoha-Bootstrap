<?php

class Task extends BaseModel {

    // Attribuutit
    public $id, $name, $done, $description, $deadline, $added, $priority, $status;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Task');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $tasks = array();

        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'person_id' => $row['person_id'],
                'name' => $row['name'],
                'done' => $row['done'],
                'description' => $row['description'],
                'deadline' => $row['deadline'],
                'added' => $row['added'],
                'priority_id' => $row['priority_id'],
                'status_id' => $row['status_id']
            ));
        }

        return $tasks;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
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

            return $task;
        }

        return null;
    }

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Task (name,  description, deadline, priority_id, status_id) VALUES (:name, :description, :deadline, :priority_id, :status_id) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'deadline' => $this->deadline, 'priority_id' => $this->priority_id, 'status_id' => $this->status_id));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

}
