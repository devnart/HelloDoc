<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        /* Test (database and table needs to exist before this works)
        public function getUsers() {
            $this->db->query("SELECT * FROM users");

            $result = $this->db->resultSet();

            return $result;
        }
        */

        public function checkRef($data){
            $this->db->query("SELECT * FROM user WHERE refrence=:refrence");

            $this->db->bind(':reference', $data);

            $refCount = $this->db->rowCount();

            return $refCount;
        }


        public function getUser($data){

            $this->db->query("SELECT * FROM user WHERE Ref=:reference");

            $this->db->bind(':reference', $data);
            // $this->db->bind(':password', $data['password']);

            $user = $this->db->single();

            return $user;
        }


        public function createUser($ref,$data){


            $this->db->query("INSERT INTO user (Ref,name,dob,password) VALUES (:reference,:name,:dob,:password)");

            $this->db->bind(':reference', $ref);
            $this->db->bind(':name', $data->name);
            $this->db->bind(':dob', $data->dob);
            $this->db->bind(':password', $data->password);

            $this->db->execute();

            return $this->getUser($ref);

        }
    }
