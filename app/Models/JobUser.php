<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobUser extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'user_id'
    ];

    /**Get user of jobUser
     *
     * @return mixed
    */
    protected function user() {
        return $this->belongsTo(User::class);
    }

    /**Get job of jobUser
     *
     * @return mixed
    */
    protected function job() {
        return $this->belongsTo(Job::class);
    }
}
