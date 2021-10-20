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
                    'children'  => array(
                        'plugin.blocklist.clean' => array(
                            'route' => 'plugin_blocklist_clean'
                        ),
                        'plugin.blocklist.main' => array(
                            'route' => 'plugin_blocklist_main'
                        )
                    )
                ),
                'plugin.blocklist.main' => array(
                    'id'        => 'plugin_blocklist_main',
                    'route'     => 'plugin_blocklist_main',
                    'parent'    => 'plugin.blocklist.index'
                ),
                'plugin.blocklist.clean' => array(
                    'id'        => 'plugin_blocklist_clean',
                    'route'     => 'plugin_blocklist_clean',
                    'parent'    => 'plugin.blocklist.index'
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