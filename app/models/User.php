<?php
class User {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {

                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = array()) {
        $this->_db->insert(Config::get('db/user_table_name'), $fields);
    }

    public function find($user = null) {
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : Config::get('db/user_uname_field_name');
            $data = $this->_db->get(Config::get('db/user_table_name'), array($field, '=', $user));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null, $remember = false) {

        if (!$username && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($username);

            if ($user) {
                if($this->data()->active == 1) {
                    if($this->data()->password === Hash::make($password, $this->data()->salt)) {
                        Session::put($this->_sessionName, $this->data()->id);
                        if ($remember) {
                            $hash = Hash::unique();
                            $hashCheck = $this->_db->get(Config::get('db/user_session_table_name'), array('user_id', '=', $this->data()->id));

                            if(!$hashCheck->count()) {
                                $this->_db->insert(Config::get('db/user_session_table_name'), array(
                                    'user_id' => $this->data()->id,
                                    'hash' => $hash
                                ));
                            } else {
                                $hash = $hashCheck->first()->hash;
                            }

                            Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                        }

                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout() {

        $this->_db->delete(Config::get('db/user_session_table_name'), array('user_id', '=', $this->data()->id));

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    public function update($fields = array(), $id = null) {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(!$this->_db->update(Config::get('db/user_table_name'), $id, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    public function data() {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }

    public function hasPermission($key) {
        $group = $this->_db->get(Config::get('db/groups_table_name'), array('id', '=', $this->data()->group));

        if ($group->count()) {
            $permissions = json_decode($group->first()->permissions, true);
            if ($permissions[$key] == true) {
                return true;
            }
        }

        return false;
    }
}
