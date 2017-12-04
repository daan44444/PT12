<?php

class Login extends Controller
{
    public function index($id = '', $cc = '')
    {
        $user = new User();
        if($user->isLoggedin()) {
            Redirect::to('home');
        }

        $confirm = new Confirm();
        if($confirm->check($id, $cc)->passed()) {
            $this->view('default/head');
            $this->view('login/header');
            $this->view('login/registerForm');
            $this->view('login/lower');
            $this->view('default/bodyEnd');
            $this->view('login/scripts');
            $this->view('default/bodyEndTwo');
        } else {
            $errors = "";
            $registerPassed = false;
            if(Input::exists()) {
                if(Input::get('login') !== '') {
                    if(Token::check(Input::get('token'))) {

                        $validate = new Validate();
                        $validation = $validate->check($_POST, array(
                            'email' => array('required' => true),
                            'password' => array('required' => true)
                        ));

                        if($validation->passed()) {

                            $remember = (Input::get('remember') === 'on') ? true : false;
                            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                            if($login) {
                                //logged in
                                $id = DB::getInstance()->get(Config::get('db/user_table_name'), array('username', '=', Input::get('username')))->first()->id;
                                $forgot = new Forgot();
                                $forgot->delete($id);

                                //Session::flash('home', 'Logged in');
                                Redirect::to('test/lol');
                            } else {
                                //Not logged in
                                $errors = array('Incorrect information');
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
                                'check_email' => true,
                                'unique' => 'user'
                            )
                        ));

                        if($validation->passed()) {

                            try {
                                $user->create(array(
                                    'email' => Input::get('email'),
                                    'joined' => date('Y-m-d H:i:s')
                                ));

                                if($confirm->setup(Input::get('email'))){
                                    $errors = array("A confirm email has been sent to your inbox");
                                    $registerPassed = true;
                                }

                            } catch (Exception $e) {
                                die($e->getMessage());
                            }
                        } else {
                            $errors = $validation->errors();
                        }
                    }
                }

            }

            $this->view('default/head');
            $this->view('login/header');
            $this->view('login/index', ['errors' => $errors, 'registerPassed' => $registerPassed]);
            $this->view('login/lower');
            $this->view('default/bodyEnd');
            $this->view('default/bodyEndTwo');
        }
    }
}
