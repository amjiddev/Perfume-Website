<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\FooterSettings;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.layouts.partials.footer', function ($view) {
            $footerSettings = FooterSettings::first() ?? FooterSettings::create([
                'company_name' => 'Almukhtar Perfume',
                'company_description' => 'Premium fragrances for the discerning taste.',
                'quick_links' => [
                    ['label' => 'Home', 'url' => 'home'],
                    ['label' => 'Shop', 'url' => 'shop'],
                    ['label' => 'About', 'url' => 'about'],
                    ['label' => 'Contact', 'url' => 'contact'],
                ],
                'customer_service_links' => [
                    ['label' => 'Shipping Info', 'url' => '#'],
                    ['label' => 'Returns', 'url' => '#'],
                    ['label' => 'FAQ', 'url' => '#'],
                    ['label' => 'Privacy Policy', 'url' => '#'],
                ],
                'social_links' => [
                    ['icon' => 'facebook', 'label' => 'Facebook', 'url' => '#'],
                    ['icon' => 'instagram', 'label' => 'Instagram', 'url' => '#'],
                    ['icon' => 'twitter', 'label' => 'Twitter', 'url' => '#'],
                    ['icon' => 'linkedin', 'label' => 'LinkedIn', 'url' => '#'],
                ],
                'copyright_text' => '© 2024 Almukhtar Perfume. All rights reserved.',
            ]);
            
            $view->with('footerSettings', $footerSettings);
        });
    }
}

