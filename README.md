# Guvi Task - User Registration and Login System

This project implements a user registration and login system using HTML, CSS, JavaScript (jQuery), and PHP. It allows users to register with a unique username and email, and then login to access their profile.

## Features

- User Registration: Users can register by providing a unique username, email, and password.
- Password Hashing: User passwords are hashed using PHP's built-in `password_hash()` function for security.
- Unique Constraints: Both username and email fields have unique constraints to prevent duplicate registrations.
- Login System: Registered users can login with their username and password.
- Session Management: User sessions are managed using browser local storage (no PHP sessions are used).
- Database Integration: User registration and login data are stored in a MySQL database while the profile data for the particular user is stored in MongoDB.
- Responsive Design: The forms are designed using Bootstrap, ensuring responsiveness across various devices.

## Folder Structure

- `css/`: Contains CSS files for styling.
- `js/`: Contains JavaScript files for frontend logic.
- `php/`: Contains PHP files for server-side logic.
- `index.html`: Homepage with links to register and login.
- `register.html`: User registration page.
- `login.html`: User login page.
- `profile.html`: User profile page.
- `README.md`: This README file.

## Setup

1. Clone the repository to your local machine.
2. Set up a local development environment with PHP, MySQL and MongoDB and carefully place the ddl files in the `php.ini` file in your php folder.
3. Configure your database connection details in the PHP files (`register.php`, `login.php`, `profile.php`.).
4. Open the project in your web browser to start using the user registration and login system.

## Result

 ![Result Image](<Screenshot (202).png>) ![Result Image](<Screenshot (203).png>) ![Result Image](<Screenshot (204).png>) ![Result Image](<Screenshot (205).png>) ![Result Image](<Screenshot (206).png>) ![Result Image](<Screenshot (207).png>) ![Result Image](<Screenshot (208).png>) ![Result Image](<Screenshot (209).png>) ![Result Image](<Screenshot (210).png>) ![Result Image](<Screenshot (211).png>) ![Result Image](<Screenshot (212).png>)

## Contributing

Contributions are welcome! If you'd like to contribute to this project, feel free to submit a pull request with your changes or open an issue for any feature requests or bug reports.
