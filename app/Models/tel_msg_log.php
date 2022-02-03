<?php

namespace App\Models;

use DateTimeInterface;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tel_msg_log
 * @package App\Models
 * @version June 5, 2021, 8:34 pm UTC
 *
 * @property string $message_id
 * @property integer $msg_from_id
 * @property string $msg_from_body
 * @property string|\Carbon\Carbon $message_date
 * @property string $chat_body
 * @property string $chat_text
 */
class tel_msg_log extends Model
{
    use SoftDeletes;

    public $table = 'tel_msg_log';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'message_id',
        'msg_from_id',
        'msg_from_body',
        'message_date',
        'chat_body',
        'chat_text'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'message_id' => 'string',
        'msg_from_id' => 'integer',
        'msg_from_body' => 'string',
        'message_date' => 'datetime',
        'chat_body' => 'string',
        'chat_text' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'message_id' => 'required|string|max:255',
        'msg_from_id' => 'required|integer',
        'msg_from_body' => 'required|string',
        'message_date' => 'required',
        'chat_body' => 'nullable|string',
        'chat_text' => 'nullable|string',
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
