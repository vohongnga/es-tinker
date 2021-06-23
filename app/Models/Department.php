<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**Get base_department_team of department
     *
     * @return mixed
     */
    protected function BaseDepartmentTeams() {
        return $this->hasMany(BaseDepartmentTeamTeam::class);
    }
}
