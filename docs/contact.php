<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Load config for email credentials
$config = require 'emailcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message'])); // Preserves line breaks

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['email'];
        $mail->Password   = $config['app_password'];
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // From & To
        $mail->setFrom($config['email'], 'Luna Contact Bot');
        $mail->addAddress($config['email'], 'Luna Admin');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Luna Contact Form: $subject";
        $mail->Body    = "
            <h2>New Message for Luna</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>{$message}</p>
            <hr>
            <p style='font-size:12px;color:#888;'>This message was sent via Luna's AI Music Chatbot contact form.</p>
        ";

        $mail->send();
        // Success - You can add a redirect or success prompt here if needed
    } catch (Exception $e) {
        // Handle failure if needed
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Contact.css">
  <title>Contact Us</title>
  <link rel="icon" href="Images/favi.svg" type="image/png">
</head>
<body>
<?php include 'lnav.php'; ?>
<div class="container">
    <div class="content">
        <div class="text">
            <h1>Contact Us</h1>
            <p>Feel free to contact us and we will get back to you as soon as we can.</p>
        </div>
        <form method="POST" class="form">
            <div class="input-group">
                <input type="text" name="name" id="name" class="input-field" placeholder="Enter Name" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" class="input-field" placeholder="Enter Email" required>
            </div>
            <div class="input-group">
                <input type="text" name="subject" id="subject" class="input-field" placeholder="Enter Subject" required>
            </div>
            <div class="input-group">
                <textarea name="message" id="message" class="input-field" cols="30" rows="10" placeholder="Enter Message you want to convey" required></textarea>
            </div>
            <input type="submit" value="Send" class="submit-btn">
        </form>
    </div>
</div>

<script>
  const navLinks = document.querySelectorAll('.navigation a');
  const currentPath = window.location.pathname;

  navLinks.forEach(link => {
    if (link.getAttribute('href').includes(currentPath)) {
      link.classList.add('active');
    }
  });
</script>
</body>
</html>
