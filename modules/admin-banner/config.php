<?php
/**
 * admin-banner config file
 * @package admin-banner
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'admin-banner',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/admin-banner',
    '__files' => [
        'modules/admin-banner'              => [ 'install', 'remove', 'update' ],
        'theme/admin/component/banner'      => [ 'install', 'remove', 'update' ],
        'theme/admin/static/js/banner.js'   => [ 'install', 'remove', 'update' ]
    ],
    '__dependencies' => [
        'banner',
        'admin'
    ],
    '_services' => [],
    '_autoload' => [
        'classes' => [
            'AdminBanner\\Controller\\BannerController'   => 'modules/admin-banner/controller/BannerController.php'
        ],
        'files' => []
    ],
    
    '_routes' => [
        'admin' => [
            'adminBanner'   => [
                'rule'          => '/banner',
                'handler'       => 'AdminBanner\\Controller\\Banner::index'
            ],
            'adminBannerEdit' => [
                'rule'          => '/banner/:id',
                'handler'       => 'AdminBanner\\Controller\\Banner::edit'
            ],
            'adminBannerRemove' => [
                'rule'          => '/banner/:id/delete',
                'handler'       => 'AdminBanner\\Controller\\Banner::remove'
            ]
        ]
    ],
    
    'admin' => [
        'menu' => [
            'component' => [
                'label'     => 'Component',
                'order'     => 1500,
                'icon'      => 'puzzle-piece',
                'submenu'   => [
                    'banner'    => [
                        'label'     => 'Banner',
                        'perms'     => 'read_banner',
                        'target'    => 'adminBanner',
                        'order'     => 1000
                    ]
                ]
            ]
        ]
    ],
    
    'form' => [
        'admin-banner' => [
            'name' => [
                'type'  => 'text',
                'label' => 'Name',
                'rules' => [
                    'required' => true,
                    'unique' => [
                        'model' => 'Banner\\Model\\Banner',
                        'field' => 'name',
                        'self'  => [
                            'uri' => 'id',
                            'field' => 'id'
                        ]
                    ]
                ]
            ],
            'placement' => [
                'type'  => 'text',
                'label' => 'Placemenent',
                'rules' => [
                    'required' => true
                ]
            ],
            'expired' => [
                'type'  => 'datetime',
                'label' => 'Expired',
                'rules' => [
                    'required' => true
                ]
            ],
            'type' => [
                'type'  => 'select',
                'label' => 'Type',
                'options' => [
                    1 => 'Banner',
                    2 => 'Source',
                    3 => 'Google Ads',
                    4 => 'Facebook Audience Network',
                    5 => 'iFrame'
                ],
                'rules' => [
                    'required' => true
                ]
            ],
            
            'ban_title' => [
                'type'  => 'text',
                'label' => 'Title',
                'rules' => []
            ],
            'ban_image' => [
                'type'  => 'file',
                'label' => 'Image',
                'rules' => [
                    'file' => 'image/*'
                ]
            ],
            'ban_link' => [
                'type'  => 'url',
                'label' => 'URL',
                'rules' => []
            ],
            
            'sou_text' => [
                'type'  => 'textarea',
                'label' => 'Source',
                'rules' => []
            ],
            
            'ga_client' => [
                'type'  => 'text',
                'label' => 'Client ID',
                'rules' => []
            ],
            'ga_slot' => [
                'type'  => 'text',
                'label' => 'Slot',
                'rules' => []
            ],
            'ga_format' => [
                'type'  => 'text',
                'label' => 'Format',
                'rules' => []
            ],
            
            'fan_placementid' => [
                'type'  => 'text',
                'label' => 'Placement ID',
                'rules' => []
            ],
            'fan_format' => [
                'type'  => 'text',
                'label' => 'Format',
                'rules' => []
            ],
            
            'ifr_src' => [
                'type'  => 'url',
                'label' => 'URL',
                'rules' => []
            ],
            'ifr_time' => [
                'type'  => 'number',
                'label' => 'Timer',
                'rules' => [
                    'numeric' => [
                        'min' => 0
                    ]
                ]
            ]
        ]
    ]
];