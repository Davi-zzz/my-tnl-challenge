<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
        'reponsible_id',
        'status'

    ]; 
    protected $table = 'restaurants';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function menus(){
        return $this->hasMany(Menu::class, 'restaurant_id');
    }
    public function status(){
        return [
            0 => 'Desabilitado',
            1 => 'Habilitado'
        ];
    }
}
