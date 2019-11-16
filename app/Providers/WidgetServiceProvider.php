<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Widgets\Widget;
use Blade;


class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(‘Widget’, function ($app) {
        //     return new Widget(config('widgets'));
        // });
 
        // Для того, чтобы иметь только один экземпляр класса необходимо вызвать метод singleton() вместо метода bind():

        // $this->app->singleton(Widget::class, function ($app) {
        //     return new Widget();
        // });

        // $this->app->singleton(Widget::class, function ($app) {
        //     return new Widget(config('widgets'));
        // });


        $this->app->singleton('widget', function ($app) {
            return new Widget(config('widgets'));
        });
 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     //
    // }

    public function boot() 
    {
        // Здесь можно добавить собственные директивы.
       
        Blade::directive('widget', function ($name) {
                return "<?php echo app('widget')->show($name); ?>";
        });

        /*
        * Регистрируем каталог для хранения шаблонов views/widgets
        */
        $this->loadViewsFrom(resource_path('views/widgets'), 'widgets');
    }
}
