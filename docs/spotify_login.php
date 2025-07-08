<?php
session_start();
include 'db.php'; // Your DB connection

$client_id = '4e12eaba53aa4a29ae8f90f6f729d807';
$client_secret = '067779e44f0e4a99ad3df67614c8a07a';
$redirect_uri = 'https://664df084750f.ngrok-free.app/Luna/docs/spotify_login.php';

if (!isset($_GET['code'])) {
    $authorize_url = 'https://accounts.spotify.com/authorize?' . http_build_query([
        'response_type' => 'code',
        'client_id' => $client_id,
        'scope' => 'user-read-private user-read-email',
        'redirect_uri' => $redirect_uri,
    ]);

    header('Location: ' . $authorize_url);
    exit;
}

// Step 2: Get token
$code = $_GET['code'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => $redirect_uri,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
]));
$response = curl_exec($ch);
curl_close($ch);
$token_info = json_decode($response, true);

if (!isset($token_info['access_token'])) {
    echo "❌ Failed to get token.";
    exit;
}

// Step 3: Get Spotify user
$access_token = $token_info['access_token'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/me');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $access_token
]);
$profile_response = curl_exec($ch);
curl_close($ch);

$spotify_user = json_decode($profile_response, true);

if (!isset($spotify_user['email'])) {
    echo "❌ Could not fetch Spotify user info.";
    exit;
}

$email = $spotify_user['email'];
$username = $spotify_user['display_name'] ?? $spotify_user['id'];

// ----------------- CHECK USER -----------------
$stmt = $conn->prepare("SELECT id, username FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($user) {
    // ✅ Existing user: log them in
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
} else {
    // ✅ New user: create account with random password
    $random_password = bin2hex(random_bytes(8));
    $hashed_password = password_hash($random_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $username;
    } else {
        echo "❌ Failed to create user.";
        exit;
    }
    $stmt->close();
}

$conn->close();

// ✅ Redirect to your home page
header("Location: index.php");
exit();
?>