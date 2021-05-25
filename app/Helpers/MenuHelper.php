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
//                'route_url' => route('admin.dashboard'),
                'route_name' => 'admin.dashboard',
                'child_route_name' => [
                    'admin.dashboard'
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
        ];
        return $menu;
    }

}
