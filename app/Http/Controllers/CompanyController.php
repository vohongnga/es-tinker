<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Company;
use App\Models\Progress;
class CompanyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $company = Company::find('4700eee4-fb98-440b-87cc-f5c0f691da13');
        $partners = $company->partners;
        //$jobtypes = [];
        // foreach ($partners as $partner) {
        //     foreach ($partner->jobs as $job) {
        //        foreach ($job->orders as $order) {
                   
        //        }
        //     }
        // }
        return view('index',compact('partners'));
    }

    public function progress () {
        $progress=Progress::all()->whereNull('deleted_at');
        return view('progress', compact('progress'));
    }
}
