<?php


namespace App\Http\Controllers;


class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        return view('pages.home', $this->data);
    }
}
