<?php

namespace App\Http\Controllers;

use Google\Client as GoogleClient;
use Google_Service_Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class ExampleController extends Controller
{
    /**
     * docs oauth
     * https://github.com/googleapis/google-api-php-client/blob/master/docs/oauth-web.md
     * https://developers.google.com/identity/protocols/oauth2/web-server#php
     *
     * docs เอา token
     * https://github.com/googleapis/google-api-php-client/blob/master/examples/idtoken.php
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        dd(Storage::disk('google')->allFiles());
        return 'test example';
    }

    public function getAccessTokens()
    {
        $googleClient = new GoogleClient();
        $googleClient->setAuthConfig($this->getAuthConfigFile());
        $googleClient->setRedirectUri(url('/callback'));
        $googleClient->setScopes('email');
        $googleClient->setAccessType('offline');

        if ($googleClient->getAccessToken()) {
            return $googleClient->verifyIdToken();
        } else {
            return $googleClient->createAuthUrl();
        }
    }

    protected function getAuthConfigFile()
    {
        $authConfigPath = base_path('client_secret.json');

        if (\file_exists($authConfigPath)) {
            return $authConfigPath;
        }

        return false;
    }

    public function callback(Request $request)
    {
        return $request->all();
    }
}
