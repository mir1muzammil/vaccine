<!DOCTYPE html>
<html lang="en">

<head>
    <script src="./assets/Java/contact.js"></script>
    <link rel="stylesheet" href="./assets/css/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-Us</title>
</head>

<body>
   <?php 
    include('Includes/navbar.php')
    ?>
    <?php include('Includes/login_modal.php'); ?>
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-info">
                <h2 class="contact-title">Send Your Message</h2>
                <p class="contact-subtitle">Have questions about vaccines or your appointment?
                    Need help choosing a hospital or center?
                    We're here to answer your concerns.
                    Just fill out the form and we'll be in touch!</p>
                <ul class="contact-details">
                    <li>Email: support@vaccinecenter.pk</li>
                    <li><strong>Phone:</strong> +92 312 3456789</li>
                    <li><strong>Location:</strong> Karachi, Pakistan</li>
                </ul>
            </div>
            <form action="./assets/PHP/contactphp.php" method="POST" class="contact-form">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" placeholder="Your Phone" required>
                    <input type="text" name="subject" placeholder="Subject" required>
                </div>
                <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div> 
    </section>
    <div id="customAlert" class="custom-alert success hidden">
        ✅ Your message has been sent successfully!
    </div>
    
    <iframe class="map" src="https://maps.google.com/maps?q=Karachi&t=&z=13&ie=UTF8&iwloc=&output=embed"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>


   <?php include('Includes/footer.php'); ?>
    <script src="./assets/Java/login.js"></script>
<script src="./assets/Java/contact.js"></script>