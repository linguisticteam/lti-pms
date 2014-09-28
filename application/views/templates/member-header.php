<?php    
$userinfo = $this->joomlauser->get_user();

$member_id = 0;
$member_name = '';

if (!empty($userinfo))
{
    $member_id = $userinfo->id;
    $member_name = $userinfo->username;
}
?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title>LTI-PMS</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/general_enclosed_foundicons.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/general_enclosed_foundicons_ie7.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/foundation.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.rating.css" />

        <script src="<?php echo base_url(); ?>js/foundation/foundation.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/custom.modernizr.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.MetaData.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/zepto.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.rating.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/jquery.rating.pack.js"></script>

        <script src="<?php echo base_url(); ?>js/jquery-1.8.2.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>

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
                 <!--Right Nav Section-->
                <ul class="right">
                    <li class="divider hide-for-small"></li>
                     <?php
                    if ($member_id==0)
                    {
                    ?>
                    <li><?php echo anchor('http://members.linguisticteam.org/', 'Sign In'); ?></li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li class="has-dropdown"><?php echo anchor('members/view/'.$member_id, '('.$member_name.')' ); ?>
                        <ul class="dropdown">
                            <li><?php echo anchor('members/edit_language/', 'Edit language' ); ?></li>                            
                        </ul>
                    </li>
                    <!--<li><?php echo anchor('', '('.$member_name.')'); ?></li>-->
                    <?php
                    }
                    ?>
                </ul>
            </section>
        </nav>
