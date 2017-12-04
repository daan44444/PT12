<?php
class Confirm {
    private $_passed = false,
            $_errors = array(),
            $_db = null,
            $_mail = null,
            $_user = null;

    public function __construct() {
        $this->_db = DB::getInstance();
        $this->_mail = new Mail();
        $this->_user = new User();
    }

    public function setup($email) {
        $result = $this->_db->get(Config::get('db/user_table_name'), array('email', '=', $email))->first();
        $id = $result->id;
        $confirm_code = Hash::unique();

        $check = $this->_db->get(Config::get('db/user_confirm_table_name'), array('user_id', '=', $id));
        if($check->count()){
            $id_update = $check->first()->id;
            if($this->_db->update(Config::get('db/user_confirm_table_name'), $id_update, array(
                'confirm_code' => $confirm_code,
                'invalid_date' => date('Y-m-d H:i:s', strtotime(Config::get('confirm/valid_time')))
            ))) {
                if($this->_mail->sendConfirm($email, $id, $confirm_code)) {
                    return true;
                }
            }
        } else {
            if($this->_db->insert(Config::get('db/user_confirm_table_name'), array(
                'user_id' => $id,
                'confirm_code' => $confirm_code,
                'invalid_date' => date('Y-m-d H:i:s', strtotime(Config::get('confirm/valid_time')))
            ))) {
                if($this->_mail->sendConfirm($email, $id, $confirm_code)) {
                    return true;
                }
            }
        }

        $this->_db->delete(Config::get('db/user_table_name'), array('id', '=', $id));
        $this->addError("Fatal error");
        return false;
    }

    public function check($id, $cc) {
        $check = $this->_db->get(Config::get('db/user_confirm_table_name'), array('user_id','=',$id));

        if($check->count()) {
            $confirm_code_db = $check->first()->confirm_code;
            $invalid_date_db = $check->first()->invalid_date;
            $get = $this->_db->get(Config::get('db/user_table_name'), array('id', '=', $id))->first();
            $confirmed = $get->confirmed;
            $email = $get->email;

            if($confirmed !== "1") {

                if($cc === $confirm_code_db) {

                    if(date('Y-m-d H:i:s') < $invalid_date_db) {

                    } else {
                        if($this->setup($email)) {
                            $this->addError("This link is expired, a new link is sent to your email");
                        } else {
                            $this->addError("Fatal error");
                        }
                    }
                } else {
                    $this->addError("Confirm code does not match");
                }
            } else {
                if($this->delete($id)) {
                    $this->addError("Your account has already been confirmed");
                } else {
                    $this->addError("Fatal error");
                }
            }
        } else {
            $this->addError("ID not found");
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    private function delete($id) {
        if($this->_db->delete(Config::get('db/user_confirm_table_name'), array('user_id','=',$id))) {
            return true;
        }

        $this->addError("Fatal error");
        return false;
    }

    private function addError($error) {
        $this->_errors[] = $error;
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

}
