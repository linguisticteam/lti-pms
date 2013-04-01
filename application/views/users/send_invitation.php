<?php
$id = $this->uri->segment(3);

if ($id==NULL) redirect('users');

$user_name = $this->session->userdata('user_name');
$user_email = $this->session->userdata('user_email');

$query = $this->users_model->get_users($id);

?>

<div class="row">
    <div class="large-12 columns">

        <?php
        
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
//        $config['protocol'] = 'mail';
        
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'michaelycus@gmail.com';
        $config['smtp_pass'] = 'shoryuken';
        $config['smtp_port'] = '465'; 
        
        
        $this->email->initialize($config);
        
        $this->email->set_newline("\r\n"); 

        $this->email->from($user_email, $user_name);
        $this->email->to($query->email);

        $this->email->subject('LTI - Invitation');
        
        
        $message = '<p>Hello '.$query->name.',<br /><br />';
        $message .= '<p>You have been invited to join us at Linguistic Team International as we work together \'translating to change the world\'.<br />';
        $message .= 'Please, go to our PMS to have access to all our material.</p>';
        
        $message .= '<p><a href="http://pms.linguisticteam.org" target="_blank">http://pms.linguisticteam.org</a></p>';
        
        $message .= '<p>Your username is: <em>'.$query->email.' </em><br/>';
        $message .= 'Your password is: <em>lti</em><p/>';

        $message .= '<p>We strongly recommend you change the password FIRST. '; 
        $message .= 'Then complete your profile so we can get to know you better. ';
        $message .= 'Be sure to introduce yourself to the Team in the <a href="http://forum.linguisticteam.org/board217-help-desk/board252-introduce-yourself/" target="_blank">Thread</a> under Help Desk. Then have fun as you explore the Forum and locate your <a href="http://wiki.linguisticteam.org/w/Category:Language_Coordinators">Language Team Coordinator</a>. <p/>';
                
        $message .= '<p>Welcome to the Linguistic Team International.<p/>';
        
        $this->email->message($message);

        $this->email->send();

        echo $this->email->print_debugger();

        ?>
    </div>
</div>