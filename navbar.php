<!-- navbar.php -->
<style>
  /* Navbar Styling */
  .navbar {
    background: linear-gradient(90deg, #004e92, #000428); /* Blue healthcare gradient */
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.3);
    font-family: 'Segoe UI', sans-serif;
  }

  .navbar-brand {
    font-weight: bold;
    font-size: 1.4rem;
    letter-spacing: 0.5px;
    color: #fff !important;
    transition: all 0.3s ease;
  }

  .navbar-brand:hover {
    color: #00d4ff !important;
    transform: scale(1.05);
  }

  .navbar-nav .nav-link {
    font-size: 1rem;
    font-weight: 500;
    color: #f8f9fa !important;
    padding: 8px 18px;
    border-radius: 6px;
    text-decoration: none !important; /* Removes underline */
    transition: all 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.15);
    color: #00d4ff !important;
    transform: translateY(-2px);
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-toggler:focus {
    box-shadow: none;
  }
</style>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <!-- Brand/Logo -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <i class="bi bi-heart-pulse-fill text-danger me-2" style="font-size: 1.5rem;"></i> MedPlus Healthcare
    </a>

    <!-- Mobile Menu Toggle -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Nav Links -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/clinic/index.php">🏠 Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/clinic/patient/register.php">📝 Patient Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/clinic/patient/login.php">🔐 Patient Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/clinic/admin/admin_login.php">🛠️ Admin Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/clinic/doctor/login.php">👨‍⚕️ Doctor Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
