<?php

namespace App\Models;

use App\Models\Restaurants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'restaurant_id',
    ];
    protected $table = 'menus';

    protected $appends = [
        'status_desc',

    ];

    public function getStatusDescAttribute()
    {
        return $this->status()[$this->status];
    }

    public function restaurants()
    {
        return $this->belongsTo(Restaurants::class);
    }
    public function dishes()
    {
        return $this->hasMany(Dishe::class, 'menu_id');
    }
    public function status()
    {
        return [
            0 => 'Desabilitado',
            1 => 'Habilitado',
        ];
    }
}
