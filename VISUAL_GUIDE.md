# 🎨 Visual Guide - Admin View Toggle

## What Users See

### 🔵 Regular User Experience (is_admin = 0)

**After Login - Navbar (Top Right):**
```
[ Home ] [ Services ] [ Shop ] [ Booking ] [ About ] [ Contact ] [ My Account ] [ Logout ]
```

- ❌ NO admin toggle button
- ✅ See "My Account" link
- ❌ Cannot access `/admin` routes

**If they try to access /admin:**
```
🚫 Error Message: "You do not have permission to access the admin area."
↩️  Redirected to: Homepage
```

---

### 🟢 Admin User Experience (is_admin = 1)

#### **After Login - Customer View (Default)**

**Navbar (Top Right):**
```
[ Home ] [ Services ] [ Shop ] [ Booking ] [ About ] [ Contact ] 
[ 🔄 Switch to Admin View ] [ Logout ]
                ↑
           TOGGLE BUTTON
         (Blue/Primary)
```

- ✅ Starts on homepage (customer view)
- ✅ See toggle button: **"🔄 Switch to Admin View"**
- ✅ Can browse like a regular customer
- ✅ Can click toggle to enter admin mode

---

#### **After Clicking "Switch to Admin View" - Admin Panel**

**Admin Sidebar (Left):**
```
┌─────────────────────────┐
│   Golf Club Builders    │
│      [Logo Image]       │
│      Admin Panel        │
├─────────────────────────┤
│ 📊 Dashboard            │
│ 📅 Bookings             │
│ 🗓️ Calendar Management  │
│ 🛍️ Products             │
│ 📦 Orders               │
│ 🕐 Business Hours       │
│ ⚙️ Settings             │
├─────────────────────────┤
│ 🔄 Switch to Customer   │ ← TOGGLE BUTTON
│    View                 │
├─────────────────────────┤
│ 🚪 Logout               │
└─────────────────────────┘
```

- ✅ Full admin panel with sidebar navigation
- ✅ Access to all admin features
- ✅ Toggle button: **"🔄 Switch to Customer View"**
- ✅ Can click toggle to return to customer view

---

## 🔄 Toggle Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                        ADMIN LOGIN                              │
│                            ↓                                    │
│                    (Redirect to /)                              │
│                            ↓                                    │
│                   ┌──────────────────┐                          │
│                   │  CUSTOMER VIEW   │ ← Default on login       │
│                   │   (Homepage)     │                          │
│                   └──────────────────┘                          │
│                            │                                    │
│              Click "Switch to Admin View"                       │
│                            ↓                                    │
│                   ┌──────────────────┐                          │
│                   │   ADMIN VIEW     │                          │
│                   │ (Admin Dashboard)│                          │
│                   └──────────────────┘                          │
│                            │                                    │
│           Click "Switch to Customer View"                       │
│                            ↓                                    │
│                   ┌──────────────────┐                          │
│                   │  CUSTOMER VIEW   │                          │
│                   │   (Homepage)     │                          │
│                   └──────────────────┘                          │
│                            │                                    │
│                         (Repeat)                                │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📱 Button Styles

### Customer View Toggle Button
```
┌────────────────────────────┐
│ 🔄 Switch to Admin View    │ ← Blue/Primary button
└────────────────────────────┘
```

### Admin View Toggle Button (Sidebar)
```
┌────────────────────────────┐
│ 🔄 Switch to Customer View │ ← White text on dark background
└────────────────────────────┘
```

---

## 🔐 Access Control Matrix

| User Type | is_admin | Can See Toggle? | Can Access /admin? | Starting View |
|-----------|----------|-----------------|-------------------|---------------|
| Guest (not logged in) | N/A | ❌ No | ❌ No (redirect to /login) | N/A |
| Regular User | 0 | ❌ No | ❌ No (error & redirect to /) | Customer |
| Admin User | 1 | ✅ Yes | ✅ Yes (when toggled) | Customer |

---

## 🎯 Key Features

### ✅ What Works:
1. **Default Customer View** - All users (including admins) see customer view after login
2. **Secure Access** - Only `is_admin = 1` users can access admin panel
3. **Easy Toggle** - Single click to switch between views
4. **Session-Based** - View preference remembered during session
5. **Visible Only to Admins** - Toggle button hidden from regular users
6. **Flexible** - Admins can switch unlimited times

### ✅ Security:
1. **Filter Protected** - `AdminFilter` checks every admin route
2. **Authentication Required** - Must be logged in to toggle
3. **Database Controlled** - `is_admin` must be set manually in database
4. **Default Safe** - New users are NOT admins by default
5. **No Bypass** - Cannot access admin routes without `is_admin = 1`

---

## 🧪 Quick Test Script

### Test 1: Regular User
```
1. Login as regular user
2. ✓ Should redirect to homepage
3. ✓ Should NOT see toggle button
4. Try to access: http://localhost:8080/admin
5. ✓ Should show error and redirect to homepage
```

### Test 2: Admin User
```
1. Login as admin
2. ✓ Should redirect to homepage (not admin panel)
3. ✓ Should see "Switch to Admin View" button
4. Click toggle button
5. ✓ Should redirect to /admin dashboard
6. ✓ Should see admin sidebar
7. ✓ Should see "Switch to Customer View" button
8. Click toggle button
9. ✓ Should redirect to homepage
10. ✓ Should see "Switch to Admin View" button again
```

---

## 📖 User Instructions

### For Admin Users:

**How to Switch to Admin View:**
1. Log in to your account
2. Look for the **blue button** in the top navigation bar
3. Click **"🔄 Switch to Admin View"**
4. You're now in the admin panel!

**How to Switch Back to Customer View:**
1. Look at the **left sidebar** in the admin panel
2. Find the **"🔄 Switch to Customer View"** link
3. Click it
4. You're back in customer view!

**Why Use This?**
- Make changes in admin panel
- Toggle to customer view to see how it looks
- No need to log out and back in
- Quick and easy switching

---

## 🎨 Customization Ideas

Want to customize the toggle button? Edit these files:

### Customer View Button (Navbar)
**File**: `app/Views/layout/header.php`
**Line**: ~44-46

```php
<li><a href="<?= base_url('/toggle-view') ?>" class="btn btn-primary" style="margin-right: 10px;">
    🔄 Switch to Admin View
</a></li>
```

### Admin View Button (Sidebar)
**File**: `app/Views/admin/layout/header.php`
**Line**: ~99-101

```php
<a href="<?= base_url('/toggle-view') ?>">
    🔄 Switch to Customer View
</a>
```

**You can change:**
- Button text
- Icon (emoji)
- Colors (CSS)
- Styling
- Position

---

## 🎉 Enjoy Your Admin Toggle!

The system is ready to use. Happy toggling! 🔄

