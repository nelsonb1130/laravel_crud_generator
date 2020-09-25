<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * @SWG\Definition(
 *      definition="Account",
 *      required={"type", "amount", "description"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_date",
 *          description="created_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Account extends Model
{
    use SoftDeletes;

    public $table = 'account';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'amount',
        'description',
        'created_date',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'amount' => 'float',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'amount' => 'required',
        'description' => 'required',
        'user_id' => 'required'
    ];

    public static function getTotalIncome()
    {
        return DB::table("account")
        ->select(DB::raw("SUM(amount) as income"))
        ->where('type','income')
	    ->first();
    }
    public static function getTotalExpense()
    {
        return DB::table("account")
        ->select(DB::raw("SUM(amount) as expense"))
        ->where('type','expense')
	    ->first();
    }
}
