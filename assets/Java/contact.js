// NAVBAR
function toggleMenu(toggle) {
  toggle.classList.toggle("open");
  document.getElementById("nav-links").classList.toggle("active");
}
// Alert Maasage
setTimeout(() => {
  const alert = document.querySelector(".alert");
  if (alert) {
    alert.classList.add("fade");
    setTimeout(() => alert.remove(), 500);
  }
}, 4000);
