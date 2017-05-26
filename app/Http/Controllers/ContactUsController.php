<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContactUsController extends Controller
{
    /**
     * Create a new ContactUs controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->contactUs = new ContactUs();
    }

    public function contactUs(Request $request)
    {
        return $this->contactUs->contactUs($request);
    }

}