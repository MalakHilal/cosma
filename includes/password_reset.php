<?php
/**
 * Create a simple password reset code and attempt to send it by email.
 * Returns an array with keys: 'sent' (bool) and 'code' (string).
 */
function createPasswordResetCode(array $client): array
{
    try {
        $code = (string) random_int(100000, 999999);
    } catch (Exception $e) {
        $code = strval(mt_rand(100000, 999999));
    }

    $sent = false;
    if (!empty($client['email']) && function_exists('mail')) {
        $to = $client['email'];
        $subject = "Réinitialisation de mot de passe";
        $message = "Votre code de réinitialisation est : " . $code;
        $headers = "From: no-reply@localhost\r\n";
        $sent = @mail($to, $subject, $message, $headers);
    }

    if (session_status() !== PHP_SESSION_ACTIVE) {
        @session_start();
    }

    $_SESSION['password_reset_code'] = $code;
    $_SESSION['password_reset_email'] = $client['email'] ?? '';
    $_SESSION['password_reset_time'] = time();

    return ['sent' => (bool) $sent, 'code' => $code];
}

?>