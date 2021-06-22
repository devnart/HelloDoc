<?php
    class Appointment {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function addAppointment($data){

            $this->db->query("INSERT INTO rdv (date,slot,clientRef) VALUES (:date,:slot,:clientRef)");

            $this->db->bind(':date', $data->date);
            $this->db->bind(':slot', $data->slot);
            $this->db->bind(':clientRef', $data->clientRef);

            
            if($this->db->execute()){
                return true;
            }else {
                return false;
            }
        }

        public function getAppointment($data){

            $this->db->query("SELECT * FROM rdv WHERE clientRef=:reference");

            $this->db->bind(':reference', $data);

            $rdv = $this->db->resultSet();

            return $rdv;
        }


        public function updateAppointment($data){
            $this->db->query("UPDATE rdv SET 'date'=:date,'slot'=:slot, WHERE 'clientRef'=:clientRef");

            $this->db->bind(':date', $data->date);
            $this->db->bind(':slot', $data->slot);
            $this->db->bind(':clientRef', $data->clientRef);


            $this->db->execute();
        }

        public function deleteAppointment($data){

            $this->db->query("DELETE FROM rdv WHERE id=:id");

            $this->db->bind(':id', $data);

            $this->db->execute();
        }

        public function checkAvailable($data){
            $this->db->query("SELECT slot FROM rdv WHERE date=:date");

            $this->db->bind(':date', $data);

            $rdv = $this->db->resultSet();

            return $rdv;

        }
    }