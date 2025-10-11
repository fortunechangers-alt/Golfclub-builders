# Admin Access Control Setup

## Overview

The admin access control system has been implemented with the following features:

1. ✅ `is_admin` field added to the `users` table (default = 0)
2. ✅ Admin filter to restrict admin panel access
3. ✅ View toggle system for admins to switch between customer and admin views
4. ✅ Toggle button only visible to users with `is_admin = 1`

---

## How It Works

### User Access Levels

- **Regular Users** (`is_admin = 0`):
  - Can access customer-facing pages
  - Cannot access `/admin/*` routes
  - Redirected to homepage with error message if they try to access admin panel

- **Admin Users** (`is_admin = 1`):
  - Can access both customer and admin areas
  - Can toggle between "Admin View" and "Customer View"
  - Start in customer view when logging in
  - Have a "Switch to Admin View" button in the navbar

---

## Setting a User as Admin

### Option 1: Using MySQL Command Line

```bash
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 1 WHERE id = 1;"
```

### Option 2: Using PHP Spark CLI

```bash
cd /Users/willisfamily/Movies/CacheClip/audio/Applications/XAMPP/xamppfiles/htdocs/Projects/golf_builders_2
php spark db:query "UPDATE users SET is_admin = 1 WHERE id = 1"
```

### Option 3: Using phpMyAdmin

1. Open phpMyAdmin at `http://localhost/phpmyadmin`
2. Select the `golf_builders` database
3. Click on the `users` table
4. Find the user you want to make admin
5. Edit the row and set `is_admin` to `1`
6. Save changes

### Option 4: Using a SQL Query in phpMyAdmin

```sql
UPDATE users SET is_admin = 1 WHERE username = 'admin';
```

---

## How to Use the Admin View Toggle

### For Admin Users:

1. **Login** to your account (must have `is_admin = 1`)

2. **You'll start in Customer View** - you'll see the customer-facing website with all normal menu items

3. **In the navbar**, you'll see a button: **"🔄 Switch to Admin View"**

4. **Click the toggle button** to switch to Admin View

5. **In Admin View**, you'll see:
   - The admin sidebar with all management options
   - Dashboard, Bookings, Calendar, Products, Orders, etc.
   - A **"🔄 Switch to Customer View"** button in the admin sidebar

6. **Click the toggle button again** to return to Customer View

### Benefits:

- Admins can make changes in the admin panel
- Then quickly toggle to customer view to see how those changes look to customers
- No need to log out and back in
- Seamless switching between views

---

## Current Admin Users

To see who is currently set as admin:

```bash
php spark db:query "SELECT id, username, active, is_admin FROM users"
```

Or using MySQL:

```bash
mysql -u root -e "SELECT id, username, active, is_admin FROM golf_builders.users;"
```

---

## Making Your First Admin

Based on your current users table, you can make user #1 (admin) an admin:

```bash
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 1 WHERE id = 1;"
```

Or if you want to make all active users admins for testing:

```bash
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 1 WHERE active = 1;"
```

---

## Security Notes

1. **Never set `is_admin = 1` for untrusted users**
2. **The `is_admin` field is separate from Shield groups/permissions** - this is a simple flag for this specific admin panel
3. **Regular users cannot access `/admin/*` routes** - they'll be redirected with an error message
4. **Non-logged-in users are redirected to `/login`** when trying to access admin routes
5. **The admin filter checks both login status and `is_admin` flag**

---

## Files Modified

| File | Purpose |
|------|---------|
| `app/Filters/AdminFilter.php` | New filter to check `is_admin = 1` |
| `app/Controllers/ToggleView.php` | Handles view switching |
| `app/Config/Filters.php` | Registers the admin filter |
| `app/Config/Routes.php` | Admin routes now use admin filter |
| `app/Views/layout/header.php` | Shows toggle button for admins (customer view) |
| `app/Views/admin/layout/header.php` | Shows toggle button for admins (admin view) |
| `app/Models/UserModel.php` | Added `is_admin` to allowed fields |

---

## Troubleshooting

### "You do not have permission to access the admin area"

- Check if your user has `is_admin = 1` in the database
- Run: `php spark db:query "SELECT id, username, is_admin FROM users WHERE id = YOUR_USER_ID"`
- If `is_admin = 0`, update it to `1`

### Toggle button not showing

- Make sure you're logged in
- Check that your user has `is_admin = 1`
- Clear your browser cache and session cookies
- Try logging out and back in

### Can't access admin panel after clicking toggle

- Check if the user has `is_admin = 1`
- Check browser console for JavaScript errors
- Check CodeIgniter logs in `writable/logs/`

---

## Next Steps

1. **Set your primary admin user**:
   ```bash
   mysql -u root -e "UPDATE golf_builders.users SET is_admin = 1 WHERE id = 1;"
   ```

2. **Test the login and toggle**:
   - Go to `/login`
   - Login with admin credentials
   - Click "Switch to Admin View"
   - Navigate around admin panel
   - Click "Switch to Customer View"
   - Verify you're back in customer view

3. **Update other admin users as needed**

4. **Consider adding a user management page** in the admin panel to manage `is_admin` status (future enhancement)

---

## Future Enhancements

Consider adding:
- Admin user management interface (instead of manually editing database)
- Activity logging for admin actions
- Email notifications when users are granted admin access
- Two-factor authentication for admin accounts
- Admin role levels (super admin, admin, moderator, etc.)

