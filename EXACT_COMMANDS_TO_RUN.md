# 🎯 Exact Commands to Run - Copy & Paste

## Step 1: Create Database

### Using MySQL Command Line
```bash
mysql -u root -p
```

Then paste this:
```sql
CREATE DATABASE perfume CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Or Using phpMyAdmin
1. Open: `http://localhost/phpmyadmin`
2. Click "New"
3. Database name: `perfume`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

---

## Step 2: Clear Cache

Copy and paste this command:

```bash
php artisan optimize:clear
```

Or if that doesn't work, run these individually:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Step 3: Run Migrations

Copy and paste this command:

```bash
php artisan migrate
```

**Expected output:**
```
Migrating: 2014_10_12_000000_create_users_table
Migrating: 2014_10_12_100000_create_password_resets_table
...
Migrating: 2024_04_10_create_perfumes_table
Migrating: 2024_04_10_create_perfume_pages_table
Migrated:  2024_04_10_create_perfumes_table (0.05 seconds)
Migrated:  2024_04_10_create_perfume_pages_table (0.05 seconds)
```

---

## Step 4: Create Upload Directories

Copy and paste this command:

```bash
mkdir -p public/uploads/perfumes public/uploads/perfume && chmod 755 public/uploads/perfumes public/uploads/perfume
```

---

## Step 5: Seed Sample Data (Optional)

Copy and paste this command:

```bash
php artisan db:seed --class=PerfumeSeeder
```

---

## All Commands in One Block

If you want to run everything at once (after creating database):

```bash
php artisan optimize:clear && php artisan migrate && mkdir -p public/uploads/perfumes public/uploads/perfume && chmod 755 public/uploads/perfumes public/uploads/perfume && php artisan db:seed --class=PerfumeSeeder
```

---

## Verify Everything Works

### Check Database Tables
```bash
php artisan tinker
```

Then paste:
```php
DB::table('perfumes')->count()
DB::table('perfume_pages')->count()
exit()
```

### Check Routes
```bash
php artisan route:list | grep perfume
```

---

## Access Your Pages

### Admin Panel
```
http://localhost:8000/admin/perfume-page
```

### Frontend Page
```
http://localhost:8000/perfumes
```

---

## If Something Goes Wrong

### Clear Everything and Start Fresh
```bash
php artisan migrate:rollback
php artisan migrate:fresh
php artisan db:seed --class=PerfumeSeeder
```

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Check Database Connection
```bash
php artisan tinker
DB::connection()->getPdo()
exit()
```

---

## Windows Users

If you're on Windows and `mkdir` doesn't work, use:

```bash
mkdir public\uploads\perfumes
mkdir public\uploads\perfume
```

Or use PowerShell:
```powershell
New-Item -ItemType Directory -Path "public/uploads/perfumes" -Force
New-Item -ItemType Directory -Path "public/uploads/perfume" -Force
```

---

## Mac/Linux Users

If you get permission errors:

```bash
sudo mkdir -p public/uploads/perfumes
sudo mkdir -p public/uploads/perfume
sudo chmod 755 public/uploads/perfumes
sudo chmod 755 public/uploads/perfume
```

---

## Troubleshooting Commands

### If migrations fail
```bash
php artisan migrate:status
php artisan migrate --verbose
```

### If database connection fails
```bash
php artisan config:clear
php artisan cache:clear
```

### If routes not found
```bash
php artisan route:clear
php artisan route:cache
```

### If views not updating
```bash
php artisan view:clear
```

---

## Summary

**Minimum commands needed:**

1. Create database `perfume` in MySQL
2. `php artisan optimize:clear`
3. `php artisan migrate`
4. `mkdir -p public/uploads/perfumes public/uploads/perfume`

**Then access:**
- Admin: `http://localhost:8000/admin/perfume-page`
- Frontend: `http://localhost:8000/perfumes`

---

**That's it! You're ready to go!** 🚀
