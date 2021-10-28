<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

class DefaultController extends CommonController
{
    /**
     * The Default controller main action is used to set the data in forms to add/remove items of the blocklist.
     * it also renders the correct view.
     * 
     * @since 1.0.0
     */
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

        if( isset( $_POST['remove_leadsarea'] ) )
        {
            $removemails = array();

            if( ! null == preg_match_all( '/[\w\-\.]+@[\w\.\-]+/', $_POST['remove_leadsarea'], $removemails, PREG_UNMATCHED_AS_NULL ) )
            {
                count( $removemails[0] ) === 1 ? $multi = false : $multi = true;
                $this->getModel( 'blocklist.contact' )->removeFromBlocklist( $removemails[0], $multi );
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

    /**
     * The delete action searches in the Database for the determined leads to delete all of its data.
     * then redirect to the main blocklist page.
     *
     * @since 1.0.0
     */
    public function deleteAction()
    {
        $contact = $this->getModel( 'blocklist.contact' );
        $ids     = $contact->getLeadIds();
        $tables  = array();

        foreach( $contact->getTables() as $table )
        {
            $tables[] = $table['TABLE_NAME'];
        }

        if( null !== $ids && $ids )
        {
            $contact->deleteLeads( count( $ids ) > 1 ? $ids : $ids[0], $tables );
        }

        return $this->postActionRedirect(
            array(
                'returnUrl'       => $this->generateUrl( 'plugin_blocklist_main' ),
                'contentTemplate' => 'BlocklistBundle:Default:main'
            )
        );
    }

    /**
     * The 'cleaned' action renders the view containing all deleted leads in the blocklist.
     *
     * @since 1.0.0
     */
    public function cleanedAction()
    {
        return $this->delegateView(
            array(
                'viewParameters'  => array(
                    'contact'  => $this->getModel( 'blocklist.contact' )
                ),
                'contentTemplate' => 'BlocklistBundle:Main:cleaned.html.php',
            )
        ); 
    }
}