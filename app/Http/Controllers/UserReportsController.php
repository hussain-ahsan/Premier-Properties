<?php

namespace App\Http\Controllers;

use App\UserReports;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response as response;
use Illuminate\Support\Facades\File;

class UserReportsController extends Controller
{
    /**
     * Create a new Property Reports controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userReports = new UserReports();
    }

    /**
     * This method is used to get existing user reports
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getPropertyReport()
    {
        $reports = $this->userReports->getUserReports();
        return collect(['status' => 'success', 'record' => $reports]);
    }

    public function downloadUserReport(Request $request)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . $request['env']."/" . $request['name'];
        if(File::exists($file)) {
            return response()->download($file, substr(strstr($file, '__'), 2));
        } else {
            return redirect('/404');
        }
    }


}
