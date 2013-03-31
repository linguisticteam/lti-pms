<?php
    $team = $this->session->userdata('teamdata');
    $user_id = $this->session->userdata('user_id');
    $user_name = $this->session->userdata('user_name');
    $user_role = $this->session->userdata('user_role');
    $user_language = $this->session->userdata('user_language');
?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title><?php echo $team->name; ?> - LTI System Manager</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/general_enclosed_foundicons.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/general_enclosed_foundicons_ie7.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/foundation.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.rating.css" />

        <script src="<?php echo base_url(); ?>js/foundation/foundation.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/custom.modernizr.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.MetaData.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/zepto.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.rating.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.rating.pack.js"></script>

        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.8.24/jquery-ui.js"></script>

    </head>

    <body>

        <nav class="top-bar">
            <ul class="title-area">
                <!-- Title Area -->
                <li class="name">
                    <h1><?php echo anchor('', 'Home') ?></h1>
                </li>
            </ul>

            <section class="top-bar-section">
                <ul class="left">
                    <li class="divider"></li>
                    <?php
                    if ( ($user_role>=USER_ROLE_COORDINATION && $user_language==$team->id) || ($user_role==USER_ROLE_ADMINISTRATOR) )
                    {
                    ?>
                    <li class="has-dropdown"><?php echo anchor('languages/'.$team->shortname, $team->name); ?>
                        <ul class="dropdown">
                            <li><?php echo anchor('languages/'.$team->shortname.'/configuration', 'Configuration'); ?></li>
                        </ul>
                    </li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li class="left"><?php echo anchor('languages/'.$team->shortname, $team->name); ?>
                    <?php
                    }
                    ?>

                    <li class="divider"></li>
                    <li class="has-dropdown"><?php echo anchor('languages/'.$team->shortname.'/videos', 'Videos'); ?>

                        <ul class="dropdown">
                            <?php if ($team->team_permissions==TEAM_CAN_TRANSCRIBE)
                            {
                            ?>
                                <li><label>Transcription</label></li>
                                <li><?php echo anchor('languages/'.$team->shortname.'/videos/transcribing', 'Transcribing'); ?></li>
                                <li><?php echo anchor('languages/'.$team->shortname.'/videos/open_for_translation', 'Open for translation'); ?></li>
                            <?php
                            }
                            ?>
                            <li><label>Translation</label></li>
                            <li><?php echo anchor('languages/'.$team->shortname.'/videos/in_progress', 'In progress'); ?></li>
                            <li><?php echo anchor('languages/'.$team->shortname.'/videos/ready_to_post', 'Ready to post'); ?></li>
                            <li><?php echo anchor('languages/'.$team->shortname.'/videos/posted', 'Posted'); ?></li>
                            <li><?php echo anchor('languages/'.$team->shortname.'/videos/repository', 'Repository'); ?></li>
                            <li><?php echo anchor('languages/'.$team->shortname.'/videos/on_hold', 'On hold'); ?></li>

                            <?php if ($team->team_permissions==TEAM_CAN_TRANSCRIBE){ ?>
                            <li class="divider"></li>
                            <li><?php echo anchor('languages/'.$team->shortname.'/videos/add', 'Add video'); ?></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <?php
                    if ($user_role>=USER_ROLE_COORDINATION)
                    {
                    ?>
                    <li class="has-dropdown"><?php echo anchor('languages/'.$team->shortname.'/users', 'Users'); ?>
                        
                        <?php
                        if ( ($user_role>=USER_ROLE_COORDINATION && $user_language==$team->id) || ($user_role==USER_ROLE_ADMINISTRATOR) )
                        {
                        ?>
                        <ul class="dropdown">
                            <li><?php echo anchor('languages/'.$team->shortname.'/users/add', 'Add user'); ?></li>
                        </ul>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="divider"></li>
                    <?php
                    }
                    ?>
                </ul>

                 <!--Right Nav Section-->
                <ul class="right">
                    <li class="divider hide-for-small"></li>
                    <?php
                    if ($user_name!=NULL)
                    {
                    ?>
                    <li class="has-dropdown"><?php echo anchor('/users/view/'.$user_id, '('.$user_name.')' ); ?>
                        <ul class="dropdown">
                            <li><?php echo anchor('users/edit_profile/'.$user_id, 'Edit profile' ); ?></li>
                            <li><?php echo anchor('home/do_logout', 'Sign Out'); ?></li>
                        </ul>
                    </li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li><?php echo anchor('', 'Sign In'); ?></li>
                    <?php
                    }
                    ?>
                </ul>
            </section>
        </nav>