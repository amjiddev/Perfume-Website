<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $aboutPage = AboutPage::first() ?? AboutPage::create([
            'title' => 'About Us',
            'hero_heading' => 'About Our Company',
            'hero_subheading' => 'Discover our story, mission, and values.',
            'content_section_1_title' => 'Our Story',
            'content_section_1_description' => 'We are dedicated to providing the finest fragrances and exceptional customer service.',
            'content_section_2_title' => 'Why Choose Us',
            'content_section_2_description' => 'With years of experience, we offer premium quality products at competitive prices.',
            'mission_title' => 'Our Mission',
            'mission_description' => 'To deliver premium fragrances that enhance the lifestyle of our customers.',
            'vision_title' => 'Our Vision',
            'vision_description' => 'To become the leading fragrance provider in the region.',
            'values_title' => 'Our Values',
            'values_description' => 'Quality, Integrity, Customer Satisfaction, and Innovation.',
        ]);

        return view('admin.about-page.index', compact('aboutPage'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_section_1_title' => 'nullable|string|max:255',
            'content_section_1_description' => 'nullable|string',
            'content_section_1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_section_2_title' => 'nullable|string|max:255',
            'content_section_2_description' => 'nullable|string',
            'content_section_2_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission_title' => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'values_title' => 'nullable|string|max:255',
            'values_description' => 'nullable|string',
        ]);

        $aboutPage = AboutPage::first();
        if (!$aboutPage) {
            $aboutPage = AboutPage::create($validated);
        } else {
            // Handle hero image upload
            if ($request->hasFile('hero_image')) {
                if ($aboutPage->hero_image && file_exists(public_path($aboutPage->hero_image))) {
                    unlink(public_path($aboutPage->hero_image));
                }
                
                $file = $request->file('hero_image');
                $filename = 'about-hero-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/about'), $filename);
                $validated['hero_image'] = 'uploads/about/' . $filename;
            }

            // Handle content section 1 image
            if ($request->hasFile('content_section_1_image')) {
                if ($aboutPage->content_section_1_image && file_exists(public_path($aboutPage->content_section_1_image))) {
                    unlink(public_path($aboutPage->content_section_1_image));
                }
                
                $file = $request->file('content_section_1_image');
                $filename = 'about-section1-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/about'), $filename);
                $validated['content_section_1_image'] = 'uploads/about/' . $filename;
            }

            // Handle content section 2 image
            if ($request->hasFile('content_section_2_image')) {
                if ($aboutPage->content_section_2_image && file_exists(public_path($aboutPage->content_section_2_image))) {
                    unlink(public_path($aboutPage->content_section_2_image));
                }
                
                $file = $request->file('content_section_2_image');
                $filename = 'about-section2-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/about'), $filename);
                $validated['content_section_2_image'] = 'uploads/about/' . $filename;
            }
            
            $aboutPage->update($validated);
        }

        return redirect()->back()->with('success', 'About page updated successfully!');
    }

    public function deleteImage(Request $request)
    {
        try {
            $request->validate([
                'image_field' => 'required|in:hero_image,content_section_1_image,content_section_2_image',
            ]);

            $imageField = $request->input('image_field');
            $aboutPage = AboutPage::first();

            if (!$aboutPage) {
                return response()->json(['success' => false, 'message' => 'About page not found']);
            }

            $imagePath = $aboutPage->$imageField;
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $aboutPage->update([$imageField => null]);
            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Unable to delete image']);
        }
    }
}
