<?php

namespace App\Http\Controllers;

use Google\Client as GoogleClient;
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
}
