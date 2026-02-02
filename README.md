# Authentication & Profile System - Plain PHP MVC

A modern authentication and profile management system built with plain PHP following the MVC architecture, PSR-4 autoloading, and modern UI practices — without using any PHP framework.

## Features

### Authentication
- **User Registration** - Create new accounts with email validation and password confirmation
- **User Login** - Secure login with email and password
- **Session Management** - Persistent user sessions with secure logout
- **Terms & Conditions** - Required agreement to terms and privacy policy during registration

### Profile Management
- **Dashboard** - User dashboard with profile overview
- **Edit Profile** - Update name and email with validation
- **Change Password** - Secure password change with current password verification
- **Active Navigation** - Dynamic sidebar highlighting based on current page

### Security & Validation
- **Password Hashing** - Secure password storage using PHP's `password_hash()`
- **Email Validation** - Proper email format and uniqueness checking
- **Form Validation** - Comprehensive server-side validation with error messages
- **Flash Messages** - User feedback for success and error states
- **Protected Routes** - Authentication middleware for profile pages

### User Experience
- **Modern UI** - Beautiful gradient designs with Tailwind CSS
- **Error Handling** - Field-specific error messages with preserved form data
- **Responsive Design** - Mobile-friendly interface
- **Form Persistence** - Old input values retained on validation errors

## Project Structure

```
project/
├── app/
│   ├── Controllers/          # Application controllers
│   │   ├── AuthController.php       # Handles registration & login
│   │   └── ProfileController.php    # Handles profile operations
│   │
│   ├── Models/               # Data models
│   │   └── User.php                 # User model with CRUD operations
│   │
│   ├── Views/                # View templates
│   │   ├── auth/                    # Authentication views
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── profile/                 # Profile views
│   │   │   ├── dashboard.php
│   │   │   ├── edit.php
│   │   │   └── edit_password.php
│   │   ├── layouts/                 # Layout components
│   │   │   ├── header.php
│   │   │   ├── footer.php
│   │   │   └── profile/
│   │   │       ├── header.php
│   │   │       ├── footer.php
│   │   │       └── sidebar.php
│   │   └── flash/                   # Flash message components
│   │       └── session.php
│   │
│   ├── Helpers/              # Helper functions
│   │   ├── auth.php                 # Authentication helpers
│   │   ├── redirect.php             # Redirect helper
│   │   ├── session.php              # Session & flash message helpers
│   │   ├── validation.php           # Validation functions
│   │   └── view.php                 # View rendering helper
│   │
│   └── core/                 # Core application files
│       ├── Database.php             # PDO database connection
│       └── Helpers.php              # Helper loader
│
├── public/                   # Public web root
│   ├── index.php                    # Landing page
│   ├── login.php                    # Login entry point
│   ├── register.php                 # Registration entry point
│   ├── logout.php                   # Logout handler
│   └── profile/                     # Profile entry points
│       ├── dashboard.php
│       ├── edit.php
│       └── edit_password.php
│
├── vendor/                   # Composer dependencies
├── .env                      # Environment variables (not in git)
├── .env.example              # Environment variables template
├── .gitignore                # Git ignore file
├── composer.json             # Composer configuration
└── README.md                 # This file
```

## Setup Instructions

> **Important:** The `public/` folder is the document root of this application. When deploying to a production server (Apache/Nginx), configure your web server to point to the `public/` directory as the document root for security and proper routing.

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Web server (Apache/Nginx) or PHP built-in server

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/mmahfoozurrahman/authentication-profile-system-plain-php-mvc
   cd project
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment variables**
   
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
   
   Update the `.env` file with your database credentials:
   ```env
   DB_HOST=localhost
   DB_NAME=auth_profile_db
   DB_USER=root
   DB_PASS=your_password_here
   ```

4. **Create database**
   ```sql
   CREATE DATABASE auth_profile_db;
   ```

5. **Create users table**
   ```sql
   USE auth_profile_db;
   
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       email VARCHAR(255) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```

6. **Start the development server**
   ```bash
   cd public
   php -S localhost:8000
   ```

7. **Access the application**
   
   Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

## How to use

### Registration
1. Navigate to `/register.php`
2. Fill in name, email, password, and confirm password
3. Agree to terms and conditions
4. Click "Create Account"

### Login
1. Navigate to `/login.php`
2. Enter email and password
3. Click "Sign In"

### Profile Management
1. After login, access the dashboard at `/profile/dashboard.php`
2. Edit profile information at `/profile/edit.php`
3. Change password at `/profile/edit_password.php`

### Logout
- Click the "Logout" button from any profile page
- Or navigate to `/logout.php`

## Architecture

### MVC Pattern
- **Models** - Handle data and business logic (User.php)
- **Views** - Display data to users (all .php files in Views/)
- **Controllers** - Handle requests and coordinate between Models and Views

### Helper Functions
- Centralized validation logic in `validation.php`
- Reusable authentication checks in `auth.php`
- Flash message system for user feedback
- View rendering with data passing

### Database Layer
- PDO for secure database operations
- Prepared statements to prevent SQL injection
- Centralized connection management

## Security Features

- Password hashing with `PASSWORD_DEFAULT` algorithm
- SQL injection prevention via prepared statements
- Session-based authentication
- CSRF protection ready (can be extended)
- XSS prevention with `htmlspecialchars()`
- Protected routes with authentication middleware

## UI/UX Features

- Modern gradient designs
- Smooth animations and transitions
- Responsive layout with Tailwind CSS
- Consistent error messaging
- Form state preservation
- Active navigation indicators

## License

This project is open-source
