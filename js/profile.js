$(document).ready(function(){
  var username = localStorage.getItem('username');
  // Show username in profile
  $('#name').text('Welcome, ' + username + '!');

  $('#logout').click(function() {
    // Delete the token username
    localStorage.removeItem('username');
    window.location.href = './login.html';
  });

  $.ajax({
    type: 'GET',
    url: './php/profile.php',
    data: { username: username },
    success: function(response){
      $("#displayDetails").html("Age: " + response.age + "<br>Date of Birth: " + response.dob + "<br>Contact: " + response.contact);
    },
    error: function(xhr, status, error){
        console.error(xhr.responseText);
        alert('Error occurred while fetching profile. Please try again.');
    }
  })
  $('#saveProfile').click(function(){
      var age = $('#age').val();
      var dob = $('#dob').val();
      var contact = $('#contact').val();
      var username = localStorage.getItem('username');
      
      // Show username in profile
      $('#name').text('Welcome, ' + username + '!');
      
      // AJAX request to update profile
      $.ajax({
          type: 'POST',
          url: './php/profile.php',
          data: { age: age, dob: dob, contact: contact, username: username },
          success: function(response){
            if (response === 'success') {
              alert('Profile updated successfully!');
              window.location.reload();
            } else {
              alert('Error occurred while updating profile. Please try again.');
            }
          },
          error: function(xhr, status, error){
              console.error(xhr.responseText);
              alert('Error occurred while updating profile. Please try again.');
          }
      });
  });
});
