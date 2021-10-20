<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

class DefaultController extends CommonController
{
    public function mainAction()
    {
        if( isset( $_POST['leadsarea'] ) )
        {
            $emails = array();

            if( ! null == preg_match_all( '/[\w\-\.]+@[\w\.\-]+/', $_POST['leadsarea'], $emails, PREG_UNMATCHED_AS_NULL ) )
            {
                count( $emails[0] ) === 1 ? $multi = false : $multi = true;
                $this->getModel( 'blocklist.contact' )->addToBlocklist( $emails[0], $multi );
            }
        }

        return $this->delegateView(
            array(
                'viewParameters'  => array(
                    'contact'  => $this->getModel( 'blocklist.contact' )
                ),
                'contentTemplate' => 'BlocklistBundle:Main:main.html.php',
            )
        );
    }

    public function deleteAction()
    {
        $contact = $this->getModel( 'blocklist.contact' );
        $ids     = $contact->getLeadIds();
        $tables  = array();

        foreach( $contact->getTables() as $table )
        {
            $tables[] = $table['TABLE_NAME'];
        }

        print_r( $ids ); print_r( $table );

        foreach( $tables as $table )
        {
            # $contact->deleteLeads( $ids, $table );
        }
    }
}