<?php

namespace App\Repositories;

use App\Models\contacts;
use App\Repositories\BaseRepository;

/**
 * Class contactsRepository
 * @package App\Repositories
 * @version September 1, 2020, 4:54 am UTC
*/

class contactsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'first_name',
        'sur_name',
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
        return contacts::class;
    }
}
