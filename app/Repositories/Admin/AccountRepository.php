<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Account;
use App\Repositories\BaseRepository;

/**
 * Class AccountRepository
 * @package App\Repositories\Admin
 * @version September 25, 2020, 4:27 am UTC
*/

class AccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'amount',
        'description',
        'created_date'
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
        return Account::class;
    }
}
