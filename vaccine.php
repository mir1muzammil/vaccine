<?php
include('Includes/db.php')
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine</title>
    <!-- <link rel="stylesheet" href="./assets/css/vaccine.css"> -->
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

/* HERO SECTION */
.hero {
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url('assets/img/about-us\ 2.webp') center/cover no-repeat;
    color: white;
    font-family: 'Poppins', sans-serif;
    text-align: center;
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

/* POPUP */
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

/* Available Vaccines Section */
.available-vaccines {
    padding: 80px 20px;
    font-family: 'Poppins', sans-serif;
    text-align: center;
    animation: fadeIn 1s ease;
}

.section-title {
    font-size: 36px;
    margin-bottom: 50px;
    color: #1976d2;
    position: relative;
}

.section-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background-color: #0d47a1;
    margin: 12px auto 0;
    border-radius: 2px;
}

.vaccine-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}

.vaccine-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    width: 280px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: slideUp 0.6s ease forwards;
    display: flex;
    flex-direction: column;
}

.vaccine-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
}

.vaccine-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    display: block;
}

.vaccine-card h4 {
    font-size: 18px;
    color: #0d47a1;
    font-weight: 700;
    margin: 16px 0 8px;
}

.vaccine-card p {
    font-size: 14px;
    color: #555;
    padding: 0 16px;
    margin-bottom: 20px;
    line-height: 1.6;
    flex-grow: 1;
}

.learn-more-btn {
    margin: 0 auto 20px;
    padding: 10px 20px;
    background: transparent;
    color: #0d47a1;
    border: 2px solid #0d47a1;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.learn-more-btn:hover {
    background: #0d47a1;
    color: white;
}


.vaccine-card h4 {
    font-size: 20px;
    color: #1976d2;
    margin-bottom: 10px;
}

.vaccine-card p {
    font-size: 15px;
    color: #444;
    margin-bottom: 20px;
    line-height: 1.5;
}

.learn-more-btn {
    display: inline-block;
    padding: 10px 20px;
    background: #1976d2;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease;
}

.learn-more-btn:hover {
    background: #0d47a1;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(40px);
        opacity: 0;
    }

    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .vaccine-grid {
        flex-direction: column;
        align-items: center;
    }
}

/* ELIGIBILITY SECTION */
.eligibility {
    padding: 80px 20px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
    animation: fadeIn 1s ease-in-out;
}

.eligibility .container {
    max-width: 1100px;
    margin: auto;
}

.eligibility-table-wrapper {
    overflow-x: auto;
    margin-top: 40px;
}

.eligibility-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    overflow: hidden;
}

.eligibility-table th,
.eligibility-table td {
    padding: 16px 20px;
    text-align: left;
}

.eligibility-table thead {
    background-color: #1976d2;
    color: white;
}

.eligibility-table tbody tr:nth-child(even) {
    background-color: #f4faff;
}

.eligibility-table tbody tr:hover {
    background-color: #e0f7fa;
    transition: 0.3s ease;
}

.section-title {
    font-size: 36px;
    color: #1976d2;
    margin-bottom: 20px;
    position: relative;
}

.section-title::after {
    content: '';
    width: 60px;
    height: 4px;
    background: #0d47a1;
    display: block;
    margin: 12px auto 0;
    border-radius: 2px;
}

@media (max-width: 768px) {

    .eligibility-table th,
    .eligibility-table td {
        font-size: 14px;
        padding: 12px;
    }
}

/* How to Book Section */
.how-to-book {
    padding: 80px 20px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
    animation: fadeIn 1s ease-in-out;
}

.how-to-book .container {
    max-width: 1100px;
    margin: auto;
}

.section-title {
    font-size: 36px;
    color: #1976d2;
    margin-bottom: 40px;
    position: relative;
}

.section-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background-color: #0d47a1;
    margin: 12px auto 0;
    border-radius: 2px;
}

.booking-steps {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 40px;
    margin-top: 20px;
}

.step {
    background: white;
    padding: 30px;
    border-radius: 12px;
    width: 240px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease;
    animation: slideUp 0.6s ease forwards;
}

.step:hover {
    transform: translateY(-10px);
}

.step img {
    width: 60px;
    height: 60px;
    margin-bottom: 15px;
}

.step h4 {
    font-size: 18px;
    color: #1976d2;
    margin-bottom: 10px;
}

.step p {
    font-size: 14px;
    color: #555;
    line-height: 1.5;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .booking-steps {
        flex-direction: column;
        align-items: center;
    }

    .step {
        width: 90%;
    }
}

/* Vaccine Safety & FAQs */
.vaccine-faqs {
    padding: 80px 20px;
    font-family: 'Poppins', sans-serif;
    animation: fadeIn 1s ease-in-out;
}

.vaccine-faqs .container {
    max-width: 900px;
    margin: auto;
}

.safety-info {
    margin-bottom: 30px;
    font-size: 16px;
    color: #333;
    text-align: center;
    max-width: 700px;
    margin-inline: auto;
}

.section-title {
    font-size: 36px;
    color: #1976d2;
    text-align: center;
    position: relative;
    margin-bottom: 30px;
}

