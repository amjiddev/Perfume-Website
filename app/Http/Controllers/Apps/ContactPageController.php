<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index()
    {
        $contactPage = ContactPage::first() ?? ContactPage::create([
            'title' => 'Contact Us',
            'hero_heading' => 'Get In Touch',
            'hero_subheading' => 'We\'d love to hear from you. Send us a message and we\'ll respond as soon as possible.',
            'description' => 'Have questions about our fragrances? Need assistance with an order? Our dedicated team is here to help.',
            'phone' => '+92 (0) 300 1234567',
            'email' => 'info@almukhtar.com',
            'address' => 'Almukhtar Perfume Store, Main Street, Karachi, Pakistan',
            'office_hours' => 'Monday - Friday: 10:00 AM - 6:00 PM\nSaturday: 11:00 AM - 5:00 PM\nSunday: Closed',
            'contact_form_title' => 'Send us a Message',
            'contact_form_description' => 'Fill out the form below and we\'ll get back to you within 24 hours.',
        ]);

        return view('admin.contact-page.index', compact('contactPage'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'office_hours' => 'nullable|string',
            'map_embed_code' => 'nullable|string',
            'contact_form_title' => 'nullable|string|max:255',
            'contact_form_description' => 'nullable|string',
        ]);

        $contactPage = ContactPage::first();
        if (!$contactPage) {
            $contactPage = ContactPage::create($validated);
        } else {
            // Handle hero image upload
            if ($request->hasFile('hero_image')) {
                if ($contactPage->hero_image && file_exists(public_path($contactPage->hero_image))) {
                    unlink(public_path($contactPage->hero_image));
                }
                
                $file = $request->file('hero_image');
                $filename = 'contact-hero-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/contact'), $filename);
                $validated['hero_image'] = 'uploads/contact/' . $filename;
            }
            
            $contactPage->update($validated);
        }

        return redirect()->back()->with('success', 'Contact page updated successfully!');
    }
}
