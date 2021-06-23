<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'content'
    ];

    /**Get order detail of order
     *
     * @return mixed
     */
    public function orderDetail() {
        return $this->hasMany(OrderDetail::class);
    }
}
