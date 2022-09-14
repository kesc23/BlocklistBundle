<?php

namespace MauticPlugin\BlocklistBundle\Model;

use Doctrine\ORM\EntityManager;
use Mautic\CoreBundle\Model\AbstractCommonModel;

use function array_flip;
use function serialize;
use function unserialize;
use function file_get_contents;
use function file_put_contents;

class BlocklistModel extends AbstractCommonModel
{
    public $BLOCKLIST_DIR;
    
    public function __construct( EntityManager $em )
    {
        $this->em = $em;
        $this->BLOCKLIST_DIR = dirname( __DIR__ );

        if( @ ! is_array( $this->getFromBlocklist() ) )
        {
            $this->init();
        }
    }
    
    public function init()
    {
        $arr = serialize( array() );
        file_put_contents( "{$this->BLOCKLIST_DIR}/list/list.txt", $arr );
    }

    public function getLeads()
    {
        return $this->em
            ->createQuery( "SELECT l.id, l.email FROM Mautic\LeadBundle\Entity\Lead l" )
            ->getResult();
    }

    public function deleteLeads( $ids )
    {
        $ids_to_delete = (is_string( $ids ) || is_int( $ids )) ? $ids : implode( " OR l.id = ", $ids );

        $this->em
            ->createQuery( "DELETE Mautic\LeadBundle\Entity\Lead l WHERE l.id = {$ids_to_delete}" )
            ->execute();
    }

    public function addToBlocklist( $email, $multi = false )
    {
        $list = $this->getFromBlocklist();
        if( true === $multi ):
            foreach( $email as $mail )
            {
                $list[$mail] = $mail;
            }
        else:
            $list[ $email[0] ] = $email[0];
        endif;

        $this->saveBlocklist( $list );
    }

    public function removeFromBlocklist( $email, $multi = false )
    {
        $list = $this->getFromBlocklist();
        if( true === $multi ):
            foreach( $email as $mail )
            {
                unset( $list[ $mail ] );
            }
        else:
            unset( $list[ $email[0] ] );
        endif;

        $this->saveBlocklist( $list );
    }

    public function getFromBlocklist() : array
    {
        return unserialize( file_get_contents( "{$this->BLOCKLIST_DIR}/list/list.txt" ) );
    }

    public function saveBlocklist( array $bl ){
        file_put_contents( "{$this->BLOCKLIST_DIR}/list/list.txt", serialize($bl) );
    }

    public function getOnlyDeletedLeads()
    {
        //Swapping value with keys so we can find values like Lookup Tables
        $leads       = array_flip( $this->getLeadEmails() );
        $inBlocklist = $this->getFromBlocklist();

        $returnLeads = [];

        foreach( $inBlocklist as $possibly_deleted_lead )
        {
            /**
             * Verifying if we do got a lead in the blocklist that isn't deleted:
             * 
             * * if all leads in the blocklist are deleted, $leads surely is null.
             */
            if( ! @(null === $leads ? array() : $leads )[$possibly_deleted_lead] )
            {
                $returnLeads[] = $possibly_deleted_lead;
            }
        }

        return $returnLeads;
    }

    public function crossLeads()
    {
        $blocked = $this->getFromBlocklist();
        $leads   = $this->getLeads();
        $data    = array();

        foreach( $leads as $lead )
        {
            if( isset( $blocked[ $lead['email'] ] ) )
            {
                $data['emails'][] = $lead['email'];
                $data['ids'][]    = (int) $lead['id'];
                $data['name'][]   = "{$lead['firstname']} {$lead['lastname']}";
            }
        }

        return $data;
    }

    function getLeadEmails()
    {
        return ( $this->crossLeads() )['emails'];
    }

    function getLeadIds()
    {
        return $this->crossLeads()['ids'];
    }

    function getLeadNames()
    {
        return $this->crossLeads()['name'];
    }
}