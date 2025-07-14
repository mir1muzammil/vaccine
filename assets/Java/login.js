
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