.section-title::after {
    content: '';
    width: 60px;
    height: 4px;
    background: #0d47a1;
    display: block;
    margin: 12px auto 0;
    border-radius: 2px;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-question {
    width: 100%;
    text-align: left;
    padding: 18px 24px;
    font-size: 18px;
    font-weight: 600;
    background: #1976d2;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
}

.faq-question:hover {
    background: #0d47a1;
}

.faq-answer {
    display: none;
    padding: 20px 24px;
    background: #fff;
    color: #333;
    font-size: 15px;
    line-height: 1.6;
}

.faq-item.active .faq-answer {
    display: block;
}

@media (max-width: 768px) {
    .faq-question {
        font-size: 16px;
        padding: 16px;
    }

    .faq-answer {
        font-size: 14px;
        padding: 16px;
    }
}

/* Call to Action Section */
.cta {
    background: linear-gradient(to right, #e3f2fd, #bbdefb);
    padding: 60px 20px;
    font-family: 'Poppins', sans-serif;
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

/* Footer */
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
        <h1>Explore Available Vaccines</h1>
        <p>Your safety starts here. Discover our vaccine options and book your appointment easily.</p>
    </section>

    <?php include('Includes/login_modal.php'); ?>

    <section class="available-vaccines">
        <div class="container">
            <h2 class="section-title">Available Vaccines</h2>
            <div class="vaccine-grid">

                <?php
                $sql = "SELECT name, description, image FROM vaccines WHERE available = 1";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                        $imgPath = !empty($row['image']) && file_exists("hospital/{$row['image']}")
                            ? "hospital/{$row['image']}"
                            : 'https://placehold.co/600x400';
                        ?>
                        <div class="vaccine-card">
                            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                            <h4><?= htmlspecialchars($row['name']) ?></h4>
                            <p><?= htmlspecialchars($row['description']) ?></p>
                            <a href="#" class="learn-more-btn">Learn More</a>
                        </div>
                        <?php
                    endwhile;
                else:
                    ?>
                    <p style="text-align: center;">No vaccines available at the moment.</p>
                <?php endif; ?>
            </div>
    </section>

    <section class="eligibility">
        <div class="container">
            <h2 class="section-title">Eligibility & Age Requirements</h2>
            <div class="eligibility-table-wrapper">
                <table class="eligibility-table">
                    <thead>
                        <tr>
                            <th>Vaccine</th>
                            <th>Recommended Age Group</th>
                            <th>Eligibility Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Polio</td>
                            <td>0–5 years</td>
                            <td>Children under 5. Multiple doses required.</td>
                        </tr>
                        <tr>
                            <td>COVID-19</td>
                            <td>12+ years</td>
                            <td>All individuals aged 12+. Booster recommended.</td>
                        </tr>
                        <tr>
                            <td>Hepatitis B</td>
                            <td>Newborns, Adults</td>
                            <td>Newborns at birth; also for healthcare workers.</td>
                        </tr>
                        <tr>
                            <td>Tetanus</td>
                            <td>All ages</td>
                            <td>Given after injury or during pregnancy/surgery.</td>
                        </tr>
                        <tr>
                            <td>BCG (TB)</td>
                            <td>At Birth</td>
                            <td>Mandatory at birth to prevent tuberculosis.</td>
                        </tr>
                        <tr>
                            <td>HPV</td>
                            <td>9–26 years</td>
                            <td>Best before age 15; prevents cervical cancer.</td>
                        </tr>
                        <tr>
                            <td>Influenza</td>
                            <td>6 months+</td>
                            <td>Annual dose recommended, especially elderly.</td>
                        </tr>
                        <tr>
                            <td>Rabies</td>
                            <td>All ages</td>
                            <td>Given after animal bites or high-risk exposure.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="how-to-book">
        <div class="container">
            <h2 class="section-title">How to Book a Vaccine</h2>
            <div class="booking-steps">

                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Step 1">
                    <h4>1. Register/Login</h4>
                    <p>Create your account or log in to access vaccine booking features.</p>
                </div>

                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/2967/2967350.png" alt="Select Hospital">
                    <h4>2. Select Hospital</h4>
                    <p>Choose a nearby registered hospital from our list or map.</p>
                </div>

                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" alt="Step 3">
                    <h4>3. Pick Time Slot</h4>
                    <p>Select your preferred date and time for vaccination.</p>
                </div>

                <div class="step">
                    <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Step 4">
                    <h4>4. Get Confirmation</h4>
                    <p>Receive a confirmation message and visit the hospital as scheduled.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="vaccine-faqs">
        <div class="container">
            <h2 class="section-title">Vaccine Safety & FAQs</h2>

            <div class="safety-info">
                <p>All vaccines listed on our platform are approved by health authorities and meet international safety
                    standards. Minor side effects like mild fever or soreness are common, but serious reactions are
                    extremely rare.</p>
            </div>

            <div class="faq-list">

                <div class="faq-item">
                    <button class="faq-question">Are vaccines safe for children?</button>
                    <div class="faq-answer">
                        <p>Yes, all recommended vaccines for children are clinically tested and safe. They are monitored
                            by global health organizations like WHO and UNICEF.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">Can I get sick after taking a vaccine?</button>
                    <div class="faq-answer">
                        <p>You may feel mild symptoms such as fever or fatigue, which are normal signs that your body is
                            building protection.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">Do I need a booster shot?</button>
                    <div class="faq-answer">
                        <p>Some vaccines, like COVID-19 and Tetanus, may require booster doses depending on your age and
                            health status.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">Can pregnant women take vaccines?</button>
                    <div class="faq-answer">
                        <p>Yes, certain vaccines such as Tetanus are safe during pregnancy. Always consult your doctor
                            before vaccination.</p>
                    </div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script src="./assets/Java/vaccine.js"></script>
    <script src="./assets/Java/login.js"></script>