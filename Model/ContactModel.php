<?php

namespace MauticPlugin\BlocklistBundle\Model;
use \PDO;
# use Mautic\CoreBundle\Model\AbstractCommonModel;

Class ContactModel # extends AbstractCommonModel
{
    public $db;
    public $BLOCKLIST_DIR;
    
    public function __construct()
    {
        $this->db = new PDO( "mysql:host={$_SERVER['MAUTIC_DB_HOST']}:{$_SERVER['MAUTIC_DB_PORT']};dbname={$_SERVER['MAUTIC_DB_NAME']}", $_SERVER['MAUTIC_DB_USER'], $_SERVER['MAUTIC_DB_PASSWORD'] );
        
        $this->BLOCKLIST_DIR = dirname( __DIR__ );

        if( @ ! is_array( $this->getFromBlocklist() ) )
        {
            $this->init();
        }
    }
    
    public function init()
    {
        $arr = \serialize( array() );
        file_put_contents( "{$this->BLOCKLIST_DIR}/list/list.txt", $arr );
    }

    public function dostos()
    {
        return $this->query( "SELECT `id`, `email`, `firstname`, `lastname` FROM `leads`", true );
    }

    public function getTables()
    {
        return $this->query( "SELECT TABLE_NAME from INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME like 'lead_id'", true );
    }

    public function getLeads()
    {
        return $this->query( "SELECT `id`, `email` FROM `leads`", true );
    }

    public function deleteLeads( $ids, $table )
    {
        if( is_string( $ids ) || is_int( $ids ) ):
            $this->query( "DELETE FROM {$table} WHERE `lead_id` = $ids " );
        elseif( is_array( $ids ) ):
            $this->query( "DELETE FROM {$table} WHERE `lead_id` = ". implode( " OR `lead_id` = ", $ids ) );
        endif;
    }

    public function addToBlocklist( $email, $multi = false )
    {
        $bl = $this->getFromBlocklist();
        if( true === $multi ):
            foreach( $email as $mail )
            {
                $bl[$mail] = $mail;
            }
        else:
            $bl[ $email[0] ] = $email[0];
        endif;

        $bl = serialize( $bl );
        file_put_contents( "{$this->BLOCKLIST_DIR}/list/list.txt", $bl );
    }

    public function removeFromBlocklist( $email, $multi = false )
    {
        $bl = $this->getFromBlocklist();
        if( true === $multi ):
            foreach( $email as $mail )
            {
                unset( $bl[ $mail ] );
            }
        else:
            unset( $bl[ $email[0] ] );
        endif;

        $bl = serialize( $bl );
        file_put_contents( "{$this->BLOCKLIST_DIR}/list/list.txt", $bl );
    }

    public function getFromBlocklist()
    {
        return unserialize( file_get_contents( "{$this->BLOCKLIST_DIR}/list/list.txt" ) );
    }

    public function crossLeads()
    {
        $blocked = $this->getFromBlocklist();
        $leads   = $this->getLeads();
        $data    = array();

        foreach( $leads as $lead )
        {
            if( in_array( $lead['email'], $blocked ) )
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
        return $this->crossLeads()['emails'];
    }

    function getLeadIds()
    {
        return $this->crossLeads()['ids'];
    }

    function getLeadNames()
    {
        return $this->crossLeads()['name'];
    }

    public function query( $query, $return = false )
    {
        $sql = $this
               ->db
               ->prepare( $query );
        $sql->execute();
        
        if( true === $return ): return $sql->fetchAll( PDO::FETCH_ASSOC ); endif;
    }
}