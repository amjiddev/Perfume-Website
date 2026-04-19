# Dynamic Perfume Page Setup Guide

## Overview
This guide explains how to set up and use the new dynamic perfume page management system. The perfume page is now fully dynamic, allowing admins to manage all content from the dashboard without touching code.

## What's New

### 1. **Admin Dashboard - Perfume Page Management**
- **Location**: `/admin/perfume-page`
- **Features**:
  - Manage hero section (heading, subheading, background image)
  - Manage best sellers section titles
  - Manage testimonials section titles
  - Add, edit, and delete perfumes
  - Auto-calculate discount percentages
  - Upload product images

### 2. **Frontend - Dynamic Perfume Page**
- **Location**: `/perfumes`
- **Features**:
  - Displays all perfumes from database
  - Shows first 4 perfumes with "Show More" button
  - Best sellers section (featured perfumes)
  - Customer testimonials section
  - Fully responsive design
  - Same design as original, now powered by database

## Installation Steps

### Step 1: Run Migrations
```bash
php artisan migrate
```

This will create two new tables:
- `perfumes` - Stores perfume products
- `perfume_pages` - Stores page settings

### Step 2: Access Admin Panel
1. Log in to your admin dashboard
2. Navigate to: **Admin > Perfume Page Settings**
3. You'll see the perfume management interface

### Step 3: Configure Page Settings
1. Update the hero section:
   - Hero Heading (e.g., "Luxury Perfumes")
   - Hero Subheading (e.g., "Discover long-lasting premium fragrances...")
   - Hero Background Image (upload or leave default)

2. Update best sellers section:
   - Subtitle (e.g., "MOST LOVED")
   - Title (e.g., "Best Selling Perfumes")

3. Update testimonials section:
   - Subtitle (e.g., "CUSTOMER REVIEWS")
   - Title (e.g., "What Our Customers Say")

4. Click "Save Changes"

### Step 4: Add Perfumes
1. Click "Add Perfume" button
2. Fill in the form:
   - **Perfume Name** (required)
   - **Category** (Men, Women, Unisex, Arabic)
   - **Description** (optional)
   - **Sale Price** (required)
   - **Original Price** (optional - discount % auto-calculates)
   - **Rating** (0-5)
   - **Reviews Count**
   - **Image** (optional)

3. Click "Add Perfume"

### Step 5: Manage Perfumes
- **Edit**: Click the "Edit" button on any perfume row
- **Delete**: Click the "Delete" button (with confirmation)
- **View**: All perfumes appear on the frontend `/perfumes` page

## Database Schema

### Perfumes Table
```
- id (Primary Key)
- name (string)
- description (text, nullable)
- image (string, nullable)
- price (decimal)
- original_price (decimal, nullable)
- discount_percentage (integer, nullable)
- rating (decimal 0-5)
- reviews_count (integer)
- category (enum: men, women, unisex, arabic)
- is_featured (boolean) - Used for best sellers
- sort_order (integer) - For ordering
- timestamps
```

### Perfume Pages Table
```
- id (Primary Key)
- hero_heading (string, nullable)
- hero_subheading (text, nullable)
- hero_image (string, nullable)
- best_sellers_title (string, nullable)
- best_sellers_subtitle (string, nullable)
- testimonials_title (string, nullable)
- testimonials_subtitle (string, nullable)
- timestamps
```

## File Structure

### New Files Created:
```
app/
├── Models/
│   ├── Perfume.php
│   └── PerfumePage.php
├── Http/Controllers/
│   ├── Apps/
│   │   └── PerfumePageController.php
│   └── Frontend/
│       └── PerfumePageController.php

resources/views/
├── admin/perfume-page/
│   └── index.blade.php
└── frontend/
    └── perfumes-dynamic.blade.php

database/migrations/
├── 2024_04_10_create_perfumes_table.php
└── 2024_04_10_create_perfume_pages_table.php

routes/
├── web.php (updated)
└── frontend-routes.php (updated)
```

## Routes

### Admin Routes
- `GET /admin/perfume-page` - View perfume management page
- `PUT /admin/perfume-page` - Update page settings
- `POST /admin/perfume-page/perfumes` - Add new perfume
- `PUT /admin/perfume-page/perfumes/{perfume}` - Update perfume
- `DELETE /admin/perfume-page/perfumes/{perfume}` - Delete perfume

### Frontend Routes
- `GET /perfumes` - View dynamic perfume page

## Features

### Admin Features
✅ Manage hero section content and image
✅ Manage section titles and subtitles
✅ Add unlimited perfumes
✅ Edit perfume details
✅ Delete perfumes
✅ Auto-calculate discount percentages
✅ Upload product images
✅ Set featured perfumes (for best sellers)
✅ Sort perfumes by order
✅ Responsive admin interface

### Frontend Features
✅ Display all perfumes from database
✅ Show/hide more perfumes with button
✅ Best sellers section (featured perfumes)
✅ Customer testimonials
✅ Responsive design
✅ Same visual design as original
✅ Wishlist buttons (ready for functionality)
✅ Product ratings and reviews count

## Image Upload Paths
- Perfume images: `/public/uploads/perfumes/`
- Hero images: `/public/uploads/perfume/`

Make sure these directories exist and are writable:
```bash
mkdir -p public/uploads/perfumes
mkdir -p public/uploads/perfume
chmod 755 public/uploads/perfumes
chmod 755 public/uploads/perfume
```

## Customization

### Change Default Values
Edit `app/Http/Controllers/Apps/PerfumePageController.php` in the `index()` method to change default page settings.

### Modify Frontend Design
Edit `resources/views/frontend/perfumes-dynamic.blade.php` to customize the design while keeping the dynamic data structure.

### Add More Categories
1. Update the migration to add new enum values
2. Update the form selects in admin view
3. Update the frontend view if needed

## Troubleshooting

### Images not uploading
- Check if upload directories exist and are writable
- Verify file permissions: `chmod 755 public/uploads/perfumes`

### Perfumes not showing
- Run migrations: `php artisan migrate`
- Check if perfumes exist in database
- Verify routes are correct

### Admin page not accessible
- Ensure user is authenticated and has admin role
- Check middleware in `routes/web.php`

## Next Steps

1. **Add Testimonials Management**: Create admin interface to manage testimonials
2. **Add Product Details Page**: Create individual product detail pages
3. **Add Wishlist Functionality**: Implement wishlist feature
4. **Add Reviews System**: Allow customers to leave reviews
5. **Add Filters**: Implement category and price filters on frontend

## Support

For issues or questions, check:
- Laravel documentation: https://laravel.com/docs
- Blade templating: https://laravel.com/docs/blade
- Database migrations: https://laravel.com/docs/migrations
