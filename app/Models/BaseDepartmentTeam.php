<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseDepartmentTeam extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bases_departments_teams';

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
        'base_id', 'department_id', 'team'
    ];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**Get base of base_department_team
     *
     * rerturn @mixed
    */
    public function base() {
        return $this->belongsTo(Base::class, 'base_id');
    }

    /**Get department of base_department_team
     *
     * rerturn @mixed
    */
    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**Get users of team
     *
     * @return mixed
    */
    public function users() {
        return $this->hasMany(User::class);
    }
}
