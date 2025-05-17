# Fred Animal Shelter Website

## Overview
This project is part of **CSIT 207 – Web Programming II**.
It is a full-featured website for the fictional **Fred Animal Shelter**, allowing users to:
- Learn about the shelter
- View adoptable pets
- Submit adoption applications
- Donate securely
- Volunteer to help
- Register/login and edit user profile

## Features
- **Fully Responsive Design** using HTML, CSS, php, sql and JavaScript
- **Navigation Menu** with active link highlighting
- **User Authentication** (register, login, profile, logout)
- **Pet Management** (adoptable animals display, application form)
- **Donation Form** with amount options and card info storage (last 4 digits only)
- **Volunteer Form** with eligibility validation
- **User Profile Upload** support with image handling
- **Form Validation** and Error Handling
- **Dropdown Navigation Menu** with sub-pages under "Adopt"

## File Structure
```
/fred-animal-shelter/
│
├── css/
│ ├── base.css # Reset and base rules
│ ├── styles.css # Styling for all pages
│ ├── layout.css # Flexbox and grid layout
│
├── images/
│ ├── profiles/ # Uploaded profile images
│ ├── pet/student/logo images
│
├── php/
│ ├── index.php # Homepage
│ ├── adopt.php # Adoption application form
│ ├── adoptable.php # Adoptable animals listing
│ ├── donate.php # Donation form
│ ├── volunteer.php # Volunteer form
│ ├── profile.php # User profile page
│ ├── register.php # Registration form
│ ├── login.php # Login page
│ ├── logout.php # Logout script
│ ├── db.php # MySQL connection
│ └── auth.php # Authentication guard
│
├── sql/
│ └── database.sql # Database schema and seed data
│
├── about.html # Static about page
└── README.md # Project documentation
```

## How to Run Locally
1. Install [XAMPP](https://www.apachefriends.org/) and place the project folder in `C:/xampp/htdocs/`
2. Run **XAMPP Control Panel** and start **Apache** and **MySQL**
3. Import the `sql/database.sql` file into **phpMyAdmin**
4. Open your browser and navigate to:  
   `http://localhost/fred-animal-shelter/php/index.php`
5. Use the **register/login** feature to access protected features
6. Test donations, adoptions, and volunteer forms (data stored in database)

## Technologies Used
- **HTML5**, **CSS3** (Flexbox, Grid)
- **PHP** (Server-side scripting)
- **MySQL** (Database operations via `mysqli`)
- **JavaScript** (Client-side validation)
- **Responsive Design** for mobile/desktop compatibility

## Authors
- **Jiwon Chae**
- **Hannah Lombardi**