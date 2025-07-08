<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // -------------------- REGISTER --------------------
    if (isset($_POST['register'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error_register'] = "All fields are required.";
            header("Location: login.php");
            exit();
        }

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION['error_register'] = "Email already registered.";
            $stmt->close();
            header("Location: login.php");
            exit();
        }
        $stmt->close();

        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success_register'] = "Registration successful! Please log in.";
        } else {
            $_SESSION['error_register'] = "Error registering user.";
        }
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit();
    }

    // -------------------- LOGIN --------------------
    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $_SESSION['error_login'] = "Email and Password are required.";
            header("Location: login.php");
            exit();
        }

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            // DO NOT hash again! Use password_verify
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $conn->close();
                header("Location: Home.php");
                exit();
            } else {
                $_SESSION['error_login'] = "Invalid email or password.";
            }
        } else {
            $_SESSION['error_login'] = "Invalid email or password.";
        }

        $conn->close();
        header("Location: login.php");
        exit();
    }
}
?>