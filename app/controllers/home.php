<?php

class Home extends Controller
{
    public function index()
    {
        $this->view('default/head');
        $this->view('home/index');
        $this->view('default/bodyEnd');
    }
}
