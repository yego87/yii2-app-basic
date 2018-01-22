<?php

return [
    [
        'id' => 1,
        'email' => 'test@email.com',
        'phone' => '+375-44-5556677',
        'username' => 'Ivan Ivanov',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('test')
    ]
];