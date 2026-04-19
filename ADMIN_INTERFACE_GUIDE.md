# Admin Interface Guide - Perfume Page Management

## 📍 Access Point
**URL**: `/admin/perfume-page`

---

## 🎨 Admin Dashboard Layout

### Section 1: Page Settings Card
Located at the top of the page

#### Hero Section
```
┌─────────────────────────────────────────┐
│ Hero Section                            │
├─────────────────────────────────────────┤
│ Hero Heading                            │
│ [Input: Luxury Perfumes]                │
│                                         │
│ Hero Subheading                         │
│ [Textarea: Discover long-lasting...]    │
│                                         │
│ Hero Background Image                  │
│ [File Upload]                           │
│ Current image: [Preview]                │
└─────────────────────────────────────────┘
```

#### Best Sellers Section
```
┌─────────────────────────────────────────┐
│ Best Sellers Section                    │
├─────────────────────────────────────────┤
│ Subtitle                                │
│ [Input: MOST LOVED]                     │
│                                         │
│ Title                                   │
│ [Input: Best Selling Perfumes]          │
└─────────────────────────────────────────┘
```

#### Testimonials Section
```
┌─────────────────────────────────────────┐
│ Testimonials Section                    │
├─────────────────────────────────────────┤
│ Subtitle                                │
│ [Input: CUSTOMER REVIEWS]               │
│                                         │
│ Title                                   │
│ [Input: What Our Customers Say]         │
└─────────────────────────────────────────┘
```

**Action Button**: [💾 Save Changes]

---

### Section 2: Manage Perfumes Table
Located below page settings

#### Header
```
┌──────────────────────────────────────────────────────────────┐
│ Manage Perfumes                    [➕ Add Perfume]          │
└──────────────────────────────────────────────────────────────┘
```

#### Table Structure
```
┌─────────────────────────────────────────────────────────────────────────────┐
│ Image │ Name │ Category │ Price │ Discount │ Rating │ Actions             │
├─────────────────────────────────────────────────────────────────────────────┤
│ [IMG] │ Emer │ Men      │ 51530 │ -20%     │ ⭐⭐⭐⭐ │ [Edit] [Delete]    │
│       │ aude │          │       │          │ (185)  │                     │
├─────────────────────────────────────────────────────────────────────────────┤
│ [IMG] │ Rose │ Women    │ 58380 │ -        │ ⭐⭐⭐⭐ │ [Edit] [Delete]    │
│       │ Dor  │          │       │          │ (210)  │                     │
├─────────────────────────────────────────────────────────────────────────────┤
│ ...   │ ...  │ ...      │ ...   │ ...      │ ...    │ ...                 │
└─────────────────────────────────────────────────────────────────────────────┘
```

---

## 🔧 Modal Dialogs

### Add Perfume Modal
```
┌─────────────────────────────────────────────────────────────┐
│ Add New Perfume                                        [✕]  │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Perfume Name *              │ Category *                    │
│ [Input: Required]           │ [Dropdown: Select Category]   │
│                             │ - For Men                     │
│ Description                 │ - For Women                   │
│ [Textarea]                  │ - Unisex                      │
│                             │ - Arabic Perfumes             │
│                                                             │
│ Sale Price (Rs) *           │ Original Price (Rs)           │
│ [Input: 51530]              │ [Input: 64415]                │
│                                                             │
│ Discount % (Auto)           │                               │
│ [Input: 20] (readonly)      │                               │
│                                                             │
│ Rating (0-5)                │ Reviews Count                 │
│ [Input: 4.5]                │ [Input: 185]                  │
│                                                             │
│ Perfume Image                                               │
│ [File Upload]                                               │
│                                                             │
├─────────────────────────────────────────────────────────────┤
│ [Close]                                    [Add Perfume]    │
└─────────────────────────────────────────────────────────────┘
```

### Edit Perfume Modal
Same as Add Perfume Modal but:
- Title: "Edit Perfume"
- Fields pre-filled with current values
- Shows current image preview
- Button text: "Update Perfume"

---

## 📋 Form Fields Explained

### Required Fields (marked with *)
- **Perfume Name**: The name of the perfume (e.g., "Emeraude Noire")
- **Category**: Choose from Men, Women, Unisex, or Arabic
- **Sale Price**: Current selling price in Rs

### Optional Fields
- **Description**: Short description of the perfume
- **Original Price**: Original price (if on discount)
- **Rating**: Star rating from 0-5
- **Reviews Count**: Number of customer reviews
- **Image**: Product image file

