<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Repositories\BaseRepository;

/**
 * Class ReservationRepository
 * @package App\Repositories
 * @version August 3, 2021, 12:16 pm UTC
*/

class ReservationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'reserve_time',
        'reserve_items',
        'phone',
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
        return Reservation::class;
    }
}
