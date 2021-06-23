<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
class Job extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'partner_id', 'ordered_person_id', 'job_type_id', 'description', 'progress_detail_id', 'code',
    ];

    /**Get jobUser of job
     *
     * @return mixed
    */
    protected function jobUser() {
        return $this->hasMany(JobUser::class,'job_id');
    }

    /**Get users of job
     *
     * @return mixed
    */
    protected function users() {
        return $this->belongsToMany(User::class, 'jobs_users', 'job_id', 'user_id');
    }

    /**Get partner of job
     *
     * @return mixed
    */
    protected function partner() {
        return $this->belongsTo(Partner::class);
    }

    /**Get user order job
     *
     *@return mixed
    */
    protected function orderedPerson() {
        return $this->belongsTo(User::class,'ordered_person_id');
    }

    /**Get type of job
     *
     * @return mixed
     */
    protected function typeOfJob() {
        return $this->belongsTo(JobType::class,'job_type_id');
    }

    /**Get progress detail of job
     *
     * @return mixed
     */
    protected function progress() {
        return $this->belongsTo(ProgressDetail::class,'progress_detail_id');
    }

    /**Get comments of job
     *
     * @return mixed
     */
    protected function comments() {
        return $this->hasMany(Comment::class);
    }

    /**Get last comment of job */
    protected function getLastCommentAttribute() {
        return $this->hasMany(Comment::class)->orderBy('updated_at','DESC')->limit(1);
    }
}
