<script type="text/javascript">
    function changeStatus(user_id, language_id, state)
    {
        var elementId = user_id + '_' + language_id;
        $('#' + elementId).html('<div><img src="<?php echo base_url(); ?>/img/loading.gif"></div>');

        var url = '<?php echo base_url(); ?>' + 'index.php/user_language';

        $.post(url,
                {
                    user_id: user_id, language_id: language_id, state: state
                },
        function() {
            if (state == 'yes')
            {
                $('#' + elementId).html('<a href="#" id="' + user_id + '_' + language_id + '" onClick="return false" onmousedown="javascript:changeStatus(' + user_id + ',' + language_id + ',\'no\')"><img src="<?php echo base_url(); ?>/img/unchecked.png"/></a>');
            }
            else
            {
                $('#' + elementId).html('<a href="#" id="' + user_id + '_' + language_id + '" onClick="return false" onmousedown="javascript:changeStatus(' + user_id + ',' + language_id + ',\'yes\')"><img src="<?php echo base_url(); ?>/img/checked.png"/></a>');
            }
        });
    }
</script>


<?php
$team = $this->session->userdata('teamdata');
$member_role = $userinfo->usertype;
$member_id = $userinfo->id;
$member_username = $userinfo->username;
$member_name = $userinfo->name;

$heading = array();
$language_ids = array();

array_push($heading, 'Members');

foreach ($teams as $t)
{
    array_push($language_ids, $t->id);
    array_push($heading, $t->langcode);
}

$this->table->set_heading($heading);

if ($this->authorization->check_authorization($member_id, AUTH_CAN_EDIT_USERS_LANGUAGES))
{    
    foreach ($members as $m)
    {
        $user_languages = $this->members_model->get_user_languages($m->id);

        $list_languages = array();

        array_push($list_languages, $m->name . ' (' . $m->username . ')');

        foreach ($language_ids as $l_i)
        {
            $hasLanguage = FALSE;

            foreach ($user_languages as $u_l)
            {
                if ($l_i == $u_l->language_id)
                    $hasLanguage = TRUE;
            }

            if ($hasLanguage)
            {
                array_push($list_languages, '<a href="#" id="' . $m->id . '_' . $l_i . '" onClick="return false" onmousedown="javascript:changeStatus(' . $m->id . ',' . $l_i . ',\'yes\')"><img src="'.base_url().'/img/checked.png"/></a>');
            }
            else
            {
                array_push($list_languages, '<a href="#" id="' . $m->id . '_' . $l_i . '" onClick="return false" onmousedown="javascript:changeStatus(' . $m->id . ',' . $l_i . ',\'no\')"><img src="'.base_url().'/img/unchecked.png"/></a>');
            }
        }

        $this->table->add_row($list_languages);
    }

    echo $this->table->generate();
    
}
else
{
    $user_languages = $this->members_model->get_user_languages($member_id);

    $list_languages = array();

    array_push($list_languages, $member_name . ' (' . $member_username. ')');

    foreach ($language_ids as $l_i)
    {
        $hasLanguage = FALSE;

        foreach ($user_languages as $u_l)
        {
            if ($l_i == $u_l->language_id)
                $hasLanguage = TRUE;
        }

        if ($hasLanguage)
        {
            array_push($list_languages, '<a href="#" id="' . $member_id . '_' . $l_i . '" onClick="return false" onmousedown="javascript:changeStatus(' . $member_id . ',' . $l_i . ',\'yes\')">Yes</a>');
        }
        else
        {
            array_push($list_languages, '<a href="#" id="' . $member_id . '_' . $l_i . '" onClick="return false" onmousedown="javascript:changeStatus(' . $member_id . ',' . $l_i . ',\'no\')">No</a>');
        }
    }

    $this->table->add_row($list_languages);
    

    echo $this->table->generate();
}
