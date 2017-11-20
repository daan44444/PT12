<?php
class Validate {
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()) {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                if($item === 'captcha') {
                    if($rule === 'required') {
                        $captcha = new Captcha();
                        if(!$captcha->check($source['g-recaptcha-response'])) {
                            $this->addError("{$item} is required");
                        }
                    }
                } else {
                    $value = $source[$item];
                    $item = escape($item);

                    if($rule === 'required' && empty($value)){
                        $this->addError("{$item} is required");
                    } else {
                        switch($rule){
                            case 'check_email':
                                if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                    //invalid email
                                    $this->addError("{$item} must be valid");
                                }
                                break;
                            case 'min':
                                if(strlen($value) < $rule_value){
                                    $this->addError("{$item} must be a minimum of {$rule_value} characters");
                                }
                                break;
                            case 'max':
                                if(strlen($value) > $rule_value){
                                    $this->addError("{$item} must be a maximum of {$rule_value} characters");
                                }
                                break;
                            case 'matches':
                                if($value != $source[$rule_value]){
                                    $this->addError("{$rule_value} must match {$item}");
                                }
                                break;
                            case 'unique':
                                $check = $this->_db->get($rule_value, array($item, '=', $value));
                                if($check->count()) {
                                    $this->addError("{$item} already exists");
                                }
                                break;
                        }
                    }
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
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
