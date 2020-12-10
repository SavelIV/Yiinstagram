<?php
return [
    'adminEmail' => 'saviv@saviv.site',
    'supportEmail' => 'saviv@saviv.site',
    'senderEmail' => 'noreply@saviv.site',
    'senderName' => 'saviv.site mailer',
    'shortTextLimit' => 90,
    'maxNewsInList' => 7,

    'maxFileSize' => 1024 * 1024 * 4, // 4 megabites
    'storagePath' => '@frontend/web/uploads/',
    'storageUri' => '/uploads/',   // http://yii2site.com/uploads/f1/d7/739f9a9c9a99294.jpg

    'postPicture' => [
        'maxWidth' => 1024,
        'maxHeight' => 920,
    ],
    'profilePicture' => [
        'maxWidth' => 800,
        'maxHeight' => 600,
    ],
    'feedPostLimit' => 200,
];
