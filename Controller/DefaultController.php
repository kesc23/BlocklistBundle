<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

class DefaultController extends CommonController
{
    public function mainAction()
    {
        return $this->delegateView(
            array(
                'viewParameters'  => array(
                    'contact'  => $this->getModel( 'blocklist.contact' )
                ),
                'contentTemplate' => 'BlocklistBundle:Main:main.html.php',
            )
        );
    }
}