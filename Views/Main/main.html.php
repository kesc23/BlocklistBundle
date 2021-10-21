<?php
$view->extend( 'MauticCoreBundle:Default:content.html.php' );

$header = 'Block List';

?>
<div class="content-body">
    <div class="pa-md">
        <h1><?php echo $view['translator']->trans('plugin.blocklist.titleh1') ?></h1>
        <div class="dashboard-widgets cards">
            <div class="card-flex widget" style="width: 50%">
                <div class="card" style="padding: 5px">
                    <form action="/s/blocklist" method="post">
                        <fieldset>
                            <label for="leadsarea"><?php echo $view['translator']->trans('plugin.blocklist.ta_labelmsg') ?></label>
                            <textarea class="form-control" name="leadsarea" id="leadsarea" cols="30" rows="10"></textarea>
                        </fieldset>
                        <hr style="margin: 3px; visibility: hidden">
                        <button class="btn btn-success" type="submit"><?php echo $view['translator']->trans('plugin.blocklist.subbtn') ?></button>
                    </form>
                </div>
                <div class="card" style="padding: 5px">
                    <details>
                        <summary style="cursor: pointer"><?php echo $view['translator']->trans('plugin.blocklist.remove_call') ?></summary>
                        <form action="/s/blocklist" method="post">
                            <fieldset>
                                <label for="remove_leadsarea"><?php echo $view['translator']->trans('plugin.blocklist.ta_labelmsg') ?></label>
                                <textarea class="form-control" name="remove_leadsarea" id="remove_leadsarea" cols="30" rows="10"></textarea>
                            </fieldset>
                            <hr style="margin: 3px; visibility: hidden">
                            <button class="btn btn-danger" type="submit"><?php echo $view['translator']->trans('plugin.blocklist.remove_subbtn') ?></button>
                        </form>
                    </details>
                </div>
            </div>
            <div class="card-flex widget" style="width: 50%">
                <?php $leads = $contact->getLeadEmails();
                if( $leads ):?>
                <div class="card" style="padding: 5px">
                    <h3><?php echo $view['translator']->trans('plugin.blocklist.deletemsg') ?></h3>
                    <div style="max-height: 400px; padding: 5px; box-shadow: inset 0px 0px 4px rgb(0 0 0 / 15%);border-radius: 3px; overflow-y: auto;"><?php
                        foreach( $leads as $lead )
                        {
                            echo "<p>Email: {$lead}</p>";
                        }
                    ?></div>
                    <hr style="margin: 3px; visibility: hidden">
                    <form action="/s/blocklist/clean">
                        <button class="btn btn-danger" type="submit"><?php echo $view['translator']->trans('plugin.blocklist.block_em') ?></button>
                    </form>
                </div>
                <?php
                    endif;
            ?></div>
        </div>
    </div>
</div>