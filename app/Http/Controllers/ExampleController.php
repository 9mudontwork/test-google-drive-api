<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
