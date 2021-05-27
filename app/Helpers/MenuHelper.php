<?php


namespace App\Helpers;


class MenuHelper
{
    public static function getMenu()
    {

        $menu = [
            'dashboard' => [
                'label' => 'Dashboard',
                'icon' => 'icon icon-speedometer',
                'route_name' => 'admin.dashboard',
                'child_route_name' => [
                    'admin.dashboard'
                ],
            ],

            'orders' => [
                'label' => 'Đơn hàng',
                'icon' => 'icon icon-speedometer',
                'route_name' => 'admin.orders.index',
                'child_route_name' => [
                    'admin.orders.index',
                    'admin.orders.edit',
                ],
            ],
            'products' => [
                'label' => 'Sản phẩm',
                'icon' => 'icon icon-present',
                'child_route_name' => [
                    'admin.products.index',
                    'admin.products.create',
                    'admin.products.edit',
                ],
                'sub_menu' => [
                    [
                        'label' => 'Danh sách sản phẩm',
                        'icon' => 'fa fa-caret-right',
                        'route_name' => 'admin.products.index',
                        'child_route_name' => [
                            'admin.products.index',
                            'admin.products.edit'
                        ]
                    ],
                    [
                        'label' => 'Tạo sản phẩm',
                        'icon' => 'fa fa-caret-right',
                        'route_name' => 'admin.products.create',
                        'child_route_name' => [
                            'admin.products.create',
                        ]
                    ],
                ]
            ],
            'shops' => [
                'label' => 'Địa chỉ',
                'icon' => 'icon icon-present',
                'child_route_name' => [
                    'admin.shops.index',
                    'admin.shops.create',
                    'admin.shops.edit',
                ],
                'sub_menu' => [
                    [
                        'label' => 'Danh sách Địa chỉ',
                        'icon' => 'fa fa-caret-right',
                        'route_name' => 'admin.shops.index',
                        'child_route_name' => [
                            'admin.shops.index',
                            'admin.shops.edit'
                        ]
                    ],
                    [
                        'label' => 'Tạo Địa chỉ',
                        'icon' => 'fa fa-caret-right',
                        'route_name' => 'admin.shops.create',
                        'child_route_name' => [
                            'admin.shops.create',
                        ]
                    ],
                ]
            ],
        ];
        return $menu;
    }

}
