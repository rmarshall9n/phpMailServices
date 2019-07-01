<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

function get_include_contents($filename, $data = [])
{
    if (is_file($filename)) {
        ob_start();
        include $filename;

        return ob_get_clean();
    }

    return false;

}

/**
 * Start Application
 */

$config = include 'src/config.php';

$mailer = new \App\Mail($config);

$to = 'ryan@require-dev.com';
$from = 'from@require-dev.com';
$subject = 'Test Subject';

$content = get_include_contents('src/views/message_email.php');

$response = $mailer
    ->to($to)
    ->toMany([$to, 'to@b.com'])
    ->from($from)
    ->subject($subject)
    ->content($content)
    ->send();

echo '<pre>';
var_dump($response);
echo '</pre>';
