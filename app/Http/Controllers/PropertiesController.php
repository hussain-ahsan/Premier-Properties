<?php

namespace App\Http\Controllers;

use App\Company;
use App\Property;
use App\States;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PropertiesController extends Controller
{
    /**
     * Create a new company controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->property = new Property();
        $this->states = new States();
        $this->companies = new Company();
    }

    public function index()
    {
        $states = $this->states->getStates();
        $companies = $this->companies->companyAssociatedWith();
        $properties = $this->property->getPropertiesForUser();

        return View('properties.properties', ['states' => $states, 'properties' => $properties, 'companies' => $companies]);
    }

    /**
     * @param Request $request
     * @return status if the property is get saved or not
     */
    public function saveProperty(Request $request)
    {
        $response = $this->property->saveProperty($request);
        return $response;
    }

    /**
     * @param Request $request
     * @return status, if the property gets updated or not
     */
    public function updateProperty(Request $request)
    {
        $response = $this->property->updateProperty($request);
        return $response;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getProperty(Request $request)
    {
    if (\Auth::User()->hasRole(env('ADMIN_ROLE'))) {
        $response = $this->property->fetchPropertyInvestors($request['id']);
        return collect(['status' => 'success', 'record' => $response]);
    } else {
        redirect('/404');
    }
}

    /**
     * This method is used to fetch single property information.
     * @param Request $request
     * @return mixed
     */
    public function singleProperty(Request $request)
    {
        $singleProperty = $this->property->fetchPropertyRelatedInformation($request);
        if(count($singleProperty) > 0) {
            return view('properties/singleProperty', ['singleProperty' => $singleProperty[0]]);
        } else {
            return redirect('/404');
        }
    }

    /**
     * This method is used to fetch all properties and send to portfolio page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function portfolio()
    {
        $states = $this->states->getStates();
        $allProperties = $this->property->fetchProperties();
        return view('portfolio/portfolio', ['allProperties' => $allProperties, 'states' => $states]);
    }

}
