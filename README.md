# 🏨 Hotel Booking System (College Project)

A comprehensive full-stack hotel reservation system built using PHP, HTML, and MySQL as a college team project. This system enables users to book rooms, manage reservations, view booking histories, and provides administrative tools for hotel management. Designed for academic learning purposes.

## 🎥 Demo

[![Hotel Booking System Demo](https://img.youtube.com/vi/Pf8T5Z8XhD0/0.jpg)](https://youtu.be/Pf8T5Z8XhD0?feature=shared)

**[▶️ Watch Full Demo](https://youtu.be/Pf8T5Z8XhD0?feature=shared)**

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (XAMPP/WAMP recommended for local development)

## 🚀 Features

### 👤 User Features
- **User Registration & Authentication**: Secure signup and login system
- **Room Browsing**: View available rooms with details
- **Room Booking**: Interactive booking interface with date selection
- **Booking History**: Track personal reservation history
- **Room Preferences**: Set and manage room preferences
- **Invoice Generation**: Automatic invoice creation for bookings

### 👨‍💼 Admin/Staff Features
- **Customer Management**: Admin panel to manage customer accounts
- **Staff Management**: Employee dashboard and staff admission
- **Inventory Management**: Track hotel inventory and resources
- **Staff Overtime Management**: Monitor and manage staff working hours
- **Booking Overview**: View all bookings and reservations

## 📁 Project Structure

```
hotel-booking-system/
│
├── 🏠 Frontend Pages
│   ├── hindex.html              # Homepage/Landing page
│   ├── about.html               # About the hotel
│   ├── contact.html             # Contact information
│   └── INVENTORY.HTML           # Inventory management UI
│
├── 🔐 Authentication
│   ├── login.php                # User login functionality
│   ├── signup.php               # User registration form
│   └── staffadmission.php       # Staff registration
│
├── 🏨 Booking System
│   ├── booking.php              # Room booking interface
│   ├── submit_booking.php       # Booking form submission logic
│   ├── room_available.php       # Display available rooms
│   ├── room_pref.php            # Room preferences management
│   └── invoice2.php             # Invoice generation
│
├── 📊 History & Reports
│   ├── booking_history.php      # All booking history
│   ├── personal_history.php     # User's personal bookings
│   └── preferences_history.php  # Preference change logs
│
├── 👨‍💼 Admin Panel
│   ├── Emp_index.php            # Employee dashboard
│   ├── customer_management.php  # Customer management panel
│   └── staff_overtime.php       # Staff overtime tracking
│
├── 🔧 Configuration
│   ├── Db.php                   # Database connection
│   └── README.md                # Project documentation
│
└── 🖼️ Assets
    ├── images/                  # Image assets folder
    └── images.zip               # Compressed image pack
```

## 🔧 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache Server (XAMPP/WAMP/LAMP)
- Web browser

### Steps
1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd hotel-booking-system
   ```

2. **Setup Local Server**
   - Install XAMPP/WAMP
   - Place project folder in `htdocs` (XAMPP) or `www` (WAMP)

3. **Database Setup**
   - Create a MySQL database named `hotel_booking`
   - Import the SQL file (if provided) or create tables manually
   - Update database credentials in `Db.php`

4. **Configure Database Connection**
   ```php
   // Db.php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "hotel_booking";
   ```

5. **Start Services**
   - Start Apache and MySQL services
   - Navigate to `http://localhost/hotel-booking-system/hindex.html`

## 📋 Database Schema

The system uses the following main tables:
- **users**: Store customer information
- **rooms**: Hotel room details and availability  
- **bookings**: Reservation records
- **staff**: Employee information
- **preferences**: User room preferences
- **invoices**: Billing information

## 🎯 Usage

1. **For Customers:**
   - Register/Login through the authentication system
   - Browse available rooms
   - Make reservations with preferred dates
   - View booking history and invoices

2. **For Staff/Admin:**
   - Access employee dashboard
   - Manage customer accounts
   - Track bookings and inventory
   - Generate reports

## 🔐 Security Features

- Password hashing for secure authentication
- Session management for user login states
- Input validation and sanitization
- SQL injection prevention measures

## 📱 Responsive Design

The system includes responsive design elements to work across different devices and screen sizes.

## 🧑‍💻 Development Team

This project was developed by a team of computer science students as part of their academic curriculum, focusing on:
- Full-stack web development
- Database design and management
- User experience design
- Team collaboration and project management

## 🚧 Future Enhancements

- Payment gateway integration
- Email notification system
- Advanced reporting and analytics
- Mobile application
- API development for third-party integrations
- Enhanced security features

## 📝 Known Limitations

- **Academic Project**: Not optimized for production use
- **Security**: Basic security measures (not enterprise-level)
- **Scalability**: Designed for small-scale operations
- **Payment**: No real payment processing
- **Notifications**: Limited notification system

## ⚠️ Important Disclaimer

**This project is developed exclusively for educational and academic purposes.** It demonstrates fundamental concepts of web development, database management, and system design. The system is **NOT recommended for commercial deployment** without significant security enhancements, code optimization, and professional testing.

## 📜 License

This project is for educational use only. Please respect academic integrity guidelines when using this code for learning purposes.

## 🤝 Contributing

As this is an academic project, contributions should align with educational objectives. Feel free to:
- Report bugs or suggest improvements
- Fork the project for learning purposes
- Share educational feedback

## 📞 Support

For questions about this academic project, please refer to the demo video or contact the development team through appropriate academic channels.

---

**⭐ If you found this project helpful for your learning, please give it a star!**

*Made with ❤️ by Computer Science Students*