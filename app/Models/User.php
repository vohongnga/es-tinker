<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','last_name', 'first_name', 'email', 'role_id', 'base_department_team_id', 'company_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**Relationship with model Company
     *
     *@return mixed
    */
    public function company() {
        return $this->belongsTo(Company::class,'company_id');
    }

    /**Get role of user
     *
     * @return mixed
    */
    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**Get base_department_team of user
     *
     * rerturn @mixed
    */
    public function base_department_team() {
        return $this->belongsTo(BaseDepartmentTeam::class, 'base_department_team_id');
    }

    /**Get job_user of user
     *
     * @return mixed
    */
    public function jobUsers() {
        return $this->hasMany(JobUser::class);
    }

     /**Get jobs of user
     *
     * @return mixed
    */
    public function jobs() {
        return $this->belongsToMany(Job::class, 'jobs_users', 'user_id','job_id');
    }

    /**Search
     *
     * @return mixed
     */
    public function search() {
        return User::where('last_name','LIKE','%a%')->first();
    }

    /**Get history of user
     *
     * @return mixed
     */
    public function history() {
        return $this->hasMany(History::class,'user_id','id');
    }
}
