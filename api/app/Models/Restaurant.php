<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    // protected $hidden = [];

    protected $fillable = [
        'name',
        'cnpj',
        'phone',
        'address',
        'zip_code',
        'location',
        'state',
        'created_by',
        'status',

    ];
    protected $table = 'restaurants';

    protected $appends = [
        'status_desc',
    ];

    public function getStatusDescAttribute()
    {
        return $this->status()[$this->status];
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function menus()
    {
        return $this->hasMany(Menu::class, 'restaurant_id');
    }
    public function status()
    {
        return [
            0 => 'Desabilitado',
            1 => 'Habilitado',
        ];
    }
}
