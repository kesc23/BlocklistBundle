<?php
$view->extend( 'MauticCoreBundle:Default:content.html.php' );
?>
<div class="content-body">
    <div class="pa-md">
        <h1><?php echo $view['translator']->trans('plugin.blocklist.cleaned') ?></h1>
        <?php
            $emails = $contact->getOnlyDeletedLeads();
            empty( $emails ) ? $emails = [] : $emails;
            foreach( $emails as $lead )
            {
                echo "<p>Email: {$lead}</p>";
            }
        ?>
    </div>
</div>