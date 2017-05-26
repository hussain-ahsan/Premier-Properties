<?php

namespace App\Http\Controllers;

use App\Company;
use App\Roles;
use App\States;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Create a new User controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User();
        $this->role = new Roles();
        $this->company = new Company();
        $this->states = new States();
    }

    /**
     * This method is used to show User Form
     */
    public function showUsers()
    {
        $userListing = $this->user->fetchUsersAndRelatedData();
        $allRoles = $this->role->fetchRoles(['id', 'name']);
        $allCompanies = $this->company->fetchCompanies(['id', 'name']);
        $allStates = $this->states->getStates();
        return view('users/users', ['companies' => $allCompanies, 'roles' => $allRoles, 'states' => $allStates, 'userListing' => $userListing]);
    }

    /**
     * This method is used to save User
     */
    public function saveUser(UserRequest $request)
    {
        return $this->user->saveUserRecord($request);
    }

    /**
     * This method is used to update User
     */
    public function updateUser(UserRequest $request)
    {
        return $this->user->updateUserRecord($request);
    }

    /**
     * This method is used to reset User password
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function resetPassword(Request $request)
    {
        return $this->user->resetPassword($request);
    }
}
