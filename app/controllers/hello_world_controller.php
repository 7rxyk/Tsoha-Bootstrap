<?php

class HelloWorldController extends BaseController {

    public static function index() {
// make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        View::make('helloworld.html');
    }

    public static function todo_list() {
        View::make('suunnitelmat/todo_list.html');
    }
    
    public static function newTask() {
        View::make('suunnitelmat/new.html');
    }

    public static function modify() {
        View::make('suunnitelmat/modify.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

}
