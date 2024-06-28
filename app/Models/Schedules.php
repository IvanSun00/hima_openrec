<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\SchedulesRepository;
use App\Services\SchedulesService;
use App\Http\Resources\SchedulesResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Schedules extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [];
    }

    /**
     * Messages that applied in this model
     *
     * @var array
     */
    public static function validationMessages()
    {
        return [];
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
        return 'App\Http\Controllers\SchedulesController';
    }

   
    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [];
    }

    /**
     * Space for calling the relations
     *
     *
     */

}
