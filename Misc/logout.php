<?php
// logout.php
// Destroys the session, clears related cookies, and redirects to login.

session_start();

// Clear all session variables
$_SESSION = [];

// Delete session cookie if present
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destroy the session
session_destroy();


// Redirect target
$redirect = '/index.php';

// Redirect if possible, otherwise show a fallback HTML page
if (!headers_sent()) {
    header('Location: ' . $redirect);
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="2;url=<?php echo htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8'); ?>">
    <title>Logged out</title>
</head>
<body>
    <p>You have been logged out. <a href="<?php echo htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8'); ?>">Click here</a> if you are not redirected.</p>
</body>
</html>