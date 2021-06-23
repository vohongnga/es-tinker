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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'tel', 'address',
    ];

    /**Get jobs of partner
     *
     * @return mixed
    */
    // public function jobs() {
    //     return $this->hasMany(Job::class);
    // }

    /**Get company of partner
     *
     * @return mixed
    */
    public function company () {
        return $this->belongsTo(Company::class);
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
