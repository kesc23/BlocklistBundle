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
    }
    
    function dostos()
    {
        return $this->query( "SELECT `id`, `email`, `firstname`, `lastname` FROM `leads`" );
    }

    function query( $query )
    {
        $sql = $this
               ->db
               ->prepare( $query );
        $sql->execute();
        
        return $sql->fetchAll( PDO::FETCH_ASSOC );
    }
}