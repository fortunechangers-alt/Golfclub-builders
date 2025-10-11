# Testing Admin Access Control

## Quick Test Steps

### 1. Test as Regular User (is_admin = 0)

1. **Create a test regular user** (if you don't have one):
   ```bash
   # Go to http://localhost:8080/register
   # Create a new account
   ```

2. **Login as regular user**
   - Should redirect to homepage (customer view)
   - Should NOT see "Switch to Admin View" button
   - Should see "My Account" link

3. **Try to access admin panel**:
   ```
   Go to: http://localhost:8080/admin
   Expected: Redirect to homepage with error message "You do not have permission to access the admin area."
   ```

---

### 2. Test as Admin User (is_admin = 1)

Currently, these users are admins:
- User #1: `admin` (username: admin)
- User #3: `testadmin`
- User #4: `Fortunechangers`

1. **Login as admin**:
   ```
   Go to: http://localhost:8080/login
   Expected: Redirects to homepage (customer view) after login
   ```

2. **Check for toggle button**:
   ```
   Look in the navbar (top right)
   Expected: See button "🔄 Switch to Admin View"
   ```

3. **Click "Switch to Admin View"**:
   ```
   Expected: 
   - Redirects to /admin (admin dashboard)
   - See admin sidebar with all management options
   - See "🔄 Switch to Customer View" in admin sidebar
   ```

4. **Navigate around admin panel**:
   ```
   Try accessing:
   - /admin/bookings
   - /admin/calendar
   - /admin/products
   Expected: All pages load successfully
   ```

5. **Click "Switch to Customer View"**:
   ```
   Expected: 
   - Redirects to homepage (customer view)
   - See "🔄 Switch to Admin View" button again
   ```

---

## Test Results Checklist

- [ ] Regular users CANNOT access /admin routes
- [ ] Regular users do NOT see toggle button
- [ ] Admins CAN access /admin routes
- [ ] Admins start in customer view after login
- [ ] Toggle button shows only for admins
- [ ] Toggle button works to switch views
- [ ] Admin can navigate admin panel
- [ ] Admin can switch back to customer view

---

## Common Issues & Solutions

### Toggle button not showing?
- Clear browser cache and cookies
- Log out and log back in
- Check user has `is_admin = 1` in database

### Can't access admin panel?
- Check user has `is_admin = 1`
- Check if logged in
- Check browser console for errors

### Still redirects to admin after login?
- Clear session cookies
- Check `app/Config/Auth.php` - login redirect should be '/'
- Check `app/Config/Events.php` - should set view_mode to 'customer'

---

## Making More Admins

To make any user an admin:

```bash
# Replace USER_ID with the actual user ID
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 1 WHERE id = USER_ID;"
```

Or to make a user an admin by username:

```bash
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 1 WHERE username = 'username_here';"
```

To remove admin access:

```bash
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 0 WHERE id = USER_ID;"
```

---

## Security Verification

✅ **Access Control Works**: Non-admin users cannot access /admin routes
✅ **Filter Applied**: AdminFilter checks is_admin = 1 before allowing access
✅ **Login Required**: Non-logged-in users redirected to /login
✅ **Toggle Protected**: Only users with is_admin = 1 can toggle views
✅ **Default Safe**: New users have is_admin = 0 by default

---

## What's Next?

After testing, you can:
1. **Customize the toggle button styling** in the header files
2. **Add more admin features** to the admin panel
3. **Create user management page** to manage is_admin in the admin panel
4. **Add activity logging** for admin actions
5. **Enable 2FA for admin accounts** for extra security

