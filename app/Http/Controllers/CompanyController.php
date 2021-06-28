<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Company;
use App\Models\Role;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Department;
use App\Models\History;
use App\Models\Partner;


class CompanyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**Get list company
     *
     * @return view
     */
    public function summary () {
        $companies = Company::whereNull('deleted_at')->select('id','abbreviation')->get();
        return view('progress',compact('companies'));
    }

    /**Get orders of company
     *
     * @param String id
     * @return view
     */
    public function getOrderCompany($id) {
        $company = Company::with('partners.jobs.orders.orderDetail.orderTypeDetail.orderType')->find($id);
        $result = [];
        foreach ($company->partners as $partner) {
            foreach( $partner->jobs as $job) {
                $result = $this->groupOrder($job,$result);
            }
        }
        foreach ($result as $orderType=>$order) {
           echo '<h5>'.$orderType.'</h5>';
           echo '<table>
               <tr>
                   <th>依頼業務</th>
                   <th>合計l</th>
               </tr>';
               foreach ($order as $item) {
               echo '<tr>
                   <td>'.$item.'</td>
                   <td>0 point</td>
               </tr>';
        }
           echo '</table>';
    }

    }

    /**search users by lastname, email, company, team, base
     *
     * @retrun mixed
     */
    public function searchUser() {
        $users = User::with('company')->join('bases_departments_teams', 'bases_departments_teams.id','=', 'users.base_department_team_id')->where('company_id','176363c1-db87-43a8-a06c-2f67ec12903a')->where('base_department_team_id','eac4e828-7004-4477-beef-f896af2139f8')->where('base_id','eab8cfe6-5981-4c2b-a838-51752903f57a')->where('last_name','LIKE','%ng%')->where('email','LIKE','%h%')->get();
        dd($users);
    }

    /**Log history
     *
     * $return mixed
     */
    public function history() {
        $history = History::with('user')->limit(10)->get();
        dd($history);
    }

    /**Get job detail
     *
     * @return mixed
     */
    public function job() {
        $orders = [];
        $job = Job::with(['orderedPerson.company','users'=>function($q){
            $q->whereNull('deleted_at');
        },'users.company','typeOfJob','orders.orderDetail.orderTypeDetail.orderType','comments.user'])->where('id','290003d6-b871-4ecd-a122-50e68917ed7d')->first();
        $orders = $this->groupOrder($job,$orders);
        return view('index',compact('job','orders'));
    }

    /**Group orderdetail by ordertype of job
     *
     *@param job, array result
     * $return array
     */
    public function groupOrder(Job $job,$result) {
        foreach ($job->orders as $order) {
            foreach ($order->orderDetail as $detail) {
                $orderType = $detail->orderTypeDetail->orderType->title;
                if (!array_key_exists($orderType,$result)) {
                    $result[$orderType] = [];
                    $result[$orderType][]= $detail->orderTypeDetail->title;
                }
                else if(!in_array($detail->orderTypeDetail->title,$result[$orderType])){
                    $result[$orderType][]= $detail->orderTypeDetail->title;
                }
            }
        }
        return $result;
    }

    /**Get list partner and job type
     *
     * @return mixed
     */

     public function partners() {
        $partners = Partner::with(['partnerJobType.jobtype.jobs.orders.orderDetail','partnerJobType.jobtype.jobs.orderedPerson.base_department_team.base','jobs',
        'company'=>function ($q) {
            $q->whereNull('deleted_at');
        }])->whereNull('deleted_at')->get();
        return view ('partner',compact('partners'));
    }


}
