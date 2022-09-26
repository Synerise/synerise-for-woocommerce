<?php

namespace Synerise\IntegrationCore;

class Uuid
{
    public static function generateUuidByEmail($email)
    {
        /* @todo: consider domain based namespace */
        $namespace = 'ea1c3a9d-64a6-45d0-a70c-d2a055f350d3';
        return (string) \Rhumsaa\Uuid\Uuid::uuid5($namespace, $email);
    }
}
