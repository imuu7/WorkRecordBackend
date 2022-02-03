<?php

namespace App\Repositories;

use App\Models\LineConfig;
use App\Repositories\BaseRepository;

/**
 * Class LineConfigRepository
 * @package App\Repositories
 * @version May 27, 2021, 2:34 pm UTC
*/

class LineConfigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'val',
        'nickname'
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
        return LineConfig::class;
    }
}
