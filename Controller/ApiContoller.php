<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

class ApiController extends CommonController
{
    public function authAction()
    {
        file_put_contents( __DIR__.'api.log', json_encode( $_POST ) );
    }
}