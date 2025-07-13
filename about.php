<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/about.css">
    <script src="./assets/Java/about.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>About-Us</title>
</head>

<body>
<?php 
    include('Includes/navbar.php')
    ?>

    <section class="hero">
        <h1>Get to Know Us</h1>
        <p>
            Transforming healthcare through digital vaccine tracking and real-time hospital coordination.
        </p>
    
    </section>

    <?php include('Includes/login_modal.php'); ?>

    <section class="about-highlight">
        <div class="container">
            <div class="text-column">
                <p class="section-label">About Us</p>
                <h2 class="main-heading">Empowering hospitals through secure vaccine tracking</h2>
                <p class="sub-text">
                    VaccinePortal is a digital platform helping hospitals manage vaccination appointments,
                    patient status, and reporting across Pakistan with speed, accuracy, and security.
                </p>

                <div class="features">
                    <div class="feature">
                        <i class="fas fa-syringe"></i>
                        <div>
                            <h4>Vaccine Scheduling</h4>
                            <p>Streamlined appointment system for hospitals.</p>
                        </div>
                    </div>
                    <div class="feature">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Geo-location Integration</h4>
                            <p>Find hospitals using live Google Maps pins.</p>
                        </div>
                    </div>
                    <div class="feature">
                        <i class="fas fa-headset"></i>
                        <div>
                            <h4>24/7 Support</h4>
                            <p>Dedicated team available to assist hospitals.</p>
                            <p class="call-text">📞 Call Us: +92 123 4567890</p>
                        </div>
                    </div>
                </div>

                <a href="register.html" class="btn-discover">Discover Now</a>
            </div>

            <div class="image-column">
                <img src="./assets/img/about-us 2.webp" alt="Analytics illustration">
            </div>
        </div>
    </section>

    <section class="mission-vision">
        <div class="container">
            <h2 class="section-title">Our Mission & Vision</h2>
            <div class="mv-content">
                <div class="mv-box mission">
                    <img src="https://cdn-icons-png.flaticon.com/512/2950/2950659.png" alt="Mission Icon">
                    <h3>Our Mission</h3>
                    <p>
                        To simplify and digitize the vaccination process for hospitals across Pakistan by providing a
                        secure,
                        accessible, and efficient platform that streamlines appointment scheduling, vaccine tracking,
                        and patient
                        record management.
                    </p>
                </div>
                <div class="mv-box vision">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Vision Icon">
                    <h3>Our Vision</h3>
                    <p>
                        A digitally empowered healthcare ecosystem where every citizen receives timely vaccinations, and
                        every
                        hospital can manage and monitor their vaccine operations with confidence and accuracy.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="system-works">
        <div class="container">
            <h2 class="section-title">How the System Works</h2>
            <div class="steps">
                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Hospital Registration">
                    <h4>1. Hospital Registration</h4>
                    <p>Hospitals register on the platform by providing their basic details and location.</p>
                </div>
                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/2920/2920250.png" alt="Appointment Assignment">
                    <h4>2. Appointment Assignment</h4>
                    <p>Admin assigns appointments to hospitals based on patient requests and availability.</p>
                </div>
                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/2950/2950675.png" alt="Vaccination Update">
                    <h4>3. Vaccination Status Update</h4>
                    <p>Hospital updates the vaccination status (Completed or Pending) after administering the vaccine.
                    </p>
                </div>
                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Real-Time Dashboard">
                    <h4>4. Real-Time Dashboard</h4>
                    <p>All records are displayed in a live dashboard for monitoring and reporting.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose-us">
        <div class="container">
            <h2 class="section-title">Why Choose Us</h2>
            <div class="features-grid">
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/3257/3257810.png" alt="Secure System">
                    <h4>Secure & Reliable</h4>
                    <p>End-to-end encryption and user role management ensures data security and platform stability.</p>
                </div>
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" alt="Live Dashboard">
                    <h4>Live Dashboard</h4>
                    <p>Get real-time insights and reports for all vaccination activities within your hospital.</p>
                </div>
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Google Maps">
                    <h4>Google Maps Integration</h4>
                    <p>Locate hospitals easily and track patient appointment locations via Google Maps.</p>
                </div>
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/4784/4784200.png" alt="Responsive Design">
                    <h4>Responsive Interface</h4>
                    <p>Optimized for desktop and mobile so hospitals can work efficiently from any device.</p>
                </div>
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/2942/2942909.png" alt="Admin Control">
                    <h4>Centralized Admin Panel</h4>
                    <p>Admins can easily manage hospital records, appointments, and vaccine updates from one place.</p>
                </div>
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/5900/5900233.png" alt="Support">
                    <h4>24/7 Support</h4>
                    <p>We provide dedicated support to ensure your hospital operations run smoothly and securely.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="meet-team">
        <div class="container">
            <h2 class="section-title">Meet the Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Team Member 1">
                    <h4>Mir Muzzamil</h4>
                    <p>Lead Developer</p>
                </div>
                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/147/147144.png" alt="Team Member 2">
                    <h4>Mustafah</h4>
                    <p>Product Designer</p>
                </div>
                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Team Member 3">
                    <h4>Mazz</h4>
                    <p>System Architect</p>
                </div>
                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/147/147144.png" alt="Team Member 4">
                    <h4>Syed Haziq</h4>
                    <p>Project Manager</p>
                </div>
            </div>
        </div> 
    </section>

     <?php if (isset($_SESSION['parent_logged_in']) && $_SESSION['parent_logged_in'] === true): ?>
        <section class="cta">
            <h2>Ready to Get Started?</h2>
            <div class="cta-buttons">
                <a href="parent-panel.php" class="btn-cta primary">Book Now</a>
            </div>
        </section>
    <?php else: ?>
        <section class="cta">
            <h2>Ready to Get Started?</h2>
            <div class="cta-buttons">
                <a href="#" class="btn-cta primary" onclick="openModal('login')">Login / Register</a>
            <?php endif; ?>
        </div>
    </section>

   <?php include('Includes/footer.php'); ?>
<script src="./assets/Java/login.js"></script>
