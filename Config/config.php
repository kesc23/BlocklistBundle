<?php

return array(
    'name'        => 'Blocklist',
    'description' => 'Este plugin cria uma blacklist de emails os quais não terão dados mantidos nem receberao conteúdo das campanhas.',
    'author'      => 'Kesc23 (Kevin Campos)',
    'version'     => '1.0.0',
    'routes'      => array(
        'main'    => array(
            'plugin_blocklist_main' => array(
                'path'       => "/blocklist",
                'controller' => 'BlocklistBundle:Default:main'
            )
        )
    ),
    'menu'        => array(
        'main'    => array(
            'priority' => 4,
            'items' => array(
                'plugin.blocklist.main' => array(
                    'id'        => 'plugin_blocklist_index',
                    'iconClass' => 'fa-ban',
                    'route'     => 'plugin_blocklist_main',
                ),
            ),
        ),
    ),
);