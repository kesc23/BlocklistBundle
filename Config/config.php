<?php
/**
 * Data for @package Blocklist
 * @author Kevin Campos
 * @version 1.2.0
 * @license GPL v3 or later
 * 
 * - Name:     Blocklist
 * - Routes:   main | clean | cleaned
 * - Menu:     Blocklist > cleaned | main
 * - Services: Contact Model
 */
return array(
    'name'        => 'Blocklist',
    'description' => 'Este plugin cria uma blacklist de emails os quais não terão dados mantidos nem receberao conteúdo das campanhas',
    'author'      => 'Kesc23 (Kevin Campos)',
    'version'     => '1.2.0',
    'routes'      => array(
        'main'    => array(
            'plugin_blocklist_main'  => array(
                'path'       => "/blocklist",
                'controller' => 'BlocklistBundle:Default:main'
            ),
            'plugin_blocklist_clean' => array(
                'path'       => '/blocklist/clean',
                'controller' => 'BlocklistBundle:Default:delete'
            ),
            'plugin_blocklist_cleaned' => array(
                'path'       => '/blocklist/cleaned',
                'controller' => 'BlocklistBundle:Default:cleaned'
            ),
        )
    ),
    'menu'        => array(
        'main'    => array(
            'priority' => 4,
            'items' => array(
                'plugin.blocklist.index' => array(
                    'id'        => 'plugin_blocklist_index',
                    'iconClass' => 'fa-ban',
                    'access'    => 'admin',
                    'route'     => 'plugin_blocklist_main',
                    'children'  => array(
                        'plugin.blocklist.cleaned' => array(
                            'route'  => 'plugin_blocklist_cleaned'
                        ),
                        'plugin.blocklist.main' => array(
                            'route'  => 'plugin_blocklist_main'
                        ),
                    ),
                ),
                'plugin.blocklist.cleaned' => array(
                    'parent' => 'plugin.blocklist.index',
                    'route'  => 'plugin_blocklist_cleaned'
                ),
                'plugin.blocklist.main' => array(
                    'parent' => 'plugin.blocklist.index',
                    'route'  => 'plugin_blocklist_main'
                ),
            ),
        ),
    ),
    'services'    => array(
        'events'  => array(
            'plugin.blocklist.event_listener.lead_subscriber' => array(
                'class'     => 'MauticPlugin\BlocklistBundle\EventListener\LeadSubscriber',
                'arguments' => 'mautic.blocklist.model.contact'
            )
        ),
        'model'   => array(
            'mautic.blocklist.model.contact' => array(
                'class'    => 'MauticPlugin\BlocklistBundle\Model\ContactModel',
                'alias'    => 'blocklist.contact',
            )
        )
    ),
);