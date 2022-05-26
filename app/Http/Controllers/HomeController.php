<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    private $title;
    private $subtitle;

    public function __construct() {
        $this->title = "Home";
        $this->subtitle = "";
    }

    public function index(){
        $title = $this->title;
        $subtitle = $this->subtitle;

        return view('home.v_index', compact('title','subtitle'));
    }
}
