<?php
class Category extends BaseModel {

    public $id, $category_name;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_category_name');
    }

    public static function findAll(){
        $query = DB::connection()->prepare('SELECT * FROM category');
        $query->execute();
        $rows = $query->fetchAll();
        $categories = array();
        foreach ($rows as $row) {
            $categories[] = new Category(array(
                'id' => $row['id'],
                'category_name' => $row['category_name'],
            ));
        }
        return $categories;
    }

    public static function findAllByTask($item_id)  {
        $query = DB::connection()->prepare('SELECT category.* FROM category JOIN item_category ON item_category.category_id = category.id WHERE item_category.item_id = :id');
        $query->execute(array('id' => $task_id));
        $rows = $query->fetchAll();
        $categories = array();
        foreach ($rows as $row) {
            $categories[] = new Category(array(
                'id' => $row['id'],
                'category_name' => $row['category_name'],
            ));
        }
        return $categories;
    }

    public static function findOne($id) {
        $query = DB::connection()->prepare('SELECT * FROM category WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $category = new Category(array(
                'id' => $row['id'],
                'category_name' => $row['category_name'],
            ));
            return $category;
        }
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO category(category_name) VALUES (:category_name) RETURNING id');
        $query->execute(array('category_name' => $this->category_name));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM task_category WHERE category_id = :id');
        $query->execute(array('id' => $this->id));
        $query = DB::connection()->prepare('DELETE FROM task_category WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE category SET id = :id, category_name = :category_name WHERE id = :id');
        $query->execute(array('id' => $this->id, 'category_name' => $this->category_name, 'owner_id' => $this->owner_id));
    }

    public function validate_category_name(){
        $errors = array();
        if (self::validate_string_length($this->category_name, 4, 20) == false) {
            $errors[] = 'Category\'s length is invalid. It must be 4 - 20 characters (was ' . strlen($this->category_name) . ').';
        }
        return $errors;
    }
}