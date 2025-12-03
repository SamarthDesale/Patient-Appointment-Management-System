🏥 Patient Appointment Management System

The Patient Appointment Management System is a web-based platform designed to simplify and digitalize clinic operations. It provides an easy way for patients to book appointments, doctors to manage their schedules, and administrators to oversee clinic activities. This system replaces manual processes with a centralized, efficient, and user-friendly solution.

🚀 Features
👤 Patient

Register and log in securely

Search doctors by specialization

Check real-time doctor availability

Book, cancel, and reschedule appointments

View appointment history

👨‍⚕️ Doctor

Log in to a personalized dashboard

Manage availability and working hours

View daily and weekly appointments

Access patient details for scheduled consultations

🛠 Admin

Manage doctors and patients (add, update, delete)

Oversee and control all appointments

Resolve scheduling conflicts

View system statistics and reports

🧩 System Modules

User Management

Doctor Management

Patient Management

Appointment Scheduling (conflict-free)

Availability Management

Notification System

Dashboard & Reporting

🛠 Tech Stack

Frontend: HTML, CSS, JavaScript, Bootstrap
Backend: PHP
Database: MySQL
Real-time Updates: AJAX

🗄 Database Overview

Key tables include:

users

doctors

patients

availability

appointments

notifications

Optimized with foreign keys, indexing, and conflict-free scheduling logic.

🔐 Security Features

Password hashing (password_hash)

Prepared statements to prevent SQL injection

Session-based authentication

Role-based access control (Admin, Doctor, Patient)

📦 Installation & Setup
1. Clone the Repository
git clone https://github.com/your-username/your-repo-name.git

2. Move Project to Server Directory

For XAMPP:

htdocs/Patient-Appointment-Management-System

3. Import Database

Open phpMyAdmin

Create a new database

Import the provided .sql file

4. Configure Database Connection

Update your database credentials in config/db.php or equivalent file:

$host = "localhost";
$user = "root";
$password = "";
$dbname = "clinic_db";

5. Run the Application

Start Apache & MySQL → Open in browser:

http://localhost/Patient-Appointment-Management-System

✔️ Testing

The system has been tested using:

Unit Testing (login, booking, availability, notifications)

Integration Testing (frontend ↔ backend ↔ database flow)

System & User Acceptance Testing

All major modules passed successfully.

📄 Project Purpose

To create a reliable, responsive, and efficient appointment system that:

Reduces manual tasks

Streamlines clinic operations

Eliminates double-booking

Improves patient satisfaction

🤝 Contributing

Pull requests are welcome!
For major changes, please open an issue first to discuss what you would like to improve.

📜 License

This project is for educational and development purposes.
You may modify and extend it freely.
