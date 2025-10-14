# Pricing Update Guide for Golf Club Builders

## Overview
This guide explains how to update pricing across the Golf Club Builders website. Pricing appears in multiple locations and must be updated in both backend controllers and frontend views.

---

## 🏗️ CLUB BUILDS PRICING

### Files to Update:

**1. Main Display & Calculator**
- **File:** `app/Views/club-builds/index.php`
- **Lines to update:**
  - Initial display prices (around lines 26, 34, 42, 62, 70, 78)
  - JavaScript calculations (around lines 214-220 and 237-239)

**Current Prices:**
```
Iron Shaft Installation: $21.99/club
Metalwood/Hybrid Installation: $24.99/club
Shaft Adapter Installation: $17.99/adapter
Grip Install (bring your grips): $3.99/club
Grip Install (with purchase): $3.99/club + grip
Save & Reinstall Old Grip: $7.99/club
Old Club Polishing: $20.00/club
```

**How to Update:**
1. Search for current price (e.g., "21.99")
2. Update the HTML display: `<span id="iron-price">21.99</span>`
3. Update JavaScript calculation: `21.99 * multiplier`
4. Update total calculation: `ironCount * 21.99`

**Emergency/Rush Pricing:**
- Automatically calculated at 50% markup
- No need to update separately

---

## 🎯 FITTING PRICING

### Files to Update:

**1. Fitting Controller (Backend)**
- **File:** `app/Controllers/Fitting.php`
- **Function:** `getRepairPricing()` (around line 35)

**Current Prices:**
```php
'loft_lie' => ['standard' => 5.00, 'rush' => 7.50, 'set_8' => [35, 52.50]],
'shaft_pull' => ['standard' => 9.99, 'rush' => 14.99],
'adapter_install' => ['standard' => 17.99, 'rush' => 26.99],
'reinstall_shaft' => ['standard' => 15.00, 'rush' => 22.50],
'swing_weight_standard' => ['standard' => 10.00, 'rush' => 15.00],
'shorten_shaft' => ['standard' => 6.00, 'rush' => 9.00],
'lengthen_shaft' => ['standard' => 6.00, 'rush' => 9.00],
'lengthen_with_grip' => ['standard' => 16.00, 'rush' => 24.00],
```

**How to Update:**
1. Open `app/Controllers/Fitting.php`
2. Find `getRepairPricing()` function
3. Update prices in the array
4. Rush prices are typically 1.5x standard

**2. Fitting Packages (if applicable)**
- Basic Fitting: $75 (90 minutes)
- Premium Fitting: $150 (2 hours)
- Update these in the fitting view or controller as needed

---

## 🏌️ SIMULATOR PRICING

### Files to Update:

**1. Simulator Controller (Backend)**
- **File:** `app/Controllers/Simulator.php`
- **Function:** `getPricingData()` (around line 21)

**Current Tiered Structure:**
```php
// Weekday Daytime (9am-5pm)
'weekday_day_hourly' => 20.00,
'weekday_day_4hr' => 75.00,
'weekday_day_8hr' => 140.00,

// Weekday Evening (5pm-close)
'weekday_evening_hourly' => 40.00,
'weekday_evening_4hr' => 140.00,
'weekday_evening_8hr' => 250.00,

// Weekend (All Day)
'weekend_hourly' => 50.00,
'weekend_4hr' => 175.00,
'weekend_8hr' => 300.00,
```

**2. Simulator View (Frontend Display)**
- **File:** `app/Views/simulator/index.php`
- **Update the pricing table** (around lines 160-192)
- **Update quick booking cards** (around lines 223-260)

**How to Update:**
1. Update controller prices first
2. Update the HTML pricing table to match
3. Update the "Quick Booking" price ranges
4. Keep legacy fields for backward compatibility

---

## 🏠 HOME PAGE CALLOUTS

### File to Update:

**File:** `app/Views/home/index.php`

**Locations:**
1. **Custom Club Building** (around line 36):
   ```html
   <p><strong>Starting at $21.99</strong> | Emergency +50%</p>
   ```

