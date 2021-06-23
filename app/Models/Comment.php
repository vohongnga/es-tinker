<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

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
        'user_id', 'job_id', 'message'
    ];

    /**Get user of comment
     *
     * @return mixed
    */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**Get job of comment
     *
     * @return mixed
     */
    public function job() {
        return $this->belongsTo(Job::class);
    }
}
