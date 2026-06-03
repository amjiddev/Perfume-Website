<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\FooterSettings;
use Illuminate\Http\Request;

class FooterSettingsController extends Controller
{
    public function index()
    {
        $footerSettings = FooterSettings::first();
        return view('admin.footer-settings.index', compact('footerSettings'));
    }

    public function edit()
    {
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
        return view('admin.footer-settings.edit', compact('footerSettings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_description' => 'required|string',
            'copyright_text' => 'required|string',
        ]);

        $footerSettings = FooterSettings::first() ?? new FooterSettings();
        $footerSettings->fill($validated)->save();

        return redirect()->route('admin.footer-settings.index')->with('success', 'Footer settings updated successfully!');
    }
}

