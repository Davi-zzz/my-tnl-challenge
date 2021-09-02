<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Dishe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'menu_id',
        'type',
        'status'
    ]; 
    protected $table = 'dishes';

    public function menus()
    {
        return $this->belongsTo(Menu::class);
    }
    public function status(){
        return [
            0 => 'Desabilitado',
            1 => 'Habilitado'
        ];
    }
    public function type(){
        return [
            0 => 'Fritura',
            1 => 'Assado',
            2 => 'Cozido',
            3 => 'Grelhado',
            4 => 'Defumado',
            5 => 'Bebida',
            6 => 'Caldo'
        ];
    }
    public function category(){
        return [
            0 => 'Fast Food',
            1 => 'Caseiro',
            2 => 'Executivo',
            3 => 'Grelhado',
            4 => 'Sanduíche',
            5 => 'Sobremesa',
            6 => 'Natural',
            7 => 'Industrializado'

        ];
    }
}
