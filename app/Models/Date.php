<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\DatesRepository;
use App\Services\DatesService;
use App\Http\Resources\DatesResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Date extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'date',
    ]; 

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     protected $hidden=[
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'date' => 'required|date|date_format:Y-m-d|unique:dates,date',
        ];
    }

    /**
     * Messages that applied in this model
     *
     * @var array
     */
    public static function validationMessages()
    {
        return [
            'date.required' => 'Date is required',
            'date.date' => 'Date must be a date',
            'date.date_format' => 'Date must be in Y-m-d format',
            'date.unique' => 'Date already exists',
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        return ModelUtils::filterNullValues([]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\DatesController';
    }

   
    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['Schedules'];
    }

    /**
    * Space for calling the relations
    *
    *
    */

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'date_id');
    }

}
