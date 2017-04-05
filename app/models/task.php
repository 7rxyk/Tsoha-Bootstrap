<?php

class Task extends BaseModel {

    public $id, $name, $description, $deadline, $added, $priority, $status;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description', 'validate_deadline', 'validate_priority_id',
            'validate_status');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Task');
        $query->execute();

        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'deadline' => $row['deadline'],
                'added' => $row['added'],
                'priority_id' => $row['priority_id'],
                'status_id' => $row['status_id']
            ));
        }

        return $tasks;
    }
    
    public static function findOne($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $task = new Task(array(
                'id' => $row['id'],
                'name' => $row['name'],
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
        $query = DB::connection()->prepare('INSERT INTO Task (name,  description, deadline, priority_id, status_id) VALUES (:name, :description, :deadline, :priority_id, :status_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'deadline' => $this->deadline, 'priority_id' => $this->priority, 'status_id' => $this->status));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_name() {
        $errors = array();
        if($this->name == '' || $this->name == null){
            $errors[] = 'Task name can\'t be empty!';
        }
        if(strlen($this->name) < 3){
            $errors[] = 'Give at least 3 characters long taskname';
        }
        return $errors;
    }

    public function validate_description() {
        $errors = array();
        if (self::validate_string_length($this->description, 1, 400) === false) {
            $errors[] = 'Description can\'t be empty';
        }
        return $errors;
    }

    public function validate_deadline() {
        $errors = array();
        $deadline = DateTime::createFromFormat('d-m-Y', $this->deadline);
        $dateNow = DateTime::createFromFormat('d-m-Y', date('d-m-Y'));
        if ($deadline === false) {
            $errors[] = 'Deadline is invalid. Use format: Day-Month-Year';
        } else if ($deadline < $dateNow) {
            $errors[] = 'Deadline is invalid. It can\'t point to a past date.';
        }
        return $errors;
    }

    public function validate_priority_id() {
        $errors = array();
        if (self::number($this->priority_id) === false) {
            $errors[] = 'Choose priority for the task!';
        }
        return $errors;
    }

    public function validate_status() {
        $errors = array();
        if (self::number($this->status) === false) {
            $errors[] = 'Choose current status for the task!';
        }
        return $errors;
    }

}
