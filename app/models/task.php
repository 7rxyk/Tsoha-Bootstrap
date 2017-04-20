<?php

class Task extends BaseModel {

    public $id, $taskname, $info, $deadline, $priority_id, $status_id, $added;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_info', 'validate_deadline', 'validate_priority_id',
            'validate_status_id');
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Task');
        $query->execute();

        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'taskname' => $row['taskname'],
                'info' => $row['info'],
                'deadline' => $row['deadline'],
                'added' => $row['added'],
                'priority_id' => $row['priority_id'],
                'status_id' => $row['status_id']
            ));
        }

        return $tasks;
    }

    public static function findUser($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE person_id = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'taskname' => $row['taskname'],
                'info' => $row['info'],
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
                'taskname' => $row['taskname'],
                'info' => $row['info'],
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
        $query = DB::connection()->prepare('INSERT INTO Task (taskname,  info, deadline, priority_id, status_id) VALUES (:taskname, :info, :deadline, :priority_id, :status_id) RETURNING id');
        $query->execute(array('taskname' => $this->taskname, 'info' => $this->info, 'deadline' => $this->deadline, 'priority_id' => $this->priority_id, 'status_id' => $this->status_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_name() {
        $errors = array();
        if ($this->taskname == '' || $this->taskname == null) {
            $errors[] = 'Taskname can\'t be empty!';
        }
        if (strlen($this->taskname) < 3) {
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
        $deadline = DateTime::createFromFormat('Y-m-d', $this->deadline);
        $dateNow = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        if ($deadline === false) {
            $errors[] = 'Deadline is invalid. Use format: Year-month-day';
        } else if ($deadline < $dateNow) {
            $errors[] = 'Deadline is invalid. It can\'t point to a past date.';
        }
        return $errors;
    }

    public function validate_priority_id() {
        $errors = array();
        if (self::number($this->priority_v) === false) {
            $errors[] = 'Choose priority for the task!';
        }
        return $errors;
    }

    public function validate_status_id() {
        $errors = array();
        if (self::number($this->status) === false) {
            $errors[] = 'Choose current status for the task!';
        }
        return $errors;
    }
}
