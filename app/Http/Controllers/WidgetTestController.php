<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widgets\Widget;

class WidgetTestController extends Controller
{
    // Тестируем класс 

    // public function index(Widget $customServiceInstance) {
    //     dump($customServiceInstance->show());
    // }

    // public function index(Widget $customServiceInstance)  {
    //     dump($customServiceInstance->show('tags'));
    //     // dump($customServiceInstance->show('categories'));
    // }

    public function index()  {
        return view('directive');
    }
 
}
