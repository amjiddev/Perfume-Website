# Troubleshooting Guide - Dynamic Perfume Page

## 🔍 Common Issues and Solutions

---

## 1. Migration Issues

### Issue: "SQLSTATE[HY000]: General error: 1030 Got error..."
**Cause**: Database connection issue or insufficient permissions

**Solution**:
```bash
# Check database connection in .env
# Ensure database exists
# Try running migrations with verbose output
php artisan migrate --verbose

# If still failing, try fresh migration (WARNING: deletes all data)
php artisan migrate:fresh
```

---

### Issue: "SQLSTATE[42S01]: Base table or view already exists..."
**Cause**: Tables already exist in database

**Solution**:
```bash
# Check if tables exist
php artisan tinker
>>> DB::table('perfumes')->count()

# If tables exist, you can skip migration or rollback first
php artisan migrate:rollback
php artisan migrate
```

---

## 2. Image Upload Issues

### Issue: Images not uploading / "File not found"
**Cause**: Upload directories don't exist or lack permissions

**Solution**:
```bash
# Create directories
mkdir -p public/uploads/perfumes
mkdir -p public/uploads/perfume

# Set proper permissions
chmod 755 public/uploads/perfumes
chmod 755 public/uploads/perfume

# Verify directories exist
ls -la public/uploads/
```

---

### Issue: "The image may not be greater than 2048 kilobytes"
**Cause**: Image file is too large

**Solution**:
- Compress image before uploading
- Use online image compressor
- Reduce image dimensions
- Maximum file size is 2MB

---

### Issue: "The image must be an image file"
**Cause**: File type not supported

**Solution**:
- Supported formats: JPEG, PNG, GIF
- Ensure file has correct extension
- Try uploading a different image
- Check file is not corrupted

---

## 3. Admin Panel Access Issues

### Issue: "Access Denied" or "Unauthorized" on `/admin/perfume-page`
**Cause**: User not authenticated or doesn't have admin role

**Solution**:
```bash
# Verify user is logged in
# Check user has admin role
php artisan tinker
>>> Auth::user()->roles

# If no admin role, assign it
>>> $user = User::find(1);
>>> $user->assignRole('admin');
```

---

### Issue: Admin page shows 404 error
**Cause**: Routes not registered or cache issue

**Solution**:
```bash
# Clear route cache
php artisan route:clear

# Verify routes are registered
php artisan route:list | grep perfume

# If routes missing, check routes/web.php is updated
```

---

## 4. Frontend Page Issues

### Issue: `/perfumes` page shows 404 error
**Cause**: Route not registered or controller not found

**Solution**:
```bash
# Clear route cache
php artisan route:clear

# Verify route exists
php artisan route:list | grep perfumes

# Check controller exists
ls app/Http/Controllers/Frontend/PerfumePageController.php

# If missing, check routes/frontend-routes.php is updated
```

---

### Issue: Perfumes not displaying on frontend
**Cause**: No perfumes in database or query issue

**Solution**:
```bash
# Check if perfumes exist in database
php artisan tinker
>>> Perfume::count()

# If 0, add perfumes via admin panel or seed
>>> php artisan db:seed --class=PerfumeSeeder

# Check if PerfumePage exists
>>> PerfumePage::count()

# If 0, it will be created automatically on first access
```

---

### Issue: Images not showing on frontend
**Cause**: Image path incorrect or file doesn't exist

**Solution**:
```bash
# Verify image files exist
ls -la public/uploads/perfumes/

# Check image paths in database
php artisan tinker
>>> Perfume::first()->image

# Verify asset() helper is working
# In blade: {{ asset($perfume->image) }}

# Check public folder is accessible
# Try accessing image directly: /uploads/perfumes/perfume-123.jpg
```

---

## 5. Form Validation Issues

### Issue: "The [field] field is required" but field is filled
**Cause**: Form field name doesn't match validation rule

**Solution**:
- Check form input name matches validation rule
- Verify form is using POST/PUT method
- Check CSRF token is included
- Clear browser cache and try again

---

### Issue: "Original price must be greater than sale price"
**Cause**: Original price is less than or equal to sale price

**Solution**:
- Ensure original price > sale price
- Example: Sale: 51530, Original: 64415 ✅
- Example: Sale: 51530, Original: 51530 ❌

---

## 6. Database Issues

### Issue: "SQLSTATE[HY000]: General error: 1366 Incorrect integer value..."
**Cause**: Invalid data type for field

**Solution**:
```bash
# Check field types in migration
# Ensure numeric fields receive numbers
# Ensure enum fields receive valid values

# Example valid category values: 'men', 'women', 'unisex', 'arabic'
```

---

### Issue: "Integrity constraint violation"
**Cause**: Foreign key or unique constraint violation

**Solution**:
```bash
# Check for duplicate entries
php artisan tinker
>>> Perfume::where('name', 'Emeraude Noire')->count()

# If duplicate, delete one
>>> Perfume::where('name', 'Emeraude Noire')->first()->delete()
```

---

## 7. Performance Issues

### Issue: Admin page loads slowly
**Cause**: Too many perfumes or missing indexes

**Solution**:
```bash
# Add indexes to frequently queried columns
# Edit migration and add:
$table->index('category');
$table->index('is_featured');
$table->index('sort_order');

# Then run migration
php artisan migrate
```

