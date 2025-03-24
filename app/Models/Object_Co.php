<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Object_Co extends Model
{
    use HasFactory;

    protected $table = 'object_cos';

    protected $fillable = ['name', 'type', 'status', 'location'];

    public static function getStatusOptions(){
        return ['en marche', 'éteint', 'Maintenance'];
    }

    public function setStatusAttribute($value){
        if(!in_array($value, self::getStatusOptions())){
            throw new \InvalidArgumentException("Statut invalide : {$value}");
        }
        $this->attributes['status']=$value;
    }

}
