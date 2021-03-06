<?php
namespace MZKPortal\Module\Configuration;

$config = array(
    'vufind' => array(
        'plugin_managers' => array (
            'recorddriver' => array (
                'factories' => array(
                    'solrdefault' => 'MZKPortal\RecordDriver\Factory::getSolrDefault',
                    'solrmuni'    => 'MZKPortal\RecordDriver\Factory::getSolrMarcMuni',
                    'solrmzk'     => 'MZKPortal\RecordDriver\Factory::getSolrMarcMzk',
                    'solrkjm'     => 'MZKPortal\RecordDriver\Factory::getSolrMarcKjm',
                    'solrvut'     => 'MZKPortal\RecordDriver\Factory::getSolrMarcVut',
                    'solrmerged'  => 'MZKPortal\RecordDriver\Factory::getSolrMarcMerged',
                ) /* factories */
            ), /* recorddriver */
            'recordtab' => array(
                'abstract_factories' => array('VuFind\RecordTab\PluginFactory'),
                'invokables' => array(
                    'libraries' => 'MZKPortal\RecordTab\Libraries',
                ),
            ), /* recordtab */
            'auth' => array(
                'factories' => array(
                    'shibbolethWithWAYF' => 'MZKPortal\Auth\Factory::getShibbolethWithWAYF',
                ),
            ),
        ), /* plugin_managers */
        'recorddriver_tabs' => array(
            'MZKPortal\RecordDriver\SolrMarcMerged' => array(
                'tabs' => array (
                    'Libraries' => 'Libraries',
                    'Description' => 'Description',
                    'TOC' => 'TOC',
                    'UserComments' => 'UserComments',
                    'Reviews' => 'Reviews',
                    'Excerpt' => 'Excerpt',
                    'HierarchyTree' => 'HierarchyTree',
                    'Map' => 'Map',
                    'Details' => 'StaffViewArray',
                ),
            )
        ) /* recorddriver_tabs */
    ), /* vufind */
    'controllers' => array(
        'invokables' => array(
            'my-research' => 'MZKPortal\Controller\MyResearchController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'VuFind\AuthManager' => 'MZKPortal\Auth\Factory::getAuthManager',
        ),
    ),
);

return $config;
