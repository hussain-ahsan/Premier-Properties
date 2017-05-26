<?php

namespace App\Http\Controllers;

use App\Company;
use App\States;
use Illuminate\Database\QueryException as queryException;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Create a new company controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->comapny = new Company();
        $this->states = new States();
    }

    /**
     * Fetch all the data related to companies and pass to the companies view.
     *
     * @return null|string
     */
    public function index(Request $request)
    {
        $companies = $this->comapny->fetchCompanyRecord();
        $states = $this->states->getStates();
        return View('companies.companies', ['company' => $companies, 'states' => $states]);
    }

    /**
     * Fetch all the data related to companies and pass to the companies view.
     *
     * @return null|string
     */
    public function saveCompany(CompanyRequest $request)
    {
        try {
            $companyResult = $this->comapny->saveCompanyRecord($request);
            return collect(['status' => 'success', 'message' => $companyResult]);
        } catch (queryException $e) {
            return collect(['status' => 'failure', 'message' => 'Something went wrong, Please try again later']);
        }
    }

    /**
     * update all the data related to companies and pass to the companies view.
     *
     * @return null|string
     */
    public function updateCompany(CompanyRequest $request)
    {
        try {
            $companyResult = $this->comapny->updateCompanyRecord($request);
            return collect(['status' => 'success', 'message' => $companyResult]);
        } catch (queryException $e) {
            return collect(['status' => 'failure', 'message' => 'Something went wrong, Please try again later']);
        }
    }
}
