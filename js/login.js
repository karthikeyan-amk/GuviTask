    $(document).ready(function() {
    // Handling form submission
    $(".btn-primary").click(function() {
        // Get username and password values
        var username = $("#username").val();
        var password = $("#password").val();
        
        // Check if the feilds got its value
        if (!username || !password) {
            $("#message").html("<div class='error'>Fill all the feilds</div>");
            return;
        }
        $("#message").html("<div class='loading'>Loading...</div>");
        
        $.ajax({
            type: "POST",
            url: "./php/login.php", // Assuming login processing script is named login.php
            data: {
                username: username,
                password: password,
            },
            success: function(response) {
                if (response === "success") {
                    // Store token in local storage (replace tokenValue with actual token)
                    localStorage.setItem("username", username);
                    
                    // If login is successful, redirect to profile.html
                    window.location.href = "./profile.html";
                } else {
                    // If login fails, display error message
                    alert(response);
                }
            },
            error: function(xhr, status, error) {
                // If there's an error with the AJAX request, display error message
                console.error(xhr.responseText);
                alert("An error occurred. Please try again.");
            }
        });
    });
    });
