<?php

namespace App\Models;

use DateTimeInterface;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LineConfig
 * @package App\Models
 * @version May 27, 2021, 2:34 pm UTC
 *
 * @property string $name
 * @property string $val
 * @property string $nickname
 */
class LineConfig extends Model
{
    use SoftDeletes;

    public $table = 'line_configs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'val',
        'nickname'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'val' => 'string',
        'nickname' => 'string'
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
