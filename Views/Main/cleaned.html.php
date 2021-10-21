<?php
$view->extend( 'MauticCoreBundle:Default:content.html.php' );
?>
<div class="content-body">
    <div class="pa-md">
        <h1><?php echo $view['translator']->trans('plugin.blocklist.cleaned') ?></h1>
        <div class="dashboard-widgets cards">
            <div class="card" style="width: 100%; padding: 5px">    
            <?php
            $emails = $contact->getOnlyDeletedLeads();
            empty( $emails ) ? $emails = [] : $emails;
            foreach( $emails as $lead )
            {
                echo "<p>Email: {$lead}</p>";
            }
         ?></div>
        </div>
    </div>
</div>

<div class="dashboard-widgets cards">
    <div class="card" style="width: 100%; padding: 5px">

    