# 🎯 Soft Opening - Available Time Slots Guide

## Overview
Your booking system now has a **Soft Opening Mode** where:
- ✅ **All times are blocked by default**
- ✅ **You manually open specific time slots**
- ✅ **Customers only see the slots you've made available**
- ✅ **Perfect for controlled soft opening with introductory pricing**

---

## How It Works

### For Customers (Public)
- When they visit `/booking`, they can only see time slots that YOU have opened
- If no slots are available for a date, they'll see "No time slots available yet"
- They can only book the times you've specifically made available

### For You (Admin)
- You control 100% of which slots are bookable
- You can activate/deactivate slots without deleting them
- You can see how many bookings each slot has
- You can open multiple slots at once

---

## 📋 How to Use the System

### Step 1: Access the Admin Panel
1. Go to: `http://localhost:8080/admin/dashboard`
2. Click the gold button: **"🎯 Manage Available Slots (Soft Opening)"**
3. Or navigate directly to: `http://localhost:8080/admin/available-slots`

### Step 2: Open New Time Slots
1. Click **"➕ Open New Slots"**
2. Fill out the form:
   - **Select Service**: Which service (AI Club Fitting, etc.)
   - **Start Date**: First date to open
   - **End Date**: Last date to open
   - **Time Slots**: Check which times (helpful buttons: Morning, Afternoon, Select All)
   - **Notes**: Optional (e.g., "Soft opening - intro pricing")
3. Click **"✓ Create Available Slots"**

### Step 3: Manage Your Slots
On the main slots page, you can:
- **View all opened slots** grouped by date
- **Filter** by month or service
- **Activate/Deactivate** slots (⏸ button)
- **Delete** slots that haven't been booked yet (🗑 button)
- See **booking status** (how many bookings per slot)

---

## 💡 Common Use Cases

### Opening Your First Week
```
1. Go to "Open New Slots"
2. Service: AI Club Fitting
3. Dates: Next Monday - Next Friday
4. Click "Morning" button (9 AM - 12 PM slots)
5. Notes: "Soft opening week 1 - $149 intro price"
6. Save!
```

### Opening Specific Days Only
```
1. Set Start Date = End Date (same day)
2. Select specific times
3. Repeat for each day you want
```

### Temporarily Closing a Slot
```
1. Find the slot in the list
2. Click "⏸ Deactivate"
3. It stays in your system but customers can't see it
4. Click "▶️ Activate" to open it again
```

---

## 📊 Dashboard Stats

The main page shows:
- **Total Slots Open**: How many time slots you've created
- **Active Slots**: How many are currently bookable
- **Current Bookings**: Total bookings in the system
- **Fully Booked**: How many slots are at capacity

---

## 🎨 Slot Status Colors

- **Green border** = Active slot
- **Gray background** = Inactive slot
- **Red background** = Fully booked
- **Green text** = Available bookings

---

## 🔄 Workflow for Soft Opening

### Week-by-Week Approach
1. **Week 1**: Open only 3 slots per day (limited testing)
2. **Week 2**: If going well, open 5 slots per day
3. **Week 3**: Open 8 slots per day
4. **Week 4**: Open more times, adjust based on demand

### Gradual Pricing Increase
1. **First 50 bookings**: $149 (add note: "Early bird")
2. **Next 50**: $179 (note: "Intro price")
3. **After that**: $199 (note: "Regular price")

---

## ⚠️ Important Notes

### Slots vs Bookings
- **Available Slots** = Times you've opened for booking
- **Bookings** = Actual customer reservations
- You manage slots, customers create bookings

### Deleting Slots
- You can only delete slots that **haven't been booked**
- If a slot has bookings, deactivate it instead
- This protects existing customer reservations

### Fully Booked Slots
- Shows as red background
- Stays in your list so you can track it
- Automatically hidden from customers
- You can see the booking count (1/1 means full)

---

## 🚀 Quick Start Checklist

- [ ] Access admin panel: `/admin/dashboard`
- [ ] Click "Manage Available Slots"
- [ ] Open your first batch of slots
- [ ] Test booking as a customer: `/booking`
- [ ] Confirm customer sees ONLY your opened slots
- [ ] Monitor bookings and add more slots as needed

---

## 📞 Tips

1. **Start small**: Open just a few slots first to test everything
2. **Add notes**: Use notes field to track pricing or special info
3. **Filter by service**: If you have multiple services, filter to see each one
4. **Check daily**: Review your slots and bookings each morning
5. **Gradual expansion**: Add more slots based on demand

---

## 🎉 You're Ready!

Your soft opening system is complete and ready to use. Start by opening a few slots for this week and see how it goes!

**Remember**: YOU control everything. No slots = no bookings. It's that simple!

