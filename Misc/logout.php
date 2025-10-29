<?php

session_start();    // Initialize the session//


$_SESSION = []; // Unset all of the session variables//

    // this kills the session, also delete the session cookie.//
if (ini_get('session.use_cookies')) 
{
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

session_destroy();  // Destroy the session//    


    // Redirects to login page//
$redirect = '/index.php';

    // Ensure no output has been sent before redirecting//
if (!headers_sent()) 
{
    header('Location: ' . $redirect);
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">   
    <meta http-equiv="refresh" content="2;url=<?php echo htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8'); ?>"> <!-- Redirect after 2 seconds -->
    <title>Logged out</title>
</head>
<body>  <!-- Message for users without redirection -->
    <p>You have been logged out. <a href="<?php echo htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8'); ?>">Click here</a> if you are not redirected.</p>
</body>
</html>