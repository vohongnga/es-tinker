<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partners';

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
        'id','company_id', 'tel', 'address'
    ];

    public function company () {
        return $this->belongsTo(Company::class,'company_id');
    }

    /**Get partner job type of partner
     *
     * @return mixed
     */
    public function partnerJobType() {
        return $this->hasMany(PartnerJobType::class);
    }

    /**Get job for partner
     *
     * @return mixed
     */
    public function jobs() {
        return $this->hasMany(Job::class)->whereNull('deleted_at');
    }
}
