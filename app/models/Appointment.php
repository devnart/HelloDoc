<?php
    class Appointment {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function addAppointment($data){

            $this->db->query("INSERT INTO rdv (date,startTime,endTime,clientRef) VALUES (:date,:startTime,:endTime,:clientRef)");

            $this->db->bind(':date', $data->date);
            $this->db->bind(':startTime', $data->startTime);
            $this->db->bind(':endTime', $data->endTime);
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
            $this->db->query("UPDATE rdv SET 'date'=:date,'startTime'=:startTime,'endTime'=:endTime WHERE 'id'=:id");

            $this->db->bind(':date', $data['date']);
            $this->db->bind(':startTime', $data['startTime']);
            $this->db->bind(':endTime', $data['endTime']);
            $this->db->bind(':id', $data['id']);

            $this->db->execute();
        }

        public function deleteAppointment($data){

            $this->db->query("DELETE FROM rdv WHERE id=:id");

            $this->db->bind(':id', $data);

            $this->db->execute();
        }
    }