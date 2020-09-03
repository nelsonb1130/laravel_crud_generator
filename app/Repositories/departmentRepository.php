<?php

namespace App\Repositories;

use App\Models\department;
use App\Repositories\BaseRepository;

/**
 * Class departmentRepository
 * @package App\Repositories
 * @version September 1, 2020, 12:22 pm UTC
*/

class departmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
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
        return department::class;
    }
}
