<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IotDevice extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'status', 'location'];

    public static function getStatusOptions(){
        return ['en marche', 'éteint', 'Maintenance'];
    }

    public function setStatusAttribute($value){
        if(!in_array($value, self::getStatusOptions())){
            throw new \InvalideArgumentException("Statut invalide : {$value}");
        }
        $this->attribute['status']=$value;
    }

}