---

### Issue: Frontend page loads slowly
**Cause**: Large images or inefficient queries

**Solution**:
- Optimize images (compress before upload)
- Add pagination to limit perfumes displayed
- Use lazy loading for images
- Add database indexes

---

## 8. File Permission Issues

### Issue: "Permission denied" when uploading
**Cause**: Upload directory not writable

**Solution**:
```bash
# Check current permissions
ls -la public/uploads/

# Make directories writable
chmod 755 public/uploads/perfumes
chmod 755 public/uploads/perfume

# If still failing, try 777 (less secure)
chmod 777 public/uploads/perfumes
chmod 777 public/uploads/perfume

# Check web server user
ps aux | grep apache
ps aux | grep nginx

# Change ownership if needed
sudo chown -R www-data:www-data public/uploads/
```

---

## 9. Cache Issues

### Issue: Changes not appearing after update
**Cause**: Laravel cache not cleared

**Solution**:
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Or use single command
php artisan optimize:clear
```

---

## 10. Model/Controller Issues

### Issue: "Class not found" error
**Cause**: Model or controller not imported or doesn't exist

**Solution**:
```bash
# Verify file exists
ls app/Models/Perfume.php
ls app/Http/Controllers/Apps/PerfumePageController.php

# Check namespace in file
# Should be: namespace App\Models;
# Should be: namespace App\Http\Controllers\Apps;

# Verify import in controller
use App\Models\Perfume;
use App\Models\PerfumePage;
```

---

## 11. Route Issues

### Issue: "Route not defined" error
**Cause**: Route name incorrect or not registered

**Solution**:
```bash
# List all routes
php artisan route:list

# Search for perfume routes
php artisan route:list | grep perfume

# Verify route names in code
# Should be: route('admin.perfume-page.index')
# Should be: route('admin.perfume-page.store-perfume')
```

---

## 12. Blade Template Issues

### Issue: "Undefined variable" error
**Cause**: Variable not passed from controller to view

**Solution**:
```php
// In controller, ensure variables are passed
return view('admin.perfume-page.index', compact('perfumePage', 'perfumes'));

// In view, check variable name matches
{{ $perfumePage->hero_heading }}
{{ $perfumes->count() }}
```

---

## 13. JavaScript Issues

### Issue: Show More button not working
**Cause**: JavaScript error or selector mismatch

**Solution**:
```bash
# Check browser console for errors
# Open DevTools: F12 or Ctrl+Shift+I
# Look for red error messages

# Verify button ID matches JavaScript
# Button ID: id="perfumesShowMoreBtn"
# JavaScript: document.getElementById('perfumesShowMoreBtn')

# Check if JavaScript is loaded
# Verify script tag is in view
```

---

## 14. Seeder Issues

### Issue: "Class not found" when running seeder
**Cause**: Seeder file not found or namespace incorrect

**Solution**:
```bash
# Verify seeder file exists
ls database/seeders/PerfumeSeeder.php

# Check namespace
# Should be: namespace Database\Seeders;

# Run seeder with correct class name
php artisan db:seed --class=PerfumeSeeder

# Or run all seeders
php artisan db:seed
```

---

## 15. Environment Issues

### Issue: ".env file not found"
**Cause**: Environment file missing

**Solution**:
```bash
# Copy example env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Update database credentials
# Edit .env and set:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

---

## 🆘 Still Having Issues?

### Debug Steps
1. **Check Laravel logs**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Use Tinker for debugging**
   ```bash
   php artisan tinker
   >>> Perfume::all()
   >>> PerfumePage::first()
   ```

3. **Check database directly**
   ```bash
   mysql -u user -p database_name
   SELECT * FROM perfumes;
   SELECT * FROM perfume_pages;
   ```

4. **Verify file permissions**
   ```bash
   ls -la app/Models/
   ls -la app/Http/Controllers/Apps/
   ls -la resources/views/admin/perfume-page/
   ```

5. **Check web server logs**
   ```bash
   # Apache
   tail -f /var/log/apache2/error.log
   
   # Nginx
   tail -f /var/log/nginx/error.log
   ```

---

## 📞 Getting Help

If you're still stuck:

1. **Check documentation**
   - PERFUME_PAGE_SETUP.md
   - PERFUME_PAGE_QUICK_START.md
   - ADMIN_INTERFACE_GUIDE.md

2. **Review code comments**
   - Check controller comments
   - Check view comments
   - Check model comments

3. **Search Laravel docs**
   - https://laravel.com/docs
   - https://laravel.com/docs/migrations
   - https://laravel.com/docs/eloquent

4. **Check error messages carefully**
   - Read full error message
   - Note line number and file
   - Search for specific error

---

## ✅ Verification Checklist

After troubleshooting, verify:

- [ ] Migrations ran successfully
- [ ] Upload directories exist and are writable
- [ ] Admin can access `/admin/perfume-page`
- [ ] Can add perfume without errors
- [ ] Images upload successfully
- [ ] Perfumes appear on `/perfumes` page
- [ ] Frontend page is responsive
- [ ] All links work correctly
- [ ] No console errors in browser
- [ ] No errors in Laravel logs

---

**Good luck! You've got this!** 🚀
