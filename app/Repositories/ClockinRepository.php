<?php

namespace App\Repositories;

use App\Models\Clockin;
use App\Repositories\BaseRepository;

/**
 * Class ClockinRepository
 * @package App\Repositories
 * @version December 29, 2021, 9:18 am UTC
*/

class ClockinRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Clockin::class;
    }
}
