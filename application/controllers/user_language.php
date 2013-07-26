<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_language extends CI_Controller
{
    public function index()
    {
        $user_id = $_POST['user_id'];
        $language_id = $_POST['language_id'];
        $state = $_POST['state'];

        $this->members_model->set_user_languages($user_id, $language_id, $state);
    }
}

?>