<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 *
 *
 * กำลัง research
 *
 *
 */

/**
 * docs oauth
 * https://github.com/googleapis/google-api-php-client/blob/master/docs/oauth-web.md
 * https://developers.google.com/identity/protocols/oauth2/web-server#php
 *
 * docs เอา token
 * https://github.com/googleapis/google-api-php-client/blob/master/examples/idtoken.php
 *
 * docs google drive api v3
 * https://developers.google.com/drive/api/v3/about-files
 */

use Illuminate\Http\Request;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/auth-code', function () {
    $authConfig = base_path('client_secret.json');
    $googleClient = new Google\Client();
    $googleClient->setAuthConfig($authConfig);
    $googleClient->setRedirectUri(url('/callback'));
    $googleClient->setScopes(Google_Service_Drive::DRIVE);
    $googleClient->setApprovalPrompt('force');
    $googleClient->setAccessType('offline');
    $authUrl = $googleClient->createAuthUrl();

    return $authUrl;
});

$router->get('callback', function (Request $request) {
    return $request->all();
});

$router->get('access-token', function () {
    $authCode = '';
    $authConfig = base_path('client_secret.json');
    $googleClient = new Google\Client();
    $googleClient->setAuthConfig($authConfig);
    $googleClient->setRedirectUri(url('/callback'));
    $googleClient->setScopes(Google_Service_Drive::DRIVE);
    $googleClient->setAccessType('offline');
    $googleClient->fetchAccessTokenWithAuthCode($authCode);
    $accessToken = $googleClient->getAccessToken();

    return $accessToken;
});

$router->get('refresh-access-token', function () {
    $refreshToken = config('filesystems.disks.google.refreshToken');
    $authConfig = base_path('client_secret.json');
    $googleClient = new Google\Client();
    $googleClient->setAuthConfig($authConfig);
    $googleClient->setScopes(Google_Service_Drive::DRIVE);
    $googleClient->refreshToken($refreshToken);
    $accessToken = $googleClient->getAccessToken();

    return $accessToken;
});

$router->get('files', function () {
    $accessToken = '';
    $googleClient = new Google\Client();
    $googleClient->setAccessToken($accessToken);

    $drive = new Google_Service_Drive($googleClient);
    $files = $drive->files->listFiles([
        'q' => "name contains 'one piece'",
        'fields' => 'files(id,mimeType,name)',
    ])->getFiles();

    return $files;
});
