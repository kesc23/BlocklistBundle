<?php
/**
 * @package Blocklist
 * @author  Kevin Campos
 * @license GPL v3 or later
 */
namespace MauticPlugin\BlocklistBundle\EventListener;

use Mautic\LeadBundle\LeadEvents;
use Mautic\LeadBundle\Event\ImportEvent;
use MauticPlugin\BlocklistBundle\Model\BlocklistModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * LeadSubscriber is used to verify if an user is being imported but is in the blocklist. if it does, then it will be deleted.
 * 
 * @since 1.1.0
 * @todo Add a way to put lead in the blocklist by campaign action
 * @todo Add a way to remove lead in the blocklist by campaign action
 */
class LeadSubscriber implements EventSubscriberInterface
{
    /**
     * The Blocklist
     *
     * @var BlocklistModel
     */
    private $blocklist;
    
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
     * @param ImportEvent $event
     * @return void
     */
    public function onImportPostSaved( ImportEvent $event = null )
    {
        $ids = $this->blocklist->getLeadIds();

        if( null !== $ids && $ids )
        {
            $this->blocklist->deleteLeads( count( $ids ) > 1 ? $ids : $ids[0] );
        }
    }

    /**
     * When constructing, we add all basic blocklist data to the object.
     *
     * @param BlocklistModel $blocklist
     */
    public function __construct( BlocklistModel $blocklist )
    {
        $this->blocklist = $blocklist;
    }
}