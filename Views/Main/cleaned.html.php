<?php
$view->extend( 'MauticCoreBundle:Default:content.html.php' );
?>
<div class="content-body">
    <div class="pa-md">
        <h1><?php echo $view['translator']->trans('plugin.blocklist.cleaned') ?></h1>
        <?php
            $emais = $contact->getFromBlocklist();
            echo '<pre>';
            print_r( $emais );
            echo '</pre>';
        ?>
    </div>
</div>