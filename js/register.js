$(document).ready(function() {
  $("#register-btn").click(function(e) {
      e.preventDefault(); // Prevent default form submission
      
      // Get form data
      var username = $("#username").val();
      var password = $("#password").val();
      var confirmPassword = $("#confirm-password").val();
      var email = $("#email").val();

      // Check if the feilds got its value
      if (!username || !password || !confirmPassword || !email) {
          $("#message").html("<div class='error'>Fill all the feilds</div>");
          return;
      }
      $("#message").html("<div class='loading'>Loading...</div>");
      // Validate password match
      if (password !== confirmPassword) {
          $("#message").html("<div class='error'>Passwords do not match.</div>");
          return;
      }

      // AJAX request to register.php
      $.ajax({
          type: "POST",
          url: "./php/register.php",
          data: {
              username: username,
              password: password,
              email: email,
          },
          success: function(response) {
              if (response === "successsuccess") {
                  // Registration successful, redirect to login page
                  window.location.href = "./login.html";
              } else {
                  // Display error message
                  $("#message").html("<div class='error'>" + response + "</div>");
              }
          },
          error: function(xhr, status, error) {
              $("#message").html("<div class='error'>Error: " + xhr.responseText + "</div>");
          }
      });
  });
});
