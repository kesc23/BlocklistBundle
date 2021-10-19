<?php

namespace MauticPlugin\BlocklistBundle\Model;
use \PDO;
# use Mautic\CoreBundle\Model\AbstractCommonModel;

Class ContactModel # extends AbstractCommonModel
{
    public $db;
    
    public function __construct()
    {
        $this->db = new PDO( "mysql:host={$_SERVER['MAUTIC_DB_HOST']}:{$_SERVER['MAUTIC_DB_PORT']};dbname={$_SERVER['MAUTIC_DB_NAME']}", $_SERVER['MAUTIC_DB_USER'], $_SERVER['MAUTIC_DB_PASSWORD'] );
        
        $init = null;
        if( empty( $this->query( "CREATE TABLE blocklist ( `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `blocklist` VARCHAR( 65500 ) )", true ) ) )
        {
            $this->query( "CREATE TABLE `blocklist` ( `blocklist` VARCHAR( 65532 ) )" );

            $init = true;
        }

        if( true === $init ): $this->init(); endif;
    }
    
    function init()
    {
        $arr = \serialize( array( 'leads' => array() ) );
        $sql = $this->db->prepare( "INSERT INTO `blocklist`(`id`, `blocklist`) VALUES ( 1, \"{$arr}\" )" );
        $sql->execute();
    }

    function dostos()
    {
        return $this->query( "SELECT `id`, `email`, `firstname`, `lastname` FROM `leads`", true );
    }

    function getTables()
    {
        return $this->query( "SELECT TABLE_NAME from INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME like 'lead_id'", true );
    }

    function getLeads()
    {
        return $this->query( "SELECT `id`, `email` FROM `leads`", true );
    }

    function deleteLeads( $ids, $table )
    {
        if( is_string( $ids ) || is_int( $ids ) ):
            $this->query( "DELETE FROM {$table} WHERE `lead_id` = $ids " );
        elseif( is_array( $ids ) ):
            $this->query( "DELETE FROM {$table} WHERE `lead_id` = ". implode( " OR `lead_id` = ", $ids ) );
        endif;
    }

    function addToBlocklist( $email )
    {
        $bl = unserialize( $this->query( "SELECT blocklist.blocklist WHERE blocklist.id = 1" , true ) );

        print_r( $b1 );

        $bl[ $email ] = $email;
        $bl = serialize( $bl );
        # $this->query( "UPDATE `blocklist` SET `blocklist` = `{$bl}` WHERE `id` = 1" );
    }

    function query( $query, $return = false )
    {
        $sql = $this
               ->db
               ->prepare( $query );
        $sql->execute();
        
        if( true === $return ): return $sql->fetchAll( PDO::FETCH_ASSOC ); endif;
    }
}