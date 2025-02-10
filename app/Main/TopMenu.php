<?php

namespace App\Main;

class TopMenu
{
    /**
     * List of top menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        if (auth()->user()) {
            if (auth()->user()->donvi_id == 0) {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Tổng hợp',
                        'route_name' => 'tonghop',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                        'sub_menu'=>[
                            'tonghop1' => [
                                'icon' => 'award',
                                'title' => 'Tổng Hợp 1',
                                // 'route_name' => 'truongbaocao',
                                'params' => [
                                    'layout' => 'top-menu',
                                ],
                            ],
                        ],
                    ],
                    'truongbaocao' => [
                        'icon' => 'award',
                        'title' => 'Trường Báo Cáo',
                        // 'route_name' => 'truongbaocao',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                    'tieuchi' => [
                        'icon' => 'file',
                        'title' => 'Quản lí Tiêu Chí',
                        'route_name' => 'indexTieuchi',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                    'tonghopbaocao' => [
                        'icon' => 'briefcase',
                        'title' => 'Báo cáo',
                        'route_name' => 'baocao',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                    'botieuchi' => [
                        'icon' => 'briefcase',
                        'title' => 'Bộ tiêu chí ',
                        'route_name' => 'viewbotieuchi',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],

                    'dotdanhgia' => [
                        'icon' => 'file-text',
                        'title' => 'Đợt đánh giá',
                        'route_name' => 'dotbaocao',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],


                    'ketqua' => [
                        'icon' => 'file-text',
                        'title' => 'Kết quả',
                        // 'route_name' => '',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],

                    'xuatdulieu' => [
                        'icon' => 'file-text',
                        'title' => 'Xuất Dữ Liệu',
                        'route_name' => 'xuatdulieu',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],

                    'hoidap' => [
                        'icon' => 'file-text',
                        'title' => 'Hỏi Đáp',
                        // 'route_name' => '',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],

                    'huongdansudung' => [
                        'icon' => 'file-text',
                        'title' => 'Hướng dẫn sử dụng',
                        // 'route_name' => '',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                 
                    'nova' => [
                        'icon' => 'settings',
                        'route_name' => 'tonova',
                        'title' => 'Cấu hình hệ thống',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                ];
            } else {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Tổng hợp',
                        'route_name' => 'tonghop',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                    'truongbaocao' => [
                        'icon' => 'award',
                        'title' => 'Trường Báo Cáo',
                        // 'route_name' => 'truongbaocao',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                    'dotdanhgia' => [
                        'icon' => 'file-text',
                        'title' => 'Đợt đánh giá',
                        'route_name' => 'dotbaocao',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],


                    'ketqua' => [
                        'icon' => 'file-text',
                        'title' => 'Kết quả',
                        // 'route_name' => '',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],
                    'hoidap' => [
                        'icon' => 'file-text',
                        'title' => 'Hỏi Đáp',
                        // 'route_name' => '',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],

                    'huongdansudung' => [
                        'icon' => 'file-text',
                        'title' => 'Hướng dẫn sử dụng',
                        // 'route_name' => '',
                        'params' => [
                            'layout' => 'top-menu',
                        ],
                    ],


                ];
            }
        }
    }
}