2. **Simulator Rental** (around line 44):
   ```html
   <p><strong>From $20/hour</strong> | Half/Full day rates available</p>
   ```

3. **AI Club & Shaft Fitting** (around line 52):
   ```html
   <p><strong>Starting at $75</strong> | 90 minutes</p>
   ```

---

## ✅ TESTING CHECKLIST

After updating pricing:

### 1. **Club Builds Page**
- [ ] Initial prices display correctly
- [ ] Prices update when Rush toggle is switched
- [ ] Total calculation is correct
- [ ] Add to Cart works
- [ ] Prices match in pricing table

### 2. **Fitting Page**
- [ ] All repair prices display correctly
- [ ] 8-club set pricing is correct
- [ ] Rush prices are correct (usually 1.5x)

### 3. **Simulator Page**
- [ ] Pricing table shows all three tiers correctly
- [ ] Quick booking cards show price ranges
- [ ] Add to Cart buttons work
- [ ] Capacity note is visible

### 4. **Home Page**
- [ ] All three service callouts show correct starting prices
- [ ] Links work correctly

### 5. **Browser Testing**
- [ ] Hard refresh to clear cache (Cmd+Shift+R)
- [ ] Test on different browsers
- [ ] Check mobile view

---

## 📋 QUICK REFERENCE - CURRENT PRICING

### Club Builds
| Service | Price |
|---------|-------|
| Iron Shaft | $21.99 |
| Metalwood/Hybrid | $24.99 |
| Shaft Adapter | $17.99 |
| Grip Install | $3.99 |
| Save & Reinstall Grip | $7.99 |

### Fitting
| Service | Standard | Rush |
|---------|----------|------|
| Loft/Lie (per club) | $5.00 | $7.50 |
| Loft/Lie (8-club set) | $35.00 | $52.50 |
| Shaft Pull | $9.99 | $14.99 |
| Adapter Install | $17.99 | $26.99 |
| Reinstall Shaft | $15.00 | $22.50 |
| Swing Weight | $10.00 | $15.00 |

### Simulator
| Time | Weekday Day | Weekday Evening | Weekend |
|------|-------------|-----------------|---------|
| Hourly | $20 | $40 | $50 |
| 4 Hours | $75 | $140 | $175 |
| 8 Hours | $140 | $250 | $300 |

**Weekday Day:** 9am-5pm Mon-Fri  
**Weekday Evening:** 5pm-close Mon-Fri  
**Weekend:** All day Sat-Sun  
**Capacity:** Up to 8 guests (6 comfortably)

---

## 🚨 IMPORTANT NOTES

1. **Update ALL locations** - Prices appear in multiple files
2. **Test calculators** - Make sure JavaScript calculations use new prices
3. **Clear browser cache** - Always hard refresh after changes
4. **Rush pricing** - Usually 1.5x standard, check if auto-calculated
5. **Commit changes** - Git commit with clear message about pricing update
6. **Deploy to live** - Push to GitHub, then deploy to production server

---

## 🔧 COMMON TASKS

### To Change Club Build Price:
1. Open `app/Views/club-builds/index.php`
2. Find the service (e.g., Iron Shaft)
3. Update initial display: `<span id="iron-price">NEW_PRICE</span>`
4. Update JavaScript: `(NEW_PRICE * multiplier)`
5. Update calculation: `ironCount * NEW_PRICE`

### To Change Simulator Price:
1. Open `app/Controllers/Simulator.php`
2. Update `getPricingData()` array
3. Open `app/Views/simulator/index.php`
4. Update pricing table HTML
5. Update quick booking card price ranges

### To Change Fitting Price:
1. Open `app/Controllers/Fitting.php`
2. Update `getRepairPricing()` array
3. Prices auto-populate in the view via PHP

---

## 📞 SUPPORT

If prices don't update after hard refresh:
- Check browser console (F12) for JavaScript errors
- Verify file was saved correctly
- Clear all browser data
- Try incognito/private window

Last Updated: October 14, 2025

