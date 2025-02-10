<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        if (auth()->user()) {
            if (auth()->user()->chucvu_id == 0) {
                return [

                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Thống kê ngày',
                        'route_name' => 'thongkengay',
                        'params' => [
                            'layout' => 'side-menu',
                        ],

                    ],

                    'thong-ke-thang' => [
                        'icon' => 'home',
                        'title' => 'Thống kê tháng',
                        'route_name' => 'thongkethang',
                        'params' => [
                            'layout' => 'side-menu',
                        ],

                    ],
                    'giao-viec' => [
                        'icon' => 'home',
                        'title' => 'Giao việc',
                        'route_name' => 'giaoviec',
                        'params' => [
                            'layout' => 'side-menu',
                        ],

                    ],
                    'nhan-su' => [
                        'icon' => 'box',
                        'title' => 'Nhân sự',
                        // 'route_name' => 'truongbaocao',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'sub_menu' => [
                            'hesoluong' => [
                                'icon' => 'menu',
                                'route_name' => 'hesoluong',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Hệ số lương '
                            ],
                            'thamnienvuotkhung' => [
                                'icon' => 'menu',
                                'route_name' => 'thamnienvuotkhung',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Thâm niên vượt khung'
                            ],
                            'phucapthamnien' => [
                                'icon' => 'menu',
                                'route_name' => 'phucapthamnien',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Phụ cấp thâm niên '
                            ],
                            'phucapchucvu' => [
                                'icon' => 'menu',
                                'route_name' => 'phucapchucvu',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Phụ cấp Chức vụ '
                            ], 'quyluong' => [
                                'icon' => 'menu',
                                'route_name' => 'quyluong',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Quỹ lương'
                            ],
                            'nhansu' => [
                                'icon' => 'menu',
                                'route_name' => 'nhansu',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Nhân sự'
                            ],
                            'luongcoban' => [
                                'icon' => 'menu',
                                'route_name' => 'luongcoban',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Lương cơ bản'
                            ],
                            'luongtheocong' => [
                                'icon' => 'menu',
                                'route_name' => 'luongtheocong',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Lương Theo công'
                            ],

                        ]
                    ],
                    'thong-ke-luong' => [
                        'icon' => 'file-text',
                        'route_name' => 'thongkeluong',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Thống kê lương'
                    ],

                ];
            } elseif (auth()->user()->chucvu_id == 1) {
                return [

                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Thống kê ngày',
                        'route_name' => 'thongkengay',
                        'params' => [
                            'layout' => 'side-menu',
                        ],

                    ],

                    'thong-ke-thang' => [
                        'icon' => 'home',
                        'title' => 'Thống kê tháng',
                        'route_name' => 'thongkethang',
                        'params' => [
                            'layout' => 'side-menu',
                        ],

                    ],


                    'diem-danh' => [
                        'icon' => 'file-text',
                        'route_name' => 'diemdanh',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Chấm công'
                    ],

                    'tao-lich-lam' => [
                        'icon' => 'file-text',
                        'route_name' => 'taolichlam',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Tạo lịch làm '
                    ],
                   
                    'thong-ke-luong' => [
                        'icon' => 'file-text',
                        'route_name' => 'thongkeluong',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Thống kê lương'
                    ],


                ];
            } else {
                return [

                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Thống kê ngày',
                        'route_name' => 'thongkengay',
                        'params' => [
                            'layout' => 'side-menu',
                        ],

                    ],

                    'thong-ke-thang' => [
                        'icon' => 'home',
                        'title' => 'Thống kê tháng',
                        'route_name' => 'thongkethang',
                        'params' => [
                            'layout' => 'side-menu',
                        ],

                    ],


                    'diem-danh' => [
                        'icon' => 'file-text',
                        'route_name' => 'diemdanh',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Chấm công'
                    ],

                ];
            }
        }
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Tổng hợp',
                'route_name' => 'tonghopdonvi',
                'params' => [
                    'layout' => 'side-menu',
                ],

            ],

            'diem-danh' => [
                'icon' => 'file-text',
                'route_name' => 'diemdanh',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Chấm công'
            ],



        ];
    }
}
