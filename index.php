<?php
// Professional, engaging landing page for Clinic Appointment System
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Clinic Appointment System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #3096abff;
      margin: 0;
      padding: 0;
      scroll-behavior: smooth;
    }

    /* Navbar */
    .navbar {
      background: rgba(0, 0, 0, 0.7);
    }
    .navbar a {
      color: #fff !important;
      font-weight: 500;
    }
    .navbar a:hover {
      color: #ffc107 !important;
    }

    /* Hero Section */
    .hero {
      background: url('assets/image2-Picsart-AiImageEnhancer.jpg') no-repeat center center;
      background-size: cover;
      position: relative;
      color: #fff;
      padding: 140px 0;
    }
    .hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
    }
    .hero-content {
      position: relative;
      z-index: 1;
      text-align: center;
      max-width: 700px;
      margin: auto;
      animation: fadeIn 1.2s ease-in-out;
    }
    .hero-content h1 {
      font-size: 3.2rem;
      font-weight: 700;
      letter-spacing: 1px;
    }
    .hero-content p {
      font-size: 1.15rem;
      margin-top: 10px;
      opacity: 0.9;
    }
    .btn-custom {
      min-width: 180px;
      font-size: 1rem;
      border-radius: 50px;
      padding: 12px 20px;
      transition: 0.3s;
    }
    .btn-custom:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    /* Features */
    .features {
      padding: 70px 0;
      background-color: #ece9e9ff;
    }
    .feature-card {
      background: #51e0e4ff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      transition: transform 0.3s, box-shadow 0.3s;
      padding: 25px;
    }
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .feature-card i {
      font-size: 2.5rem;
      color: #0d6efd;
      margin-bottom: 15px;
    }

    /* Quick Start */
    .quick-start {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .quick-start ol li {
      margin-bottom: 10px;
    }

    /* Testimonials */
    .testimonials {
      background: #f6f7f8ff;
      padding: 70px 0;
    }
    .testimonial-card {
      background: #c1a0d8ff;;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .testimonial-card p {
      font-style: italic;
    }

    /* Footer */
    footer {
      background-color: #0d1b2a;
      color: #fff;
      padding: 25px 0;
      text-align: center;
    }
    footer a {
      color: #ffc107;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="#">MedPlus</a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
        <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
        <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero">
  <div class="hero-content container">
    <i class="bi bi-heart-pulse-fill text-danger" style="font-size: 3rem;"></i>
    <h1 class="mt-3">MedPlus Healthcare</h1>
    <p class="lead">Your trusted partner for streamlined appointments and healthcare management.</p>
<div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
  <a class="btn btn-primary btn-lg btn-custom" href="patient/register.php">📝 Patient Register</a>
  <a class="btn btn-outline-light btn-lg btn-custom" href="patient/login.php">🔐 Patient Login</a>
  <a class="btn btn-warning btn-lg btn-custom" href="admin/admin_login.php">🛠️ Admin Panel</a>
  <a class="btn btn-success btn-lg btn-custom" href="doctor/login.php">👨‍⚕️ Doctor Login</a>

</div>

  </div>
</div>

<!-- Features Section -->
<div id="features" class="features">
  <div class="container text-center">
    <h2 class="mb-5 fw-bold">✨ Welcome to MedPlus</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card">
          <i class="bi bi-calendar-check-fill"></i>
          <h5 class="fw-semibold">Easy Booking</h5>
          <p>Book appointments in just a few clicks — simple and fast for patients.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <i class="bi bi-person-badge-fill"></i>
          <h5 class="fw-semibold">Admin Control</h5>
          <p>Manage schedules, doctors, and patient records with ease and security.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <i class="bi bi-shield-lock-fill"></i>
          <h5 class="fw-semibold">Secure Access</h5>
          <p>Robust login systems ensure data security for patients and admins.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- How It Works -->
<div id="how-it-works" class="container my-5 quick-start">
  <h3 class="fw-bold mb-3">🚀 How It Works</h3>
  <ol>
    <li>Patients register and log in to the system.</li>
    <li>Choose your doctor and preferred date.</li>
    <li>Confirm your appointment instantly.</li>
    <li>Admins manage schedules and patient details efficiently.</li>
  </ol>
</div>

<!-- Testimonials -->
<div id="testimonials" class="testimonials">
  <div class="container">
    <h3 class="fw-bold text-center mb-5">💬 What Our Users Say</h3>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="testimonial-card">
          <p>"Booking an appointment has never been this easy! Highly recommend MedPlus."</p>
          <strong>- Priya S.</strong>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card">
          <p>"The admin dashboard makes managing patients a breeze. Love it!"</p>
          <strong>- Dr. Patil</strong>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card">
          <p>"Secure, fast, and user-friendly. Exactly what our clinic needed."</p>
          <strong>- Anil R.</strong>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer id="contact">
  <div class="container">
    <p class="mb-1">&copy; 2025 MedPlus Healthcare. All rights reserved.</p>
    <p class="mb-0">Need help? <a href="#">Contact Support <br>medplushealtcare@gmail.com</a></p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
