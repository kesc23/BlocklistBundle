<?php
/**
 * @package Blocklist
 * @author  Kevin Campos
 * @license GPL v3 or later
 */

$view->extend( 'MauticCoreBundle:Default:content.html.php' );
$tr = $view['translator'];
$view['slots']->set( 'headerTitle', $tr->trans( 'plugin.blocklist.cleaned' ) );
?>
<div class="content-body">
    <div class="pa-md">
        <div class="dashboard-widgets cards">
            <?php if( ! empty( $emails ) ): ?>
            <div style="margin: auto; opacity: .5; text-align: center; padding-block-end: 16px">
                <h3><?php echo $view['translator']->trans('plugin.blocklist.totaldeleted') . ": " . $emails->total ?></h3>
            </div>
            <div class="panel" style="width: 100%; padding: 5px">
                <?php                
                    foreach( $emails->content as $email )
                    {
                        echo "<p>{$email}</p>";
                    }
                ?>
            </div>
            <div style="display: flex; width: -webkit-fill-available; justify-content: center;">
            <?php
                $reference      = 0;
                $primaryChecker = 0;

                if( $emails->page < 5 ):
                    $reference = 1;
                    $primaryChecker = $emails->page;
                elseif( 5 > ($emails->totalPages - $emails->page) ):
                    $toMax          = ($emails->totalPages - $emails->page);
                    $primaryChecker = 9 - $toMax;
                    $reference      = $emails->page - (8 - $toMax);
                else:
                    $primaryChecker = 5;
                    $reference      = $emails->page - 4;
                endif;

                for( $i = 0; $i < 11; $i++ ){
                    switch( $i ){
                        case 0:
                            if( 1 !== $page ){
                                ?><a class="btn btn-nospin fa fa-angle-double-left" href="?page=1"></a><?php
                            }
                            break;

                        case $primaryChecker:
                            ?><a class="btn btn-nospin btn-primary"><?php echo $emails->page ?></a><?php
                            break;

                        case 10:
                            ?><a class="btn btn-nospin fa fa-angle-double-right" href="?page=<?php echo $emails->totalPages ?>"></a><?php
                            break;

                        default:
                            ?><a class="btn btn-nospin btn-default" href="?page=<?php echo $reference ?>"><?php echo $reference ?></a><?php
                            break;
                    }

                    if( $i > 0 ): $reference++; endif;
                }
            ?>
            </div>
            <h6 style="text-align: center; width: 100%; padding-block-start: 16px"><?php echo "showing from $emails->start to $emails->end" ?></h6>
            <?php else: ?>
            </div>
            <div style="margin: 70px auto; opacity: .5; text-align: center">
                <h2><?php echo $view['translator']->trans('plugin.blocklist.nodeleted') ?></h2>
            <?php endif; ?>
        </div>
    </div>
</div>    