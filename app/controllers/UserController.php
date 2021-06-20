<?php
class UserController extends Controller
{

    public $data = [];

    public function __construct()
    {

        $this->userModel = $this->model('user');
    }

    public function register()
    {
        function generateRef($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }


        $ref =  generateRef();
        
        $this->userModel->createUser($ref,$this->data);
    }

    public function singleUser($data)
    {
        $user = $this->userModel->getUser($data);
        print_r(json_encode($user));
    }
}
