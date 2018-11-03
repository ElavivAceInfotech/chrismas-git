<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Distributor
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property text $address
 * @property string $city
 * @property string $country
*/
class Distributor extends Model
{
    protected $fillable = ['name', 'email', 'address', 'city', 'country'];
    protected $hidden = [];
    
    
    
}
