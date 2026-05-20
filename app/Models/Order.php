<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'status', 'total', 'name', 'phone',
        'address', 'comment', 'payment_method', 'admin_note',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'Ожидает подтверждения',
            'confirmed' => 'Подтверждён',
            'shipped'   => 'Отправлен',
            'delivered' => 'Доставлен',
            'cancelled' => 'Отменён',
            default     => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'yellow',
            'confirmed' => 'blue',
            'shipped'   => 'purple',
            'delivered' => 'green',
            'cancelled' => 'red',
            default     => 'gray',
        };
    }
}
