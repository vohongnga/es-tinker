<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\CompanyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});

Route::get('/find-base', function() {
    dd($user = User::join('bases_departments_teams', 'bases_departments_teams.id','=', 'users.base_department_team_id')->where('company_id','176363c1-db87-43a8-a06c-2f67ec12903a')->get());
});

Route::get('/create-user', function() {
    $result = User::create([
        'id'=>'87271b66-a22f-40b2-90be-6c3e2e0c415b',
        'last_name'=>'Vo',
        'first_name'=>'Nga',
        'role_id'=>4,
        'email'=>'ngahaha',
        'password'=>'skjdkasdjksfkshfkiweda',
        'company_id'=>'dsfdsfcsdfasdas',
        'base_department_team_id'=>'52255261-6848-47c0-92fe-94295223c574',
    ]);
echo $result;
});
Route::get('/progress',[CompanyController::class,'summary']);
Route::get('/search',[CompanyController::class,'searchUser']);
Route::get('/history',[CompanyController::class,'history']);
Route::get('/job',[CompanyController::class,'job']);
Route::get('/partner', [CompanyController::class,'partners']);
Route::get('/company/{id}',[CompanyController::class, 'getOrderCompany'])->name('company');
