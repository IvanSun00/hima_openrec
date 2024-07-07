<?php

namespace App\Models;

use App\Models\ModelUtils;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Schedule extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'admin_id',
        'date_id',
        'candidate_id',
        'online',
        'time',
        'status',
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
            'admin_id' => 'required|uuid|exists:admins,id',
            'date_id' => 'required|uuid|exists:dates,id',
            'candidate_id' => 'nullable|uuid|exists:candidates,id',
            'online' => 'required|boolean',
            'time' => 'required|integer|min:0|max:23',
            'status' => 'required|integer|min:0|max:2',
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
            'admin_id.required' => 'Admins ID is required',
            'admin_id.uuid' => 'Admins ID must be a UUID',
            'admin_id.exists' => 'Admins ID does not exist',
            'date_id.required' => 'Date ID is required',
            'date_id.uuid' => 'Date ID must be a UUID',
            'date_id.exists' => 'Date ID does not exist',
            'candidate_id.uuid' => 'Candidate ID must be a UUID',
            'candidate_id.exists' => 'Candidate ID does not exist',
            'online.required' => 'Online is required',
            'online.boolean' => 'Online must be a boolean',
            'time.required' => 'Time is required',
            'time.integer' => 'Time must be an integer',
            'time.min' => 'Time must be at least 0',
            'time.max' => 'Time must not exceed 23',
            'status.required' => 'Status is required',
            'status.integer' => 'Status must be an integer',
            'status.min' => 'Status must be at least 0',
            'status.max' => 'Status must not exceed 2',
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
        return 'App\Http\Controllers\ScheduleController';
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['admin','date','candidate'];
    }

    /**
    * Space for calling the relations
    *
    *
    */

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function date()
    {
        return $this->belongsTo(Date::class);
    }
    
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }


}
