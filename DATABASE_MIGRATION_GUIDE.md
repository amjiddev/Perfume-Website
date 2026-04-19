# Database Migration Guide - Change from Uni_project to perfume

## 🔧 Step-by-Step Instructions

### Step 1: Create New Database
Open your MySQL client (phpMyAdmin, MySQL Workbench, or command line) and create a new database:

**Using phpMyAdmin:**
1. Open phpMyAdmin in your browser
2. Click "New" on the left sidebar
3. Database name: `perfume`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

**Using MySQL Command Line:**
```sql
CREATE DATABASE perfume CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Using MySQL Workbench:**
1. Right-click on "Schemas"
2. Select "Create Schema"
3. Name: `perfume`
4. Click "Apply"

---

### Step 2: Update .env File
✅ **Already Done!** Your `.env` file has been updated:
```
DB_DATABASE=perfume
```

---

### Step 3: Clear Laravel Cache
Run these commands in your terminal:

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

### Step 4: Run Migrations
Run the migrations to create all tables:

```bash
php artisan migrate
```

**Expected Output:**
```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrating: 2014_10_12_100000_create_password_resets_table
...
Migrating: 2024_04_10_create_perfumes_table
Migrating: 2024_04_10_create_perfume_pages_table
Migrated:  2024_04_10_create_perfumes_table (0.05 seconds)
Migrated:  2024_04_10_create_perfume_pages_table (0.05 seconds)
```

---

### Step 5: Seed Sample Data (Optional)
To populate sample perfume data:

```bash
php artisan db:seed --class=PerfumeSeeder
```

---

### Step 6: Verify Tables Created
Check that tables were created successfully:

**Using phpMyAdmin:**
1. Select `perfume` database
2. You should see tables including:
   - `perfumes`
   - `perfume_pages`
   - `users`
   - `migrations`
   - etc.

**Using MySQL Command Line:**
```sql
USE perfume;
SHOW TABLES;
```

**Expected tables:**
```
migrations
users
password_resets
perfumes
perfume_pages
```

---

## ✅ Verification Checklist

- [ ] New database `perfume` created
- [ ] `.env` file updated with `DB_DATABASE=perfume`
- [ ] Cache cleared
- [ ] Migrations ran successfully
- [ ] Tables visible in database
- [ ] No errors in terminal

---

## 🚀 Next Steps

1. **Access Admin Panel**
   ```
   Navigate to: http://localhost:8000/admin/perfume-page
   ```

2. **Add Perfumes**
   - Click "Add Perfume"
   - Fill in details
   - Upload image
   - Click "Add Perfume"

3. **View Frontend**
   ```
   Navigate to: http://localhost:8000/perfumes
   ```

---

## 🆘 Troubleshooting

### Issue: "Access denied for user 'root'@'localhost'"
**Solution:**
- Check MySQL is running
- Verify username and password in `.env`
- Ensure MySQL service is started

### Issue: "Database 'perfume' doesn't exist"
**Solution:**
- Create database manually (see Step 1)
- Verify database name in `.env` is correct
- Clear cache: `php artisan config:clear`

### Issue: "Table 'perfume.perfume_pages' doesn't exist"
**Solution:**
- Run migrations: `php artisan migrate`
- Check for migration errors
- Verify database connection

### Issue: "SQLSTATE[HY000]: General error"
**Solution:**
```bash
# Clear cache
php artisan optimize:clear

# Run migrations fresh (WARNING: deletes all data)
php artisan migrate:fresh

# Seed sample data
php artisan db:seed --class=PerfumeSeeder
```

---

## 📝 Commands Summary

```bash
# Create database (manual step)
# CREATE DATABASE perfume;

# Clear cache
php artisan optimize:clear

# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed --class=PerfumeSeeder

# Check migrations status
php artisan migrate:status

# Rollback migrations (if needed)
php artisan migrate:rollback

# Fresh migration (WARNING: deletes all data)
php artisan migrate:fresh --seed
```

---

## 📍 Important Notes

1. **Database Name**: Changed from `Uni_project` to `perfume`
2. **All existing data** in `Uni_project` will NOT be migrated
3. **New database** `perfume` will be created fresh
4. **Migrations** will create all necessary tables
5. **Sample data** can be seeded with PerfumeSeeder

---

**You're all set! Follow the steps above and your database will be ready.** ✅
