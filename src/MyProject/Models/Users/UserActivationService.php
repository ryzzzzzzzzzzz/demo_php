<?php

namespace MyProject\Models\Users;

use MyProject\Models\Users\User;

use MyProject\Services\EmailSender;

class UserActivationService
{
    public static function sendConfirmationEmail(User $user): void

    {

        $token = sha1(random_bytes(100)) . sha1(random_bytes(100));

        $user->activationToken = $token;

        $user->save();

        EmailSender::send(

            $user->getEmail(),

            'Подтвердите регистрацию',

            "Перейдите по ссылке: http://demo/www/users/activate?token=$token"
        );
    }

    public static function activate(string $token): ?User

    {
        $user = User::findOneByColumn('activationToken', $token);

        if ($user !== null) {

            $user->isConfirmed = true;

            $user->activationToken = null;

            $user->save();

        }
        
        return $user;
    }
}