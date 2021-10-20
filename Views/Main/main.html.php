<?php
$view->extend( 'MauticCoreBundle:Default:content.html.php' );

$header = 'Block List';

?>
<div class="content-body">
    <div class="pa-md">
        <!-- <pre><?php  
        # print_r( $contact->addToBlocklist( 'kesc23@hotmail.com' ) );
        # print_r( $contact->getTables() );
        # print_r( $contact->dostos() );
        ?></pre>-->
        <h1><?php echo $view['translator']->trans('plugin.blocklist.titleh1') ?></h1>
        <div class="dashboard-widgets cards">
            <div class="card-flex widget" style="width: 50%">
                <div class="card" style="padding: 5px">
                <form action="/s/blocklist">
                    <fieldset>
                        <label for="leadsarea"><?php echo $view['translator']->trans('plugin.blocklist.ta_labelmsg') ?></label>
                        <textarea class="form-control" name="leadsarea" id="leadsarea" cols="30" rows="10"></textarea>
                    </fieldset>
                    <button class="btn btn-success" type="submit"><?php echo $view['translator']->trans('plugin.blocklist.subbtn') ?></button>
                </form>
                </div>
            </div>
            <div class="card-flex widget" style="width: 50%">
                <div class="card" style="padding: 5px">
                    <?php $leads = $contact->getLeadEmails();
                    if( $leads ):?>
                    <h3><?php echo $view['translator']->trans('plugin.helloworld.deletemsg') ?></h3>
                    <div style="max-height: 400px; padding: 5px; box-shadow: inset 0px 0px 4px rgb(0 0 0 / 15%);border-radius: 3px; overflow-y: auto;"><?php
                        foreach( $leads as $lead )
                        {
                            echo "<p>Email: {$lead}</p>";
                        }
                    ?></div><?php
                    endif;
                ?></div>
            </div>
        </div>
    </div>
</div>