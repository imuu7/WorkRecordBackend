<?php

namespace App\Repositories;

use App\Models\config_table;
use App\Repositories\BaseRepository;

/**
 * Class config_tableRepository
 * @package App\Repositories
 * @version July 17, 2021, 3:06 am UTC
*/

class config_tableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'val'
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
        return config_table::class;
    }
}
