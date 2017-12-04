<?php

class Login extends Controller
{
    public function index()
    {
        $user = new User();
        if($user->isLoggedin()) {
            Redirect::to('home');
        }

        $errors = "";
        if(Input::exists()) {
            if(Input::get('login') !== '') {
                if(Token::check(Input::get('token'))) {

                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'email' => array('required' => true),
                        'password' => array('required' => true)
                    ));

                    if($validation->passed()) {
                        $user = new User();

                        $remember = (Input::get('remember') === 'on') ? true : false;
                        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                        if($login) {
                            //logged in
                            $id = DB::getInstance()->get('users', array('username', '=', Input::get('username')))->first()->id;
                            $forgot = new Forgot();
                            $forgot->delete($id);

                            //Session::flash('home', 'Logged in');
                            Redirect::to('test/lol');
                        } else {
                            //Not logged in
                        }
                    } else {
                        $errors = $validation->errors();
                    }
                }
            } else if(Input::get('register') !== '') {
                if(Token::check(Input::get('token'))) {

                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'email' => array(
                            'required' => true,
                            'check_email' => true
                        )
                    ));

                    if($validation->passed()) {
                        $user = new User();
                        
                    } else {
                        $errors = $validation->errors();
                    }
                }
            }

        }


        $this->view('default/head');
        $this->view('login/index', ['errors' => $errors]);
        $this->view('default/bodyEnd');
    }
}
