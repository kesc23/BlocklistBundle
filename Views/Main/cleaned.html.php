<?php
/**
 * @package Blocklist
 * @author  Kevin Campos
 * @version 1.1.0
 * @license GPL v3 or later
 */
$view->extend( 'MauticCoreBundle:Default:content.html.php' );
?>
<div class="content-body">
    <div class="pa-md">
        <h1><?php echo $view['translator']->trans('plugin.blocklist.cleaned') ?></h1>
        <div class="dashboard-widgets cards">
        <?php
            $emails = $contact->getOnlyDeletedLeads();
            if( ! empty( $emails ) ):
            ?><div class="card" style="width: 100%; padding: 5px">    
            <?php                
                foreach( $emails as $lead )
                {
                    echo "<p>Email: {$lead}</p>";
                }
                ?>
            </div><?php
            else:?>
            </div>
            <div style="margin: 70px auto; opacity: .5; text-align: center">
                <h2><?php echo $view['translator']->trans('plugin.blocklist.nodeleted') ?></h2>
            <?php
            endif;
        ?></div>
    </div>
</div>    