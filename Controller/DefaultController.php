<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;
use MauticPlugin\BlocklistBundle\Model\BlocklistModel;

class DefaultController extends CommonController
{
    /**
     * The Default controller main action is used to set the data in forms to add/remove items of the blocklist.
     * it also renders the correct view.
     * 
     * @since 1.0.0
     * @since 1.2.0 Now verifies if the user is admin or has full access
     */
    public function mainAction()
    {
        $security = $this->get( 'mautic.security' );
        
        if( ! $security->isGranted( 'user:roles:full' ) ): return $this->postActionRedirect(); endif;

        /**
         * @var BlocklistModel
         */
        $blockList = $this->getModel( 'blocklist.blocklist' );

        if( isset( $_POST['leadsarea'] ) )
        {
            $emails = array();

            if( ! null == preg_match_all( '/[\w\-\.\+]+@[\w\.\-]+/', $_POST['leadsarea'], $emails, PREG_UNMATCHED_AS_NULL ) )
            {
                count( $emails[0] ) === 1 ? $multi = false : $multi = true;
                $blockList->addToBlocklist( $emails[0], $multi );
            }
        }

        if( isset( $_POST['remove_leadsarea'] ) )
        {
            $removemails = array();

            if( preg_match_all( '/[\w\-\.\+]+@[\w\.\-]+/', $_POST['remove_leadsarea'], $removemails, PREG_UNMATCHED_AS_NULL ) )
            {
                $multi = count( $removemails[0] ) === 1 ?  false : true;
                $blockList->removeFromBlocklist( $removemails[0], $multi );
            }
        }

        return $this->delegateView(
            array(
                'viewParameters'  => array(
                    'contact'  => $this->getModel( 'blocklist.blocklist' )
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
     * @since 1.2.0 Now verifies if the user is admin or has full access
     */
    public function deleteAction()
    {
        $security = $this->get( 'mautic.security' );
        if( ! $security->isGranted( 'user:roles:full' ) ): return $this->postActionRedirect(); endif;

        /**
         * @var BlocklistModel
         */
        $blockList = $this->getModel( 'blocklist.blocklist' );

        $ids = $blockList->getLeadIds();

        if( $ids )
        {
            $blockList->deleteLeads( count( $ids ) > 1 ? $ids : $ids[0] );
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
     * @since 1.2.0 Now verifies if the user is admin or has full access
     */
    public function cleanedAction()
    {
        $security = $this->get( 'mautic.security' );
        if( ! $security->isGranted( 'user:roles:full' ) ): return $this->postActionRedirect(); endif;

        /**
         * @var BlocklistModel
         */
        $blockList = $this->getModel( 'blocklist.blocklist' );

        return $this->delegateView(
            array(
                'viewParameters'  => array(
                    'emails'  => $blockList->getOnlyDeletedLeads()
                ),
                'contentTemplate' => 'BlocklistBundle:Main:cleaned.html.php',
            )
        ); 
    }
}