### Auto-Calculated Fields
- **Discount %**: Automatically calculated when you enter both Sale Price and Original Price
  - Formula: `((Original - Sale) / Original) × 100`

---

## 🎯 Common Tasks

### Add a New Perfume
1. Click **[➕ Add Perfume]** button
2. Fill in the form:
   - Name: "Rose Dorée"
   - Category: "For Women"
   - Sale Price: 58380
   - Original Price: 68815 (discount auto-calculates to 15%)
   - Rating: 4.5
   - Reviews: 210
   - Description: "Bulgarian rose with saffron notes"
   - Image: Upload or skip
3. Click **[Add Perfume]**
4. Success message appears

### Edit a Perfume
1. Find the perfume in the table
2. Click **[Edit]** button
3. Modal opens with current values
4. Make changes
5. Click **[Update Perfume]**
6. Success message appears

### Delete a Perfume
1. Find the perfume in the table
2. Click **[Delete]** button
3. Confirmation dialog appears
4. Click **OK** to confirm
5. Perfume is deleted
6. Success message appears

### Update Page Settings
1. Scroll to top of page
2. Update any of these sections:
   - Hero Section (heading, subheading, image)
   - Best Sellers Section (subtitle, title)
   - Testimonials Section (subtitle, title)
3. Click **[💾 Save Changes]**
4. Success message appears

---

## 🖼️ Image Upload

### Supported Formats
- JPEG (.jpg, .jpeg)
- PNG (.png)
- GIF (.gif)

### File Size Limit
- Maximum: 2MB per image

### Upload Paths
- **Perfume Images**: `/public/uploads/perfumes/`
- **Hero Images**: `/public/uploads/perfume/`

### Tips
- Use high-quality images (at least 300x400px for products)
- Optimize images before uploading to reduce file size
- Use descriptive filenames

---

## ✅ Validation Rules

### Perfume Name
- Required
- Maximum 255 characters

### Category
- Required
- Must be one of: men, women, unisex, arabic

### Sale Price
- Required
- Must be a number
- Minimum: 0

### Original Price
- Optional
- Must be a number
- Must be greater than Sale Price (if provided)

### Rating
- Optional
- Must be between 0 and 5
- Can include decimals (e.g., 4.5)

### Reviews Count
- Optional
- Must be a whole number
- Minimum: 0

### Image
- Optional
- Must be an image file
- Maximum size: 2MB

---

## 💡 Tips & Tricks

### Auto-Calculate Discount
1. Enter Sale Price: 51530
2. Enter Original Price: 64415
3. Discount % automatically shows: 20%

### Featured Perfumes
- Perfumes marked as "featured" appear in the Best Sellers section
- To mark as featured, edit the perfume and check the "Featured" checkbox
- Only featured perfumes show in the best sellers section on frontend

### Sort Order
- Use the "Sort Order" field to arrange perfumes
- Lower numbers appear first
- Leave blank or use 0 for default ordering

### Bulk Actions
- Currently, you can add/edit/delete one perfume at a time
- For bulk operations, consider using database tools or creating a bulk import feature

---

## 🔔 Messages

### Success Messages
- ✅ "Perfume page settings updated successfully!"
- ✅ "Perfume added successfully!"
- ✅ "Perfume updated successfully!"
- ✅ "Perfume deleted successfully!"

### Error Messages
- ❌ "The [field] field is required."
- ❌ "Original price must be greater than sale price."
- ❌ "The image must be an image file."
- ❌ "The image may not be greater than 2048 kilobytes."

---

## 🎨 Frontend Preview

After adding perfumes and updating settings, visit `/perfumes` to see:

1. **Hero Section** - With your custom heading, subheading, and image
2. **Products Grid** - All your perfumes displayed
3. **Best Sellers** - Featured perfumes in a special section
4. **Testimonials** - Customer reviews section
5. **Show More Button** - To display additional perfumes

---

## 🚀 Quick Reference

| Task | Location | Button |
|------|----------|--------|
| Add Perfume | Manage Perfumes section | ➕ Add Perfume |
| Edit Perfume | Table row | Edit |
| Delete Perfume | Table row | Delete |
| Save Settings | Top of page | 💾 Save Changes |
| Go Back | Bottom of page | ← Back |

---

## 📞 Need Help?

Refer to:
- `PERFUME_PAGE_SETUP.md` - Complete setup guide
- `PERFUME_PAGE_QUICK_START.md` - Quick start guide
- `IMPLEMENTATION_CHECKLIST.md` - Implementation details

---

**Happy managing!** 🎉
