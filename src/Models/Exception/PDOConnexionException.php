<?php
namespace App\Models\Exception;

use Exception;
use Throwable;

class PDOConnexionException extends Exception {
    public function __construct (string $message = "unexpected error", int $code = 0, Throwable|null $previous = null) {
        $this->message = $message;
    }
}