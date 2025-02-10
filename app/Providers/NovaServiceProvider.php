<?php

namespace App\Providers;


use DigitalCreative\CollapsibleResourceManager\Resources\Group;
use DigitalCreative\CollapsibleResourceManager\Resources\InternalLink;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Silvanite\NovaToolPermissions\NovaToolPermissions;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use EricLagarda\NovaGallery\NovaGallery;
use CodencoDev\NovaGridSystem\NovaGridSystem;
use Mayviet\Baocaokhieunaifield\Baocaokhieunaifield;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            //new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {

        return [
            // ...
            
            new CollapsibleResourceManager([
                'navigation' => [
                    TopLevelResource::make([
                        'label' => 'Cán Bộ',
                        'resources' => [
                            \App\Nova\Canbo::class,
                            \App\Nova\Canbo_nhiemky::class,
                      
                        ]
                    ]),

                    TopLevelResource::make([
                        'label' => 'Khiếu nại tố cáo',
                        'resources' => [
                            \App\Nova\Doituongkhieunai::class,
                            \App\Nova\Khieunaitocao::class,
                            \App\Nova\Loaidonthu::class,
                            \App\Nova\ketquaxulydonthu::class,
                       
                            
                        ]
                    ]),

                    TopLevelResource::make([
                        'label' => 'Tiếp Xúc Cử Tri',
                        'resources' => [
                            \App\Nova\Tiepxuccutri::class,
                            \App\Nova\Noidungtiepxuc::class,
                            \App\Nova\Ketquatiepxuc::class,
                            \App\Nova\Kiennghi::class,
                           
                        ]
                    ]),

                    TopLevelResource::make([
                        'label' => 'Kỳ Họp',
                        'resources' => [
                            \App\Nova\Kyhop::class,
                            \App\Nova\Chatvan::class,
                            \App\Nova\Ketluan::class,
                            \App\Nova\Phatbieu::class,
                         
                            
                        ]
                    ]),
                    
                    TopLevelResource::make([
                        'label' => 'Danh Mục',
                        'resources' => [
                            \App\Nova\Diaban::class,
                            \App\Nova\Loaidiaban::class,
                            \App\Nova\Tongiao::class,
                            \App\Nova\Dantoc::class,
                            \App\Nova\Trinhdochuyenmon::class,
                            \App\Nova\Linhvuc::class,
                            \App\Nova\Chucvu::class,
                            \App\Nova\Nhiemky::class,
                            \App\Nova\Chuongtrinhhoatdong::class,
                            \App\Nova\Donvi::class,
                            \App\Nova\Loaidonthu::class,
                            \App\Nova\Doituongkhieunai::class,
                            
                        ]
                    ]),

                    TopLevelResource::make([
                        'label' => 'Tài Liệu',
                        'resources' => [
                            \App\Nova\Tailieu::class,
                            \App\Nova\Loaitailieu   ::class,
                            
                        ]
                    ]),

                    TopLevelResource::make([
                        'label' => 'Quản Trị',
                        'resources' => [
                            \App\Nova\User::class,
                       
                            
                        ]
                    ]),
                    


                ]
            ]),

            new NovaGridSystem,
            new Baocaokhieunaifield,

        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
