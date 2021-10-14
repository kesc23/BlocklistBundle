<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

class DefaultController extends CommonController
{
    public function mainAction()
    {
        global $blocklist_postCond;
        $blocklist_postCond = (
            isset( $_POST['Blocklist_mauticBaseUrl'] )
         && isset( $_POST['Blocklist_clientKey'] )
         && isset( $_POST['Blocklist_clientSecret'] )
        );

        if( $blocklist_postCond ):
            $this->verifyOAuth();
        else:
            return $this->delegateView(
                array( 'contentTemplate' => 'BlocklistBundle:Main:main.html.php' )
            );
        endif;
    }

    public function verifyOAuth()
    {
        \file_put_contents( __DIR__.'api.log', json_encode( $_POST ) );
    }
}