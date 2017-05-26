<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    /**
     * loginController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @return => redirect the user to login page and to homepage if the user is logged in
     */
    public function index()
    {
        if (Auth::user()) {
            return redirect('/home');
        }
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return => redirect the user to homepage after login OR return whatever the error message is
     */
    function login(Request $request)
    {
        $loginUser = $this->user->loginUser($request);//-> loginUser($request);
        if ($loginUser->contains('success')) {
            return redirect('/home');
        } else {
            return redirect()->back()->with($loginUser['status'], $loginUser['message']);
        }
    }

    /**
     * @return => redirects to login after logging out the user
     */
    function logout()
    {
        $this->user->logoutUser();
        return redirect('/login');
    }
}
