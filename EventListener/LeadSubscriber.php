<?php
/**
 * @package Blocklist
 * @author  Kevin Campos
 * @version 1.1.0
 * @license GPL v3 or later
 */
namespace MauticPlugin\BlocklistBundle\EventListener;

use Mautic\LeadBundle\LeadEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * LeadSubscriber is used to verify if an user is being imported but is in the blocklist. if it does, then it will be deleted.
 * 
 * @since 1.1.0
 */
class LeadSubscriber implements EventSubscriberInterface
{
    private $blocklist;
    private $blockEmails;
    private $tables;
    private $ids;
    
    /**
     * {@inheritDoc}
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            LeadEvents::IMPORT_POST_SAVE => array( 'onImportPostSaved', 10 )
        );
    }

    /**
     * When executing LeadEvents::IMPORT_POST_SAVE event, onImportPostSaved is called to run the blocklist routines.
     *
     * @param  Mautic\LeadBundle\Event\ImportEvent $event
     * @return void
     */
    public function onImportPostSaved( $event = null )
    {
        $this->blocklist->deleteLeads( $this->ids, $this->tables );
    }

    /**
     * When constructing, we add all basic blocklist data to the object.
     *
     * @param MauticPlugin\BlocklistBundle\Model $blocklist
     */
    public function __construct( $blocklist )
    {
        $this->blocklist   = $blocklist;
        $this->blockEmails = $this->blocklist->getFromBlocklist();
        $this->ids         = $this->blocklist->getLeadIds();
        $this->tables      = array();

        foreach( $this->blocklist->getTables() as $table )
        {
            $this->tables[] = $table['TABLE_NAME'];
        }
    }
}