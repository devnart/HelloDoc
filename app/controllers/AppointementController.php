<?php

class AppointementController extends Controller
{

    public $data = [];
    
    public function __construct()
    {
        
        $this->AppointmentModel = $this->model('Appointment');
        //$this->userModel = $this->model('User');
    }

    public function add()
    {
        // die(var_dump($this->data));
        $apnt = $this->AppointmentModel->addAppointment($this->data);
        
        if ($apnt) {
            print_r(json_encode(array(
                "message" => "Appoientment Created with success",
                "data" => $this->data
            )));
        } else {
            print_r(json_encode(array(
                'error' => "Error",
            )));
            
        }
    }

    public function getApnt($data)
    {
        $apnt = $this->AppointmentModel->getAppointment($data);
        print_r(json_encode($apnt));
    }

    public function update()
    {

        $apnt = $this->AppointmentModel->updateAppointment($this->data);

        if ($apnt) {
            print_r(json_encode(array(
                "message" => "Appoientment Created with success",
            )));
        } else {
            print_r(json_encode(array(
                'error' => "Error",
            )));

            die();
        }
    }

    public function delete($data)
    {
        $this->AppointmentModel->deleteAppointment($data);

    }
    public function check($data) {
        $reserved = $this->AppointmentModel->checkAvailable($data);
        print_r(json_encode($reserved));

    }


}
