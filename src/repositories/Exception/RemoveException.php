<?php

namespace App\Repositories\Exception;

use Exception;
use Throwable;

class RemoveException extends Exception {
    
    public function __construct(string $message = "" , int $code = 0 , Throwable|null $previous = null) {
        $this->message = $message;
    }
}