<style>
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


<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-about">
            <h3>Vaccine</h3>
            <p>Your trusted partner in managing vaccinations and healthcare services across Pakistan.</p>
        </div>

        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="prop.html">Search Vaccine</a></li>
                <li><a href="Contact.html">Contact Us</a></li>
                <?php if (isset($_SESSION['parent_logged_in']) && $_SESSION['parent_logged_in'] === true): ?>
                            <li><a href="parent-panel.php">Book Now</a></li>
                <?php else: ?>
                            <li><a href="#" onclick="openModal('login')">Login / Register</a></li>
                        <?php endif; ?>
            </ul>
        </div>

        <div class="footer-contact">
            <h4>Contact Us</h4>
            <p><strong>Phone:</strong> +92 300 1234567</p>
            <p><strong>Email:</strong> AptechStudent@gmail.com</p>
            <p><strong>Office:</strong> North Nazmabad, Karachi</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/feed/?trk=guest_homepage-basic_google-one-tap-submit"><i
                        class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 RealEstatePro. All rights reserved.</p>
    </div>
</footer>
</body>

</html>