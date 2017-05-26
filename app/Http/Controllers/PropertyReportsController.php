<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\PropertyReports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyReportsController extends Controller
{

    /**
     * Create a new Property Reports controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->propertyReport = new PropertyReports();
        $this->notification = new Notifications();
    }

    /**
     * This method is used to save new property reports
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function savePropertyReport(Request $request)
    {
        return $this->propertyReport->savePropertyReportsRecord($request);
    }

    /**
     * This method is used to existing property reports
     * @param Request $request
     * @return mixed
     */
    public function updatePropertyReport(Request $request)
    {
        return $this->propertyReport->updatePropertyReportsRecord($request);
    }

    /**
     * This method is used to remove property report notifications
     * @param Request $request
     * @return mixed
     */
    public function removeReportNotifications(Request $request)
    {
        return $this->notification->removeNotifications($request);
    }

}
