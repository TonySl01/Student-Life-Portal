// JavaScript to toggle between login and signup forms
document.getElementById('show-signup').addEventListener('click', function(event) {
  event.preventDefault();
  document.getElementById('login-form').style.display = 'none';
  document.getElementById('signup-form').style.display = 'block';
});

document.getElementById('show-login').addEventListener('click', function(event) {
  event.preventDefault();
  document.getElementById('login-form').style.display = 'block';
  document.getElementById('signup-form').style.display = 'none';
});


document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('signup-form').addEventListener('submit', function(e) {
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('confirm_password').value;

      if (password !== confirmPassword) {
          alert("Passwords do not match.");
          e.preventDefault(); // Prevent form submission
      }
  });
});