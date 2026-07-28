<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $homePage = HomePage::first() ?? HomePage::create([
            'hero_heading' => 'Discover Luxury',
            'hero_subheading' => 'Experience the finest collection of premium fragrances from around the world. Each scent tells a story of elegance and sophistication.',
            'hero_image_1' => 'frontend/images/perfume1.jpg',
            'hero_image_2' => 'frontend/images/perfume2.jpg',
            'about_heading' => 'Almukhtar Perfume',
            'about_description' => 'Almukhtar Perfume represents the pinnacle of luxury fragrance craftsmanship. With decades of expertise in perfumery, we curate the finest collection of long-lasting fragrances from around the world.',
            'about_image' => 'frontend/images/perfume5.jfif',
            'about_features' => [
                'Premium quality fragrances',
                'Long-lasting scents',
                'Authentic & original products',
                'Expert curation'
            ]
        ]);

        return view('admin.home-page.index', compact('homePage'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_heading' => 'required|string|max:255',
            'hero_subheading' => 'required|string',
            'hero_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_1_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_1_tablet' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_1_laptop' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_2_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_2_tablet' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_2_laptop' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_3_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_3_tablet' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_3_laptop' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_4_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_4_tablet' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_4_laptop' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_heading' => 'required|string|max:255',
            'about_description' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_features' => 'nullable|array',
            'about_features.*' => 'string|max:255',
        ]);

        $homePage = HomePage::first();
        if (!$homePage) {
            $homePage = HomePage::create($validated);
            return redirect()->back()->with('success', 'Home page created successfully!');
        }

        // Handle hero image 1
        if ($request->hasFile('hero_image_1')) {
            try {
                if ($homePage->hero_image_1 && file_exists(public_path($homePage->hero_image_1))) {
                    unlink(public_path($homePage->hero_image_1));
                }
                // Clean up old versions
                $this->deleteOldFiles('uploads/home-page', 'hero-1-');
                
                $file = $request->file('hero_image_1');
                $uniqueId = uniqid() . '-' . time();
                $filename = 'hero-1-' . $uniqueId . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/home-page'), $filename);
                $validated['hero_image_1'] = 'uploads/home-page/' . $filename;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error uploading hero image 1: ' . $e->getMessage());
            }
        }

        // Handle hero image 2
        if ($request->hasFile('hero_image_2')) {
            try {
                if ($homePage->hero_image_2 && file_exists(public_path($homePage->hero_image_2))) {
                    unlink(public_path($homePage->hero_image_2));
                }
                // Clean up old versions
                $this->deleteOldFiles('uploads/home-page', 'hero-2-');
                
                $file = $request->file('hero_image_2');
                $uniqueId = uniqid() . '-' . time();
                $filename = 'hero-2-' . $uniqueId . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/home-page'), $filename);
                $validated['hero_image_2'] = 'uploads/home-page/' . $filename;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error uploading hero image 2: ' . $e->getMessage());
            }
        }

        // Handle hero images 3 and 4
        for ($i = 3; $i <= 4; $i++) {
            $fieldName = 'hero_image_' . $i;
            if ($request->hasFile($fieldName)) {
                try {
                    if ($homePage->$fieldName && file_exists(public_path($homePage->$fieldName))) {
                        unlink(public_path($homePage->$fieldName));
                    }
                    // Clean up old versions
                    $this->deleteOldFiles('uploads/home-page', 'hero-' . $i . '-');
                    
                    $file = $request->file($fieldName);
                    $uniqueId = uniqid() . '-' . time();
                    $filename = 'hero-' . $i . '-' . $uniqueId . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home-page'), $filename);
                    $validated[$fieldName] = 'uploads/home-page/' . $filename;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', "Error uploading hero image $i: " . $e->getMessage());
                }
            }
        }

        // Handle about image
        if ($request->hasFile('about_image')) {
            try {
                if ($homePage->about_image && file_exists(public_path($homePage->about_image))) {
                    unlink(public_path($homePage->about_image));
                }
                // Clean up old versions
                $this->deleteOldFiles('uploads/home-page', 'about-');
                
                $file = $request->file('about_image');
                $uniqueId = uniqid() . '-' . time();
                $filename = 'about-' . $uniqueId . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/home-page'), $filename);
                $validated['about_image'] = 'uploads/home-page/' . $filename;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error uploading about image: ' . $e->getMessage());
            }
        }

        // Handle responsive hero images
        $responsiveImageFields = [
            'hero_image_1_mobile', 'hero_image_1_tablet', 'hero_image_1_laptop',
            'hero_image_2_mobile', 'hero_image_2_tablet', 'hero_image_2_laptop',
            'hero_image_3_mobile', 'hero_image_3_tablet', 'hero_image_3_laptop',
            'hero_image_4_mobile', 'hero_image_4_tablet', 'hero_image_4_laptop'
        ];

        foreach ($responsiveImageFields as $field) {
            if ($request->hasFile($field)) {
                try {
                    if ($homePage->$field && file_exists(public_path($homePage->$field))) {
                        unlink(public_path($homePage->$field));
                    }
                    // Clean up old versions
                    $filePrefix = str_replace('_', '-', $field) . '-';
                    $this->deleteOldFiles('uploads/home-page', $filePrefix);
                    
                    $file = $request->file($field);
                    $uniqueId = uniqid() . '-' . time();
                    $filename = $filePrefix . $uniqueId . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home-page'), $filename);
                    $validated[$field] = 'uploads/home-page/' . $filename;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', "Error uploading $field: " . $e->getMessage());
                }
            }
        }

        $homePage->update($validated);
        return redirect()->back()->with('success', 'Home page updated successfully!');
    }

    /**
     * Delete all old versions of files with given prefix
     */
    private function deleteOldFiles($directory, $prefix)
    {
        $fullPath = public_path($directory);
        
        if (!is_dir($fullPath)) {
            return;
        }

        $files = glob($fullPath . '/' . $prefix . '*', GLOB_BRACE);
        
        foreach ((array)$files as $file) {
            if (file_exists($file) && is_file($file)) {
                try {
                    unlink($file);
                } catch (\Exception $e) {
                    // Log but don't fail if we can't delete a file
                }
            }
        }
    }
}


