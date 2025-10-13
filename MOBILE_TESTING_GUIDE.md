# Mobile Testing Guide

## How to Test the Mobile Changes

### Method 1: Browser DevTools (Easiest)

1. **Open your site in Chrome/Firefox/Safari**
2. **Press F12** (or right-click → Inspect)
3. **Click the device toggle button** (looks like a phone/tablet icon)
4. **Select a mobile device** from the dropdown:
   - iPhone 12/13/14
   - iPhone SE (small screen)
   - Pixel 5
   - Samsung Galaxy S20
5. **Refresh the page** to see mobile layout

### Method 2: Resize Browser Window

1. **Open your site**
2. **Make the browser window narrow** (less than 768px wide)
3. **You should see:**
   - Hamburger menu appears
   - Logo gets smaller
   - Layout changes to mobile

### Method 3: Actual Mobile Device

1. **Open your site on your phone**
2. **Navigate to different pages**
3. **Test the experience**

---

## What to Look For

### ✅ Homepage (Mobile)
- Logo is smaller (fits in header)
- Hamburger menu visible (top right)
- Click hamburger → menu slides down
- Service cards stack vertically
- Buttons are full-width
- Hero text readable

### ✅ Checkout Page (Mobile)
- Cart items display in vertical list
- Quantity buttons don't overflow
- Form fields stack (single column)
- All buttons full-width
- Emergency notice readable
- Easy to scroll through

### ✅ Booking Page (Mobile)
- Service cards one per row
- Calendar takes full width
- Time slots in 2 columns
- Date and time sections stack
- Form fields single column
- Easy to tap time slots

### ✅ Navigation (Mobile)
- Hamburger icon visible
- Click → menu opens
- Click X → menu closes
- Click link → menu closes automatically
- Cart icon visible and working

---

## Desktop Verification

**Switch to desktop view (> 768px width):**

### ✅ Should Look EXACTLY the Same
- Logo full size (80px)
- Navigation horizontal
- NO hamburger button
- Multi-column forms
- Side-by-side layouts
- Original button sizes
- Everything as before

---

## Common Issues & Solutions

### Issue: Mobile styles showing on desktop
**Solution:** Clear browser cache (Ctrl+Shift+Delete)

### Issue: Hamburger menu not working
**Solution:** Check browser console for errors, ensure main.js loaded

### Issue: Layout looks broken
**Solution:** Hard refresh (Ctrl+Shift+R or Cmd+Shift+R)

### Issue: Changes not appearing
**Solution:** Clear cache, check CSS file saved properly

---

## Mobile Breakpoints

| Screen Width | What Happens |
|-------------|--------------|
| **> 768px** | Desktop layout (unchanged) |
| **480px - 768px** | Mobile layout (tablet/phone) |
| **< 480px** | Extra small mobile (smaller fonts, tighter spacing) |

---

## Test Pages Checklist

- [ ] Homepage (`/`)
- [ ] Cart/Checkout (`/cart`)
- [ ] Booking (`/booking`)
- [ ] Custom Club Building (`/custom-club-building`)
- [ ] Fitting (`/fitting`)
- [ ] Simulator (`/simulator`)
- [ ] Blog (`/blog`)
- [ ] Contact (`/contact`)

---

## Quick Mobile Test (5 minutes)

1. **Open site on phone**
2. **Click hamburger menu** → Does it open?
3. **Go to /cart** → Does it look good?
4. **Go to /booking** → Can you select date/time?
5. **Try adding to cart** → Does it work?

**If all 5 work → You're good! ✅**

---

## Performance Check

Mobile should be:
- **Fast** - No lag when opening menu
- **Smooth** - Animations work well
- **Responsive** - Touch targets easy to hit
- **Readable** - No tiny text

---

## Before/After Comparison

### BEFORE (Mobile)
- ❌ Logo stretched full width
- ❌ Navigation menu hidden, no way to access
- ❌ Checkout items overflow horizontally
- ❌ Forms cramped in multiple columns
- ❌ Buttons too small to tap
- ❌ Text too small to read
- ❌ Booking calendar unusable

### AFTER (Mobile)
- ✅ Logo sized appropriately
- ✅ Hamburger menu provides access to all pages
- ✅ Checkout items stack vertically
- ✅ Forms single column, easy to fill
- ✅ Buttons full-width, easy to tap
- ✅ Text properly sized
- ✅ Booking calendar touch-friendly

---

## Need Help?

1. **Check browser console** (F12 → Console tab)
2. **Check mobile device width** (are you actually under 768px?)
3. **Clear cache** (it fixes 90% of issues)
4. **Hard refresh** (Ctrl+Shift+R)

---

✅ **Your mobile site is now fully functional while keeping your desktop layout exactly as it was!**

