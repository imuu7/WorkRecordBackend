<?php

namespace App\Models;

use DateTimeInterface;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reservation
 * @package App\Models
 * @version August 3, 2021, 12:16 pm UTC
 *
 * @property string $name
 * @property string $reserve_time
 * @property string $reserve_items
 * @property string $phone
 * @property string $note
 */
class Reservation extends Model
{
    use SoftDeletes;

    public $table = 'reservations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'reserve_time',
        'reserve_items',
        'phone',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'reserve_items' => 'string',
        'phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    

    

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
