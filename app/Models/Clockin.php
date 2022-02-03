<?php

namespace App\Models;

use DateTimeInterface;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Clockin
 * @package App\Models
 * @version December 29, 2021, 9:18 am UTC
 *
 * @property string $date
 * @property string $type
 * @property string $name
 * @property integer $user_id
 * @property string|\Carbon\Carbon $start_time
 * @property string|\Carbon\Carbon $end_time
 * @property string $over_time
 * @property string $late_time
 * @property string $leave_early_time
 * @property string $total
 * @property string $verify
 * @property string $note
 */
class Clockin extends Model
{
    use SoftDeletes;

    public $table = 'clockin';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'date',
        'type',
        'name',
        'user_id',
        'start_time',
        'end_time',
        'over_time',
        'late_time',
        'leave_early_time',
        'total',
        'verify',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'string',
        'type' => 'string',
        'name' => 'string',
        'user_id' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'over_time' => 'string',
        'late_time' => 'string',
        'leave_early_time' => 'string',
        'total' => 'string',
        'verify' => 'string',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'user_id' => 'required|integer',
        'start_time' => 'nullable',
        'end_time' => 'nullable',
        'over_time' => 'nullable|string|max:255',
        'late_time' => 'nullable|string|max:255',
        'leave_early_time' => 'nullable|string|max:255',
        'total' => 'nullable|string|max:255',
        'verify' => 'required|string|max:255',
        'note' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
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
