<?php

return array(
    'name'        => 'Email Blocklist',
    'description' => 'Este plugin cria uma blacklist de emails os quais não terão dados mantidos nem receberao conteúdo das campanhas.',
    'author'      => 'Kesc23 (Kevin Campos)',
    'version'     => '1.0.0',
    'menu'        => array(
        'main' => array(
            'priority' => 4,
            'items' => array(
                'plugin.blocklist.index' => array(
                    'id'        => 'plugin_blocklist_index',
                    'iconClass' => 'fa-ban',
                    #'access'    => 'plugin:blocklist:worlds:view',
                    'parent'    => 'mautic.core',
                ),
            ),
        ),
    ),
);