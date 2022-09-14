<?php
/**
 * @package Blocklist
 * @author  Kevin Campos
 * @license GPL v3 or later
 */

$view->extend( 'MauticCoreBundle:Default:content.html.php' );
$tr = $view['translator'];
$view['slots']->set( 'headerTitle', $tr->trans( 'plugin.blocklist.cleaned' ) );

$page = isset( $_GET['page'] ) ? filter_var( $_GET[ 'page' ], FILTER_VALIDATE_INT ) : 1;

$start = ( $page -1 ) * 20;
$end   = $page * 20;

$count = (int) ceil(sizeof( $emails ) / 20);

?>
<div class="content-body">
    <div class="pa-md">
        <div class="dashboard-widgets cards">
        <?php
            if( ! empty( $emails ) ):
            ?><div style="margin: auto; opacity: .5; text-align: center">
                <h3><?php echo $view['translator']->trans('plugin.blocklist.totaldeleted') . ": " . count( $emails ) ?></h3>
                <h5><?php echo "showing from $start to $end" ?></h5>
                <h1><?php echo "$count" ?></h1>
            </div>
            <div class="panel" style="width: 100%; padding: 5px">
                <?php                
                    for( $i = $start; $i < $end; $i ++ )
                    {
                        echo "<p>{$emails[$i]}</p>";
                    }
                ?>
            </div><?php
            else:?>
            </div>
            <div style="margin: 70px auto; opacity: .5; text-align: center">
                <h2><?php echo $view['translator']->trans('plugin.blocklist.nodeleted') ?></h2>
            <?php
            endif;
        ?>
        <div style="display: flex">

        </div>
        </div>
    </div>
</div>    