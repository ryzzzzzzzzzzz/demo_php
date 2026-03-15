<?php

namespace MyProject\Services;

class EmailSender

{
    public static function send(string $to, string $subject, string $body): void
    
    {

        echo "<p>Email для $to: $subject — $body</p>";
    }
}