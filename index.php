<?php
session_start();
$isLoggedIn = isset($_SESSION['user_name']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Vaccine Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/index.css"> -->
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #bbdefb);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* NAVBAR */
        header {
            background-color: white;
            font-family: 'Poppins', sans-serif;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #1976d2;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #1976d2;
        }

        nav a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0%;
            height: 2px;
            background-color: #1976d2;
            transition: width 0.3s ease-in-out;
        }

        nav a:hover::after {
            width: 100%;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
        }

        .menu-toggle div {
            width: 25px;
            height: 3px;
            background-color: #333;
            transition: all 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            nav {
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: white;
                flex-direction: column;
                gap: 15px;
                padding: 20px;
                transform: translateY(-100%);
                opacity: 0;
                pointer-events: none;
                transition: all 0.4s ease;
            }

            nav.active {
                transform: translateY(0);
                opacity: 1;
                pointer-events: auto;
            }

            .menu-toggle {
                display: flex;
            }
        }

        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url('../img/banner.jpg') center/cover no-repeat;
            color: white;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            padding: 120px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1.2s ease-in-out;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            max-width: 600px;
            margin-bottom: 30px;
        }

        .buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .buttons a {
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-primary {
            background-color: #1976d2;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1565c0;
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
        }

        .btn-outline:hover {
            background-color: white;
            color: #1976d2;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .buttons a {
                width: 100%;
                text-align: center;
            }
        }

        .modal {
            display: none;
            font-family: 'Poppins', sans-serif;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            position: relative;
            animation: fadeIn 0.4s ease;
        }

        .auth-form h2 {
            text-align: center;
            color: #1976d2;
            margin-bottom: 20px;
            border-bottom: 2px solid #1976d2;
            display: inline-block;
            padding-bottom: 5px;
        }

        .auth-form input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .auth-form button {
            width: 100%;
            padding: 10px;
            background-color: #1976d2;
            color: white;
            border: none;
            border-radius: 6px;
            margin-top: 10px;
            cursor: pointer;
        }

        .auth-form button:hover {
            background-color: #0d47a1;
        }

        .auth-form p {
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
        }

        .auth-form a {
            color: #1976d2;
            text-decoration: underline;
            cursor: pointer;
        }

        .close-btn {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 24px;
            color: #333;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }


        .features {
            margin-top: 20px;
            font-family: 'Poppins', sans-serif;
            padding: 50px 20px;
            text-align: center;
        }

        .section-title {
            font-size: 36px;
            color: #1976d2;
            margin-bottom: 40px;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            display: block;
            margin: 10px auto 0;
            width: 60px;
            height: 4px;
            background-color: #1976d2;
            border-radius: 2px;
            transition: width 0.3s ease-in-out;
        }

        .section-title:hover::after {
            width: 100px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            width: 280px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card h3 {
            font-size: 20px;
            color: #0d47a1;
            margin-top: 15px;
        }

        .card p {
            padding: 0 15px;
            color: #555;
            font-size: 14px;
            margin: 10px 0 20px;
        }

        .learn-more {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            border: 2px solid #1976d2;
            color: #1976d2;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card:hover .learn-more {
            background-color: #1976d2;
            color: white;
        }

        /* STATS */
        .stats-section {
            padding: 80px 20px;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }

        .stats-title {
            font-size: 32px;
            color: #1976d2;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
        }

        .stat-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-6px);
        }

        .stat-box h3 {
            font-size: 36px;
            color: #002244;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .stat-box p {
            font-size: 14px;
            color: #555;
        }

        .testimonials {
            font-family: 'Poppins', sans-serif;
            padding: 80px 20px;
            text-align: center;
        }

        .testimonials .section-title {
            font-size: 32px;
            color: #1976d2;
            margin-bottom: 50px;
            position: relative;
        }

        .testimonial-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
            padding: 30px 25px;
            max-width: 320px;
            transition: transform 0.3s ease;
            text-align: left;
        }

        .testimonial-card:hover {
            transform: translateY(-6px);
        }

        .testimonial-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .testimonial-author {
            font-size: 14px;
            color: #555;
            text-align: left;
        }

        .testimonial-author strong {
            color: #0d47a1;
        }

        .cta {
            background: linear-gradient(to right, #e3f2fd, #bbdefb);
            font-family: 'Poppins', sans-serif;
            padding: 60px 20px;
            text-align: center;
        }

        .cta h2 {
            font-size: 32px;
            color: #0d47a1;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .cta p {
            color: #333;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn-cta {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cta.primary {
            background-color: #1976d2;
            color: white;
        }

        .btn-cta.primary:hover {
            background-color: #1565c0;
        }

        .btn-cta.outline {
            border: 2px solid #1976d2;
            color: #1976d2;
        }

        .btn-cta.outline:hover {
            background-color: #1976d2;
            color: white;
        }

        .site-footer {
            background-color: #002244;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            margin-top: 100px;
            padding: 3rem 1rem 1rem;
            font-size: 0.95rem;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-about,
        .footer-links,
        .footer-contact {
            flex: 1 1 250px;
        }

        .footer-about h3 {
            font-size: 1.6rem;
            margin-bottom: 1rem;
            color: #ffcc00;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links ul li {
            margin: 0.5rem 0;
        }

        .footer-links ul li a {
            color: #dcdcdc;
            text-decoration: none;
        }

        .footer-links ul li a:hover {
            color: #ffcc00;
        }

        .footer-contact p {
            margin: 0.4rem 0;
        }

        .social-icons a {
            margin-right: 0.5rem;
            display: inline-block;
        }

        .social-icons img {
            width: 24px;
            height: 24px;
            filter: brightness(0) invert(1);
            transition: transform 0.2s;
        }

        .social-icons a:hover img {
            transform: scale(1.1);
            filter: brightness(0) invert(0.7);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 2rem;
            font-size: 0.85rem;
        }

        .social-icons {
            margin-top: 1rem;
        }

        .social-icons a {
            display: inline-block;
            margin-right: 12px;
            color: #ffffff;
            font-size: 20px;
            transition: color 0.3s, transform 0.3s;
        }

        .social-icons a:hover {
            color: #ffcc00;
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <?php
    include('Includes/navbar.php')
        ?>

    <section class="hero">
        <h1>Welcome to the Vaccine Portal</h1>
        <p>
            A secure and efficient platform to manage hospital vaccination data and appointments across the nation.
        </p>

    </section>

    <?php include('Includes/login_modal.php'); ?>


    <section class="features" id="features">
        <h2 class="section-title">Available Vaccines</h2>
        <div class="card-container">
            <div class="card">
                <img src="./assets/img/card-1.jpg" alt="COVID-19 Vaccine">
                <h3>COVID-19 Vaccine</h3>
                <p>Protects against coronavirus. Widely available and recommended for all age groups.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
            <div class="card">
                <img src="./assets/img/card-2.jpg" alt="Hepatitis B Vaccine">
                <h3>Hepatitis B</h3>
                <p>Prevents Hepatitis B, a serious liver infection. Often given at birth or in early childhood.
                </p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
            <div class="card">
                <img src="./assets/img/card3.jpg" alt="Polio Vaccine">
                <h3>Polio Vaccine</h3>
                <p>Vital for eradicating poliovirus. Administered in drops or injections for children.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
            <div class="card">
                <img src="./assets/img/card4.jpg" alt="Influenza (Flu)">
                <h3>Influenza (Flu)</h3>
                <p>Recommended annually to protect against seasonal flu viruses and reduce severity.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="card-container">
            <div class="card">
                <img src="./assets/img/card5.jpg" alt="MMR Vaccine">
                <h3>MMR Vaccine</h3>
                <p>Protects against measles, mumps, and rubella — essential for childhood immunization.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
            <div class="card">
                <img src="./assets/img/card67.jpg" alt="DTP Vaccine">
                <h3>DTP Vaccine</h3>
                <p>Guards against diphtheria, tetanus, and pertussis — part of early immunization schedule.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
            <div class="card">
                <img src="./assets/img/card7.jpg" alt="HPV Vaccine">
                <h3>HPV Vaccine</h3>
                <p>Protects against the human papillomavirus, reducing risk of cervical and throat cancers.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
            <div class="card">
                <img src="./assets/img/card8.jpg" alt="Typhoid Vaccine">
                <h3>Typhoid Vaccine</h3>
                <p>Prevents typhoid fever, especially important when traveling or in high-risk areas.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <h2 class="stats-title">Live Vaccination Statistics</h2>
        <div class="stats-container">

            <div class="stat-box">
                <h3 class="counter" data-target="10534">0</h3>
                <p>Total Vaccines Administered</p>
            </div>

            <div class="stat-box">
                <h3 class="counter" data-target="280">0</h3>
                <p>Registered Hospitals</p>
            </div>

            <div class="stat-box">
                <h3 class="counter" data-target="8700">0</h3>
                <p>Appointments Processed</p>
            </div>

            <div class="stat-box">
                <h3 class="counter" data-target="50">0</h3>
                <p>Cities Covered</p>
            </div>

        </div>
    </section>

    <section class="testimonials">
        <h2 class="section-title">What Our Partners Say</h2>
        <div class="testimonial-container">
            <div class="testimonial-card">
                <p class="testimonial-text">
                    “Managing appointments and vaccine records has become effortless thanks to this system. It's
                    secure
                    and very intuitive.”
                </p>
                <div class="testimonial-author">
                    <strong>Dr. Ayesha Siddiqui</strong><br>
                    <span>MedCare Hospital, Karachi</span>
                </div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">
                    “Our hospital staff finds the interface very easy to use. It has streamlined our entire
                    vaccination
                    process.”
                </p>
                <div class="testimonial-author">
                    <strong>Dr. Imran Khalid</strong><br>
                    <span>City Clinic, Lahore</span>
                </div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">
                    “This platform really helped during COVID-19. It keeps all records in one place and saves so
                    much
                    time.”
                </p>
                <div class="testimonial-author">
                    <strong>Nurse Fatima</strong><br>
                    <span>Sunrise Health, Islamabad</span>
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
    <script src="./assets/Java/index.js"></script>