<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Keranjang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    view()->composer('*', function ($view) {
        if (session('user_logged_in')) {
            $keranjang = Keranjang::with('produk')
                ->where('id_user', session('user_id'))
                ->get();
            
            $subtotal = $keranjang->sum(function ($item) {
            return $item->produk->harga ?? 0;
            });
            
            $jumlahKeranjang = $keranjang->count();

            $view->with([
                'keranjang' => $keranjang,
                'jumlahKeranjang' => $jumlahKeranjang,
                'subtotal' => $subtotal
            ]);
        }
    });
    }
}
