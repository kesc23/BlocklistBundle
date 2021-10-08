<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

class DefaultController extends CommonController
{
    public function mainAction()
    {
        $this->delegateView(
            array(
                'contentTemplate' => 'BlocklistBundle:Main:main.html.php'
            )
        );
    }
}