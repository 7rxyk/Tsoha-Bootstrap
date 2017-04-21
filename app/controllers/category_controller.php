<?php

require 'app/models/category.php';

class CategoryController extends BaseController {

    public static function all() {
        self::check_logged_in();
        View::make('/category/list.html', array('categories' => Category::findAllByUser(self::get_user_logged_in()->id)));
    }

    public static function newCategory() {
        self::check_logged_in();
        View::make('/category/new.html');
    }

    public static function edit($id) {
        self::check_logged_in();
        $category = Category::findOne($id);
        View::make('/category/edit.html', array('category' => $category));
    }

    public static function update($id) {
        self::check_logged_in();
        $category = Category::findOne($id);
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'category_name' => $params['category_name'],
            'person_id' => $category->person_id
        );
        $updatedCategory = new Category($attributes);
        $errors = $updatedCategory->errors();
        if (count($errors) > 0) {
            View::make('/category/edit.html', array('errors' => $errors, 'category' => $category));
        } else {
            $updatedCategory->update();
            Redirect::to('/category/all', array('message' => 'Category has been updated!'));
        }
    }

    public static function createCategory() {
        self::check_logged_in();
        $params = $_POST;
        $category = new Category(array(
            'category_name' => $params['category_name'],
            'person_id' => self::get_user_logged_in()->id
        ));
        $errors = $category->errors();
        if (count($errors) > 0) {
            View::make('/category/new.html', array('errors' => $errors, 'category' => $category));
        } else {
            $category->save();
            Redirect::to('/category/all', array('message' => 'Category has been added!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $category = new Category(array('id' => $id));
        $category->destroy();
        Redirect::to('/category/all', array('message' => 'Category has been deleted!'));
    }

}
