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
        <title><?php echo $title; ?> - LTI System Manager</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/foundation.css" />
        <script src="<?php echo base_url(); ?>js/vendor/custom.modernizr.js"></script>
        
    </head>

    <body>

        <nav class="top-bar">
            <ul class="title-area">
                <!-- Title Area -->
                <li class="name">
                    <h1><?php echo anchor('', 'Home'); ?></h1>
                </li>
                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <section class="top-bar-section">
                <ul class="left">
                </ul>
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