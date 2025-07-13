  // NAVBAR
    function toggleMenu(toggle) {
        toggle.classList.toggle("open");
        document.getElementById("nav-links").classList.toggle("active");
    }
    //  POPUP
    function openModal(formType) {
        document.getElementById('authModal').style.display = 'block';
        switchForm(formType);
    }
    function closeModal() {
        document.getElementById('authModal').style.display = 'none';
    }
    function switchForm(formType) {
        document.getElementById('loginForm').style.display = formType === 'login' ? 'block' : 'none';
        document.getElementById('registerForm').style.display = formType === 'register' ? 'block' : 'none';
    }
    window.onclick = function (event) {
        const modal = document.getElementById('authModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    // Vaccine Safety & FAQs
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        item.querySelector('.faq-question').addEventListener('click', () => {
            item.classList.toggle('active');
            faqItems.forEach(other => {
                if (other !== item) other.classList.remove('active');
            });
        });
    });
    // MAP SELECTION
    function initMap() {
        const defaultCenter = { lat: 24.8607, lng: 67.0011 }; // Karachi
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: defaultCenter,
        });
        const hospitals = [
            { name: "City Hospital", position: { lat: 24.8607, lng: 67.0011 } },
            { name: "Dow Medical", position: { lat: 24.8736, lng: 67.0599 } },
            { name: "Agha Khan Hospital", position: { lat: 24.8978, lng: 67.0822 } },
            { name: "Liaquat National", position: { lat: 24.8972, lng: 67.0698 } },
        ];
        hospitals.forEach(hospital => {
            const marker = new google.maps.Marker({
                position: hospital.position,
                map: map,
                title: hospital.name
            });
            const infoWindow = new google.maps.InfoWindow({
                content: `<strong>${hospital.name}</strong><br>Vaccine Center`
            });
            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            });
        });
    }