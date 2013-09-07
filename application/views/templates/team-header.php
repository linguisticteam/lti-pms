<?php
$userinfo = $this->joomlauser->get_user();

$member_id = 0;
$member_name = '';

if (!empty($userinfo))
{
    $member_id = $userinfo->id;
    $member_name = $userinfo->username;
    $member_role = $userinfo->usertype;
}

$team = $this->session->userdata('teamdata');
?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title><?php echo $team->name; ?> - LTI System Manager</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/general_enclosed_foundicons.css" />
<!--        <link rel="stylesheet" href="<?php echo base_url(); ?>css/general_enclosed_foundicons_ie7.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css" />-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/foundation.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css"/>
        <!--<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.rating.css" />-->

        <!--<script src="<?php echo base_url(); ?>js/foundation/foundation.js"></script>-->
        <script src="<?php echo base_url(); ?>js/vendor/custom.modernizr.js"></script>
<!--        <script src="<?php echo base_url(); ?>js/vendor/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.MetaData.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/zepto.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.form.js"></script>-->
<!--        <script src="<?php echo base_url(); ?>js/vendor/jquery.rating.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.rating.pack.js"></script>-->

        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.8.24/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>js/sorttable.js"></script>

    </head>

    <body>

        <nav class="top-bar">
            <ul class="title-area">
                <!-- Title Area -->
                <li class="name">
                    <h1><?php echo anchor('', 'Home') ?></h1>
                </li>
                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <section class="top-bar-section">
                <ul class="left">
                    <li class="divider"></li>
                    <?php
                    if ($this->authorization->check_authorization($member_id, AUTH_CAN_EDIT_GROUP))
                    {
                    ?>
                        <li class="has-dropdown"><?php echo anchor('languages/' . $team->langcode, $team->name); ?>
                            <ul class="dropdown">
                                <li><?php echo anchor('languages/' . $team->langcode . '/configuration', 'Configuration'); ?></li>
                            </ul>
                        </li>
                    <?php
                    }
                    else
                    {
                    ?>
                        <li class="left"><?php echo anchor('languages/' . $team->langcode, $team->name); ?>
                    <?php
                    }
                    ?>

                    <li class="divider"></li>
                    <li class="has-dropdown"><?php echo anchor('languages/' . $team->langcode . '/videos', 'Videos'); ?>

                        <ul class="dropdown">
                    <?php
                    if ($team->team_permissions == TEAM_CAN_TRANSCRIBE)
                    {
                        ?>
                            <li><label>Transcription</label></li>
                            <li><?php echo anchor('languages/' . $team->langcode . '/videos/transcribing', 'In progress'); ?></li>
                            <li><?php echo anchor('languages/' . $team->langcode . '/videos/open_for_translation', 'Open for translation'); ?></li>
                        <?php
                    }

                    if ($team->team_permissions != TEAM_CAN_TRANSCRIBE)
                    {
                        ?>
                            <li><label>Translation</label></li>
                            <li><?php echo anchor('languages/' . $team->langcode . '/videos/in_progress', 'In progress'); ?></li>
                            <li><?php echo anchor('languages/' . $team->langcode . '/videos/ready_to_post', 'Ready to post'); ?></li>
                            <li><?php echo anchor('languages/' . $team->langcode . '/videos/posted', 'Posted'); ?></li>
                            <li><?php echo anchor('languages/' . $team->langcode . '/videos/repository', 'Repository'); ?></li>
                            <li><?php echo anchor('languages/' . $team->langcode . '/videos/on_hold', 'On hold'); ?></li>
                        <?php
                    }
                    ?>

                            <?php if ($team->team_permissions == TEAM_CAN_TRANSCRIBE && ($this->authorization->check_authorization($member_id, AUTH_CAN_ADD_VIDEO)))
                            { ?>
                                <li class="divider"></li>
                                <li><?php echo anchor('languages/' . $team->langcode . '/videos/add', 'Add video'); ?></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>

                <!--Right Nav Section-->
                <ul class="right">
                    <li class="divider hide-for-small"></li>

                    <?php
                    if ($member_id == 0)
                    {
                        ?>
                        <li><?php echo anchor('http://members.linguisticteam.org/', 'Sign In'); ?></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li class="has-dropdown"><?php echo anchor('members/view/' . $member_id, '(' . $member_name . ')'); ?>
                            <ul class="dropdown">
                                <li><?php echo anchor('members/edit_language/', 'Edit language'); ?></li>
                            </ul>
                        </li>
                        <!--<li><?php echo anchor('', '(' . $member_name . ')'); ?></li>-->
                        <?php
                    }
                    ?>
                </ul>

            </section>
        </nav>