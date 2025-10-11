# 📋 Quick Reference Card - Admin Access Control

## 🔑 Current Admin Users

| ID | Username | is_admin | Status |
|----|----------|----------|--------|
| 1  | admin    | 1 ✅     | Active |
| 3  | testadmin | 1 ✅    | Active |
| 4  | Fortunechangers | 1 ✅ | Active |

---

## 🛠️ Common Commands

### Make User Admin
```bash
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 1 WHERE id = USER_ID;"
```

### Remove Admin Access
```bash
mysql -u root -e "UPDATE golf_builders.users SET is_admin = 0 WHERE id = USER_ID;"
```

### View All Users
```bash
cd /Users/willisfamily/Movies/CacheClip/audio/Applications/XAMPP/xamppfiles/htdocs/Projects/golf_builders_2
php spark db:table users
```

---

## 🌐 URLs

| URL | Purpose |
|-----|---------|
| `/login` | Login page |
| `/` | Homepage (customer view) |
| `/toggle-view` | Switch between views (admins only) |
| `/admin` | Admin dashboard (admins only) |

---

## 🎯 How It Works

### Login Behavior
- ✅ All users → Homepage (customer view)
- ✅ Admins see toggle button
- ✅ Regular users do NOT see toggle button

### Access Control
- `is_admin = 0` → ❌ Cannot access `/admin/*`
- `is_admin = 1` → ✅ Can access `/admin/*` when toggled

---

## 🔄 Toggle Button Location

### Customer View
**Location**: Top navigation bar (right side)
**Text**: "🔄 Switch to Admin View"
**Color**: Blue (primary)

### Admin View
**Location**: Left sidebar (bottom)
**Text**: "🔄 Switch to Customer View"
**Color**: White on dark background

---

## 🚨 Troubleshooting

### Toggle button not showing?
1. Check `is_admin = 1` in database
2. Log out and log back in
3. Clear browser cache

### Can't access admin panel?
1. Verify `is_admin = 1`
2. Check if logged in
3. Try accessing `/toggle-view` directly

### Still redirects to admin after login?
1. Clear session cookies
2. Check `app/Config/Auth.php` (should redirect to `/`)
3. Restart Apache

---

## 📂 Key Files

| File | Purpose |
|------|---------|
| `app/Filters/AdminFilter.php` | Access control |
| `app/Controllers/ToggleView.php` | View switching |
| `app/Config/Routes.php` | Route definitions |
| `app/Config/Auth.php` | Login redirects |
| `app/Config/Events.php` | Login event handler |
| `app/Views/layout/header.php` | Customer view navbar |
| `app/Views/admin/layout/header.php` | Admin view sidebar |

---

## 🔒 Security Checklist

- ✅ Only `is_admin = 1` can access admin routes
- ✅ Must be logged in to toggle views
- ✅ New users default to `is_admin = 0`
- ✅ All admin routes protected by filter
- ✅ View mode stored in session (secure)

---

## 📞 Quick Help

**Problem**: Regular user accessing `/admin`
**Solution**: Redirect to `/` with error message

**Problem**: Admin not seeing toggle button
**Solution**: Check `is_admin = 1` in database

**Problem**: Admin starts in admin view after login
**Solution**: Check `Events.php` sets `view_mode = 'customer'`

---

## 🎓 Usage Tips

1. **Always start in customer view** - See what customers see
2. **Toggle to admin** - Make changes
3. **Toggle back to customer** - Verify changes
4. **Repeat as needed** - No limit on toggles

---

## 📚 Documentation

- **ADMIN_ACCESS_SETUP.md** - Full setup guide
- **TESTING_ADMIN_ACCESS.md** - Testing instructions  
- **ADMIN_TOGGLE_COMPLETE.md** - Implementation summary
- **VISUAL_GUIDE.md** - Visual reference
- **QUICK_REFERENCE.md** - This card

---

**Last Updated**: October 11, 2025
**Status**: ✅ Production Ready

