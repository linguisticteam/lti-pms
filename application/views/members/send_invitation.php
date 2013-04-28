<?php
$id = $this->uri->segment(3);
$team_langcode = $this->uri->segment(4);

if ($id==NULL) redirect('members');

$member_name = $this->session->userdata('member_name');
$member_email = $this->session->userdata('member_email');

$query = $this->members_model->get_members($id);

?>

<div class="row">
    <div class="large-12 columns">
        <br />
        
        <?php
        
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        
        
        $this->email->initialize($config);
        
        $this->email->set_newline("\r\n"); 

        $this->email->from($member_email, $member_name);
        $this->email->to($query->email);

        $this->email->subject('Welcome to Linguistic Team International');
        
        
        $message = '<h3>Hello '.$query->name.',</h3>';
        $message .= '<p>Please join us at Linguistic Team International as we work together \'translating to change the world\'.<br />';               
        $message .= 'Visit our PMS below to gain access to all of the materials within our care.</p> ';
        
        $message .= '<p><a href="http://pms.linguisticteam.org" target="_blank">http://pms.linguisticteam.org</a></p>';
        
        $message .= '<p>Your username is: <em>'.$query->email.' </em><br />';
        $message .= 'Your password is: <em>lti</em><p/>';

        $message .= 'It is strongly recommended that you change this temporary password, and then log out and back in with your new password before doing anything else. ';
        $message .= 'Then complete your profile so we can get to know you better. ';
        $message .= 'If you have not already done so, be sure to introduce yourself to the rest of the folks in the ';
        $message .= '<a href="http://forum.linguisticteam.org/board217-help-desk/board252-introduce-yourself/" target="_blank">Introduce Yourself</a> board. ';
        $message .= 'Then take some time to explore the Forum and have fun getting to know the rest of the LTI Community. </p>';
        $message .= '<br />';
                
        $message .= '<p>Welcome to Linguistic Team International.<p/>';
        
        $this->email->message($message);

        $this->email->send();
        
        echo '<div class="alert-box success">Message sent!</div>';
        echo '<a href="#" data-reveal-id="firstModal" class="radius button">See details...</a> ';
        echo '<a href="JavaScript:window.close()" class="radius button">Close and go back to members!</a>';
        
        ?>
        
        <div id="firstModal" class="reveal-modal">
            <h2>Message info:</h2>
            <?php echo $this->email->print_debugger(); ?>
            <a class="close-reveal-modal">&#215;</a>
        </div>

        
    </div>
</div>