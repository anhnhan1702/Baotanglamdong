<?php
return [
    0 =>  array(
        'icon' => 'ri-settings-3-line',
        'title' => 'Hệ thống',

        // 'route_name' => '/di-chuyen-hien-vat',
        'sub_menu' => [
            'cauhinhhethong' => [
                'icon' => '',
                'route_name' => '/plugin_table?table=Cauhinhhethong',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Cấu hình hệ thống',
            ],
            'quanlinhomuser' => [
                'icon' => '',
                'route_name' => '/phong-ban',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý phòng ban',
            ],
            'quanliuser' => [
                'icon' => '',
                'route_name' => '/nguoi-dung',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý người dùng',
            ],
            'quanlinhomquyen' => [
                'icon' => '',
                'route_name' => '/nhomquyen',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý nhóm quyền',
            ],
            'nhatkydangnhap' => [
                'icon' => '',
                'route_name' => '/nhatky',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Nhật ký hệ thống',
            ],
            'saoluubackup' => [
                'icon' => '',
                'route_name' => '/backup-data',
                'params' => [
                    'layout' => 'side-menu'
                ],

                'title' => 'Sao lưu - Backup',
            ],
        ],
        'decentralization' => array(1)
    ),
    1 =>  array(
        'icon' => 'ri-folder-2-line',
        'title' => 'Quản lý danh mục',
        // 'route_name' => 'truongbaocao',
        'params' => [
            'layout' => 'side-menu',
        ],
        'sub_menu' => [
            'danhmuc' => [
                'icon' => '',
                'route_name' => '/category',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Danh mục',
            ],
            'module' => [
                'icon' => '',
                'route_name' => '/module',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Module',
            ],
            'loaihienvat' => [
                'icon' => '',
                'route_name' => '/loai-hien-vat',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Loại hiện vật',
            ],

            'hinhthucsuutam' => [
                'icon' => '',
                'route_name' => '/hinh-thuc-suu-tam',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Hình thức sưu tầm',
            ],

            'chatlieu' => [
                'icon' => '',
                'route_name' => '/chat-lieu',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Chất liệu',
            ],

            // 'vitrihienvat' => [
            //     'icon' => '',
            //     'route_name' => '/vi-tri-hien-vat',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            //     'title' => 'Vị trí hiện vật',
            // ],




        ],
        'decentralization' => array(1, 4)
    ),
    2 =>  array(
        'icon' => 'ri-projector-fill',
        'title' => 'Quản lý hiện vật',
        'route_name' => '/bo-su-tap',
        'sub_menu' => [

            'quanlyhienvat' => [
                'icon' => '',
                'route_name' => '/quan-ly-hien-vat',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý hiện vật',
            ],

            'quanlyxuat' => [
                'icon' => '',
                'route_name' => '/nhap',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Nhập hiện vật',
            ],


            'quanlynhap' => [
                'icon' => '',
                'route_name' => '/xuat',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Xuất hiện vật',
            ],
            'sodichuyen' => [
                'icon' => '',
                'route_name' => '/so-di-chuyen-hien-vat',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Sổ di chuyển hiện vật',
            ],
        ],
        'decentralization' => array(1, 2, 3, 4, 5, 6)

    ),
    3 =>  array(
        'icon' => 'el-icon-collection',
        'title' => 'Quản lý sưu tập',
        'route_name' => '/bo-suu-tap',
        'decentralization' => array(1, 3, 4, 5, 6)
    ),

    4 =>  array(
        'icon' => 'el-icon-s-finance',
        'title' => 'Quản lý bảo quản',
        // 'route_name' => '/quan-ly-bao-quan',
        'sub_menu' => [
            'kho' => [
                'icon' => '',
                'route_name' => '/quan-ly-kho',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Kho',
            ],
            'baoquan' => [
                'icon' => '',
                'route_name' => '/bao-quan',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Loại bảo quản',

            ],
            'phieubq' => [
                'icon' => '',
                'route_name' => '/so-bao-quan-hien-vat',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Bảo quản',

            ],
            // 'phieubq' => [
            //     'icon' => '',
            //     'route_name' => '/phieu-bao-quan',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            //     'title' => 'Bảo quản',

            // ]
        ],
        'decentralization' => array(1, 4, 5, 6)

    ),

    5 =>  array(
        'icon' => 'ri-bank-card-line',
        'title' => 'Quản lý trưng bày',
        'route_name' => '/quan-ly-trung-bay',
        'sub_menu' => [
            'quanlytrungbay' => [
                'icon' => 'ri-bar-chart-2-fill',
                'title' => 'Quản lý trưng bày',
                'route_name' => '/quan-ly-trung-bay',
                'decentralization' => array(1, 2, 4, 5, 6)
            ],
            'hienvatduoctrungbay' => [
                'icon' => '',
                'route_name' => '/quan-ly-hien-vat-trung-bay',
                'title' => 'Quản lý hiện vật được trưng bày',
                'decentralization' => array(1, 2, 4, 5, 6)

            ],
            'vitritrungbay' => [
                'icon' => '',
                'route_name' => '/vi-tri-trung-bay',
                'title' => 'Quản lý vị trí trưng bày',
                'decentralization' => array(1, 2, 4, 5, 6)

            ],
            'dottrungbay' => [
                'icon' => '',
                'route_name' => '/dot-trung-bay',
                'title' => 'Đợt trưng bày',
                'decentralization' => array(1, 2, 4, 5, 6)

            ],
        ],
        'decentralization' => array(1, 3, 4, 5, 6),

    ),

    6 =>  array(
        'icon' => 'ri-bar-chart-2-fill',
        'title' => 'Báo cáo thống kê',
        'sub_menu' => [
            'baocaothongkehienvat' => [
                'icon' => 'ri-bar-chart-2-fill',
                'title' => 'Kiểm Kê hiện vật',
                'route_name' => '/bao-cao-thong-ke',
                'decentralization' => array(1, 2, 4, 5, 6)
            ],
            'baocaothongketheouser' => [
                'icon' => 'ri-bar-chart-2-fill',
                'title' => 'Báo cáo thống kê theo user',
                'route_name' => '/bao-cao-user',
                'decentralization' => array(1)

            ],

        ],
        'decentralization' => array(1, 2, 4, 5, 6)
    ),

    7 =>  array(
        'icon' => 'ri-trello-line',
        'title' => 'Sưu tập – Trưng bày ảo',
        'route_name' => '/trung-bay-ao',
        'decentralization' => array(1, 4)
    ),

    8 =>  array(
        'icon' => 'ri-gallery-line',
        'title' => 'Xử lý hình ảnh',
        'sub_menu' => [
            'quanlyhinhanh' => [
                'icon' => '',
                'route_name' => '/quan-ly-hinh-anh',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý hình ảnh',
            ],
            'Quanlybosuutaphinhanh' => [
                'icon' => '',
                'route_name' => '/quan-ly-bo-suu-tap-hinh-anh',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý bộ sưu tập hình ảnh',

            ],
            'Quanlymedia' => [
                'icon' => '',
                'route_name' => '/quan-ly-media',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý Media',

            ],
            'Làm nét ảnh bằng AI' => [
                'icon' => '',
                'route_name' => '/lam-net-anh',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Làm nét ảnh bằng AI',

            ]
        ],
        'decentralization' => array(1, 2, 4, 5, 6)
    ),

    9 =>  array(
        'icon' => 'ri-bar-chart-2-fill',
        'title' => 'Quản lý số hóa dữ liệu hiện vật',
        'route_name' => '/du-lieu-so-hoa-hien-vat',
        'decentralization' => array(1, 2, 3, 4, 5, 6)

    ),
    10 =>  array(
        'icon' => 'ri-projector-fill',
        'title' => 'Quản lý trung bày ảo trên web',
        'route_name' => '',
        'sub_menu' => [

            'quanlyhienvat' => [
                'icon' => '',
                'route_name' => '/vi-tri-trung-bay-ao',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý vị trí trưng bày ảo',
            ],

            'quanlyxuat' => [
                'icon' => '',
                'route_name' => '/quan-ly-dot-trung-bay-ao',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý đợt trưng bày ảo',
            ],


            'quanlynhap' => [
                'icon' => '',
                'route_name' => '/hien-vat-trung-bay-ao',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý hiện vật trưng bày ảo',
            ],

        ],
        'decentralization' => array(1, 4)

    ),
    11 =>  array(
        'icon' => 'ri-folder-2-line',
        'title' => 'Quản trị portal',
        // 'route_name' => 'truongbaocao',
        'params' => [
            'layout' => 'side-menu',
        ],
        'sub_menu' => [

            'portal' => [
                'icon' => '',
                'route_name' => '/portal',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý portal',
            ],
            'post' => [
                'icon' => '',
                'route_name' => '/post',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý tin bài',
            ],
            'pagenew' => [
                'icon' => '',
                'route_name' => '/pagenew',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Quản lý trang con',
            ],
        ],
        'decentralization' => array(1, 4)
    ),

    12 =>  array(
        'icon' => 'ri-login-box-line',
        'title' => 'Tài Khoản',
        'sub_menu' => [
            'quanlyhinhanh' => [
                'icon' => '',
                'route_name' => '/logout',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Logout',
            ],
            'changepassword' => [
                'icon' => '',
                'route_name' => '/change-password',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Đổi mật khẩu',
            ],

        ],
        'decentralization' => array(1, 2, 3, 4, 5, 6)
    ),
    13 =>  array(
        'icon' => 'ri-bar-chart-2-fill',
        'title' => 'Hỗ trợ',
        'route_name' => '/ho-tro',
        'decentralization' => array(1, 2, 3, 4, 5, 6)

    ),
];
