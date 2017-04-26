<?php

class Task extends BaseModel {

    public $id, $taskname, $info, $deadline, $priority_id, $status_id, $added, $person_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_info', 'validate_deadline', 'validate_priority_id',
            'validate_status_id');
    }

    public static function allWithOption($options) {
        $query_string = 'SELECT * FROM task WHERE person_id = :person_id';
        $options = array('person_id' => $options['person_id']);
        if (isset($options['search'])) {
            $query_string .= ' AND name LIKE :like';
            $options['like'] = '%' . $options['search'] . '%';
        }

        $query = DB::connection()->prepare($query_string);
        $query->execute($options);

        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = new Task($row);
        }

        return $tasks;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM task');
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

    public static function findUsersTasks($id) {
        $query = DB::connection()->prepare('SELECT * FROM task WHERE person_id = :id');
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

    public static function findTask($id) {
        $query = DB::connection()->prepare('SELECT * FROM task WHERE id = :id LIMIT 1');
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
                'status_id' => $row['status_id'],
                'person_id' => $row['person_id']
            ));
            return $task;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Task (taskname,  info, deadline, priority_id, status_id, person_id) VALUES (:taskname, :info, :deadline, :priority_id, :status_id, :person_id) RETURNING id');
        $query->execute(array('taskname' => $this->taskname, 'info' => $this->info, 'deadline' => $this->deadline, 'priority_id' => $this->priority_id, 'status_id' => $this->status_id, 'person_id' => $this->person_id));
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

    public function validate_info() {
        $errors = array();
        if (self::validate_length($this->info, 1, 400) === false) {
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
        if (self::number($this->priority_id) === false) {
            $errors[] = 'Choose priority for the task!';
        }
        return $errors;
    }

    public function validate_status_id() {
        $errors = array();
        if (self::number($this->status_id) === false) {
            $errors[] = 'Choose current status for the task!';
        }
        return $errors;
    }

}
