<?php

namespace App\Repositories;

use App\Models\tel_msg_log;
use App\Repositories\BaseRepository;

/**
 * Class tel_msg_logRepository
 * @package App\Repositories
 * @version June 5, 2021, 8:34 pm UTC
*/

class tel_msg_logRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'message_id',
        'msg_from_id',
        'msg_from_body',
        'message_date',
        'chat_body',
        'chat_text'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return tel_msg_log::class;
    }
}
