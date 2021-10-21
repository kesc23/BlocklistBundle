<?php

return array(
    'name'        => 'Blocklist',
    'description' => 'Este plugin cria uma blacklist de emails os quais não terão dados mantidos nem receberao conteúdo das campanhas.',
    'author'      => 'Kesc23 (Kevin Campos)',
    'version'     => '1.0.0',
    'routes'      => array(
        'main'    => array(
            'plugin_blocklist_main'  => array(
                'path'       => "/blocklist",
                'controller' => 'BlocklistBundle:Default:main'
            ),
            'plugin_blocklist_clean' => array(
                'path'       => '/blocklist/clean',
                'controller' => 'BlocklistBundle:Default:delete'
            )
        )
    ),
    'menu'        => array(
        'main'    => array(
            'priority' => 4,
            'items' => array(
                'plugin.blocklist.index' => array(
                    'id'        => 'plugin_blocklist_index',
                    'iconClass' => 'fa-ban',
                    'route'     => 'plugin_blocklist_main'
                ),
            ),
        ),
    ),
    'services'    => array(
        'model'   => array(
            'mautic.blocklist.model.contact' => array(
                'class'    => 'MauticPlugin\BlocklistBundle\Model\ContactModel',
                'alias'    => 'blocklist.contact',
            )
        )
    ),
);