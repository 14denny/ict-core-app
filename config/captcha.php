<?php
return [
    'width' => env('CAPTCHA_IMG_WITDH', 200),
    'height' => env('CAPTCHA_IMG_HEIGHT', 50),
    'session'=>env('CAPTCHA_SESSION_NAME', 'captcha_text')
];
