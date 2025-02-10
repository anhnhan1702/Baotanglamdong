<?php
return [
    1 => array(
        0 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý danh mục',
            // 'route_name' => 'truongbaocao',
            'params' => [
                'layout' => 'side-menu',
            ],
            'sub_menu' => [
                'thoiky' => [
                    'icon' => '',
                    'route_name' => '/thoi-ky',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Thời kỳ',
                ],
                'niendai' => [
                    'icon' => '',
                    'route_name' => '/nien-dai-tuong-doi',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Niên đại tương đối',
                ],
                'loaihienvat' => [
                    'icon' => '',
                    'route_name' => '/loai-hien-vat',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Loại hiện vật',
                ],

            ]
        ),
        1 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý kho hiện vật',
            'route_name' => '/quan-ly-kho',


        ),

        2 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý hiện vật',
            'route_name' => '/',

        ),
        3 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Số hóa hiện vật',
            'route_name' => '/so-hoa-hien-vat',


        ),
        4 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Bộ sư tập hiện vật',
            'route_name' => '/bo-su-tap',

        ),
        5 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Di chuyển hiện vật',
            'route_name' => '/di-chuyen-hien-vat',
        ),
    ),
    2 => array(
        1 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Danh sách hiện vật',
            'route_name' => '/danh-sach-hien-vat',
        ),

        2 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý phiếu',
            'route_name' => '/quan-ly-phieu',

        ),

    ),
    3 => array(
        1 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Danh sách hiện vật',
            'route_name' => '/danh-sach-hien-vat-trung-bay',
        ),

        2 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý vị trí trưng bày',
            'route_name' => '/quan-ly-vi-tri-trung-bay',
        ),
        3 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý đợt trưng bày',
            'route_name' => '/quan-ly-dot-trung-bay',
        ),

    ),
    4 => array(
        1 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Danh sách hiện vật trên web',
            'route_name' => '/danh-sach-hien-vat-trung-bay-ao',
        ),

        2 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý vị trí trưng bày trên web',
            'route_name' => '/quan-ly-vi-tri-trung-bay-ao',
        ),
        3 =>  array(
            'icon' => 'el-icon-edit',
            'title' => 'Quản lý đợt trưng bày trên web',
            'route_name' => '/quan-ly-dot-trung-bay-ao',
        ),

    )


];
