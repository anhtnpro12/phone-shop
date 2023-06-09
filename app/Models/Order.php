<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'total_price',
        'payment_mode',
        'payment_id',
        'ship_id',
        'status',
        'comments'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment() {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function ship() {
        return $this->belongsTo(Ship::class, 'ship_id');
    }

    public function order_items() {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
