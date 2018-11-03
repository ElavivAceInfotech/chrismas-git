<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Children
 *
 * @package App
 * @property string $name
 * @property integer $age
 * @property string $gender
 * @property string $country
 * @property string $race
 * @property text $wishlist1
 * @property text $wishlist2
 * @property text $note
*/
class Children extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAgeAttribute($input)
    {
        $this->attributes['age'] = $input ? $input : null;
    }
    
}
