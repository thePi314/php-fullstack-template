<?php
    namespace Models;

    use Controllers\DataBase;
    use Controllers\DataFetcher;
    use Controllers\Session;

class User{
        public $id       = null;
        public $fname    = null;
        public $lname    = null;
        public $username = null;
        public $email    = null;
        
        public function __construct($id,$fname,$lname,$username,$email)
        {
            $this->id       = $id;
            $this->fname    = $fname;
            $this->lname    = $lname;
            $this->username = $username;
            $this->email    = $email;
        }

        public function sessionSave(){
            Session::set('username',$this->username);
        }

        public static function fetchById($id) {
            $db   = new DataBase();
            
            $result = $db->select('USERS',null,'ID='.$id);
            if( !$result ) {
                header('Location: /');
                return null;
            }

            $result = $result[0];
            return new User($result['ID'],$result['FNAME'],$result['LNAME'],$result['USERNAME'],$result['EMAIL']);
        }

        public static function create() {
            $data   = (object) DataFetcher::fetch_data();
            $db     = new DataBase();
            $userID = $db->insert('USERS',[ 
                'USERNAME' => $data->username,
                'FNAME'    => $data->fname,
                'LNAME'    => $data->lname,
                'EMAIL'    => $data->email,
                'PASSWORD' => $data->password
            ]);

            return $userID;
        }

        public static function remove($id){
            $db = new DataBase();

            $db->delete('USERS','ID='.$id);
        
            return true;
        }

        public static function update($userId) {
            $data = (object) DataFetcher::fetch_data();

            $db = new DataBase();
            $db->update('USERS',[
                'USERNAME' => $data->username,
                'FNAME'    => $data->fname,
                'LNAME'    => $data->lname,
                'EMAIL'    => $data->email
            ],'ID='.$userId);

            return 'success';
        }

        public static function login($username, $password){
            $db = new DataBase();

            $result = $db->select('USERS',null,'(USERNAME = \''.$username.'\' OR EMAIL = \''.$username.'\') AND PASSWORD=\''.$password.'\';');
            if (!$result)
                return false;

            $result = $result[0];
            return new User($result['ID'],$result['FNAME'],$result['LNAME'],$result['USERNAME'],$result['EMAIL']);
        }

        public static function fetchAll() {
            $data = [];
            
            $db = new DataBase();
            $result = $db->select('USERS');
            if(!$result)
                return [];

            foreach ($result as $user) 
                $data[] = new User($user['ID'],$user['FNAME'],$user['LNAME'],$user['USERNAME'],$user['EMAIL']);
            
            return $data;
        }
    }
