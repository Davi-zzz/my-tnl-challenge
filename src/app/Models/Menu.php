<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurants;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'restaurant_id'
    ]; 
    protected $table = 'menus';

    public function restaurants()
    {
        return $this->belongsTo(Restaurants::class);       
    }
    public function dishes() {
        return $this->hasMany(Dishe::class, 'menu_id');
    }
    public function status(){
        return [
            0 => 'Desabilitado',
            1 => 'Habilitado'
        ];
    }
}
