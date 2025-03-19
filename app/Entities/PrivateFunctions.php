<?php 
namespace Project\App\Entities;
class PrivateFunctions{


    public function verificationCode()
    {
        $verification = random_int(100000, 999999);
        return $verification;
    }

    public function generateJWT($id, $email, $secret_key)
    {
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode([
            'iss' => "your_website.com",
            'aud' => "your_website.com",
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'data' => [
                'id' => $id,
                'email' => $email
            ]
        ]);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $secret_key, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
    }

    public function generateToken()
    {
        $randomToken = rand(100000, 999999);
        return $randomToken;
    }
}