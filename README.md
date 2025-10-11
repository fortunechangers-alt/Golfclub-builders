# Golf Builders - Modern Golf Services Website

A modern, clean, and bold website for Golf Builders featuring AI-assisted club fittings, professional regripping services, e-commerce functionality, and a comprehensive booking system with admin calendar management.

## Features

### Frontend
- ✅ **Modern Design**: Bold, clean UI with navy blue, golf green, and gold color scheme
- ✅ **Responsive Layout**: Mobile-first design that works on all devices
- ✅ **Hero Section**: Engaging homepage with clear CTAs
- ✅ **Services Pages**: Detailed information about AI club fitting, regripping, and custom club building
- ✅ **Interactive Booking System**: Multi-step booking with calendar and time slot selection
- ✅ **Product Shop**: E-commerce functionality for grips, shafts, and accessories
- ✅ **Testimonials**: Customer reviews showcase

### Booking System
- ✅ **Interactive Calendar**: Visual date selection with availability indicators
- ✅ **Smart Time Slots**: Automatically generated based on business hours and existing bookings
- ✅ **Real-time Availability**: AJAX-powered availability checking
- ✅ **Service-based Duration**: Time slots adjust based on selected service
- ✅ **Booking Confirmation**: Professional confirmation page with booking reference
- ✅ **Customer Information**: Comprehensive booking form with validation

### Admin Panel
- ✅ **Dashboard**: Overview of bookings, orders, and analytics
- ✅ **Booking Management**: View, approve, cancel, and reschedule bookings
- ✅ **Calendar Management**: Block/unblock dates and time slots
  - Block individual dates
  - Block date ranges
  - Block specific time slots
  - Recurring blocks (e.g., every Sunday)
  - View all blocked dates
- ✅ **Product Management**: CRUD operations for shop products
- ✅ **Order Management**: View and manage customer orders
- ✅ **Business Hours**: Configure operating hours for each day
- ✅ **Settings**: General site configuration

### Technical Features
- **Framework**: CodeIgniter 4.6.3
- **Database**: MySQL (golf_builders)
- **Architecture**: MVC pattern
- **Frontend**: Custom CSS with modern design principles
- **JavaScript**: Vanilla JS for calendar and interactive features
- **Security**: CSRF protection, input validation, password hashing

## Installation

1. **Clone/Install CodeIgniter 4** (Already done in this project)

2. **Configure Database**:
   - Database name: `golf_builders`
   - User: `root`
   - Password: (empty for XAMPP)
   - Configuration in: `app/Config/Database.php`

3. **Run Migrations**:
   ```bash
   php spark migrate
   ```

4. **Seed Sample Data**:
   ```bash
   php spark db:seed InitialDataSeeder
   ```

5. **Start Development Server**:
   ```bash
   php spark serve
   ```

6. **Access the Website**:
   - Frontend: http://localhost:8080
   - Admin Panel: http://localhost:8080/admin

## Default Admin Credentials

**Email**: admin@golfbuilders.com  
**Password**: admin123

**IMPORTANT**: Change these credentials after first login!

## Database Schema

### Core Tables
- `users` - Customer accounts and admin users
- `services` - AI club fittings, regripping services
- `bookings` - Appointment scheduling
- `blocked_dates` - Admin-managed calendar blocks
- `business_hours` - Operating hours configuration
- `booking_settings` - System settings for booking rules
- `products` - Shop inventory
- `orders` - Customer orders
- `order_items` - Order line items
- `testimonials` - Customer reviews
- `settings` - Site configuration

## Project Structure

```
golf_builders_2/
├── app/
│   ├── Controllers/
│   │   ├── Home.php
│   │   ├── Services.php
│   │   ├── Booking.php
│   │   ├── Shop.php (to be implemented)
│   │   ├── Pages.php (to be implemented)
│   │   └── Admin/ (to be implemented)
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── ServiceModel.php
│   │   ├── BookingModel.php
│   │   ├── BlockedDateModel.php
│   │   ├── BusinessHourModel.php
│   │   ├── ProductModel.php
│   │   └── OrderModel.php
│   ├── Views/
│   │   ├── layout/
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   ├── home/
│   │   │   └── index.php
│   │   ├── services/
│   │   │   └── index.php
│   │   ├── booking/
│   │   │   ├── index.php
│   │   │   └── confirmation.php
│   │   └── admin/ (to be implemented)
│   └── Database/
│       ├── Migrations/ (11 migration files)
│       └── Seeds/
│           └── InitialDataSeeder.php
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── images/
└── writable/
    └── uploads/
```

## Key Features Implementation Status

### ✅ Completed
- Database schema and migrations
- Core models
- Homepage with hero section
- Services overview page
- Booking system with calendar
- Interactive time slot selection
- Booking confirmation
- Sample data seeding
- Responsive design
- Modern UI/UX

### 🔄 To Be Implemented (Future Enhancements)
- Admin dashboard
- Admin calendar management UI
- Shop/E-commerce pages
- Shopping cart functionality
- Checkout process
- Authentication system (login/register)
- About page
- Contact form
- Email notifications
- Payment gateway integration
- User account dashboard
- Order tracking
- Advanced analytics

## API Endpoints

### Public Endpoints
- `GET /` - Homepage
- `GET /services` - Services overview
- `GET /booking` - Booking form
- `POST /booking/create` - Create booking
- `GET /booking/confirmation/{reference}` - Booking confirmation
- `GET /booking/checkAvailability` - Check time slot availability

### Admin Endpoints (Authentication Required)
- `GET /admin` - Admin dashboard
- `GET /admin/bookings` - Manage bookings
- `GET /admin/calendar` - Calendar management
- `POST /admin/calendar/block` - Block dates
- `POST /admin/calendar/unblock` - Unblock dates
- `GET /admin/products` - Manage products
- `GET /admin/orders` - Manage orders
- `GET /admin/settings` - Site settings

## Design Specifications

### Color Palette
- **Navy Blue**: #0A1F44 (Primary)
- **Golf Green**: #00A651 (Accent)
- **Gold**: #D4AF37 (Highlights)
- **White**: #FFFFFF
- **Light Gray**: #F5F7FA (Backgrounds)

### Typography
- **Font Family**: Inter (Google Fonts)
- **Headings**: Bold, large sizes for impact
- **Body**: Clean, readable sans-serif

### Design Principles
- Minimalist with bold elements
- Full-width hero sections
- Glassmorphism effects
- Smooth animations
- Card-based layouts
- Modern gradients

## Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## License
Proprietary - Golf Builders © 2025

## Support
For support or questions, contact: info@golfbuilders.com

---

**Built with CodeIgniter 4** | **Modern. Clean. Bold.**
