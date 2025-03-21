<?php declare(strict_types = 1);

namespace SecureEnvPHP;

use Dotenv\Dotenv;

class SecureEnvPHP
{
    public function parse(string $path = Constants::ENV_ENC, string $secret = '', string $algo = Constants::ALGO): void
    {
        if ($decrypted = (new Crypto())->decrypt($path, $secret, $algo)) {
            $parsed = Dotenv::parse($decrypted) ?? [];

            foreach ($parsed as $key => $value) {
                if (isset($parsed[$key]) && !empty($parsed[$key])) {
                    $_ENV[$key] = $value;
                }
            }
        }
    }
}
