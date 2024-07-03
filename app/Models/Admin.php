<?php

namespace App\Models;

use App\Models\ModelUtils;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Admin extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'dept_id',
        'major_id',
        'line',
        'meet',
        'spot',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }


    /**
     * Rules that applied in this model
     *
     * @var array
     */

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'dept_id' => 'required|uuid|exists:departments,id',
            'major_id' => 'required|uuid|exists:majors,id',
            'line' => 'required|string|max:20',
            'meet' => 'nullable|string|max:100|url',
            'spot' => 'nullable|string|max:100',
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
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 100 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email has been taken',
            'dept_id.required' => 'Department is required',
            'dept_id.uuid' => 'Department must be a valid UUID',
            'dept_id.exists' => 'Department not found',
            'major_id.required' => 'Major is required',
            'major_id.uuid' => 'Major must be a valid UUID',
            'major_id.exists' => 'Major not found',
            'line.required' => 'Line is required',
            'line.string' => 'Line must be a string',
            'line.max' => 'Line must not exceed 20 characters',
            'meet.string' => 'Meet must be a string',
            'meet.max' => 'Meet must not exceed 100 characters',
            'meet.url' => 'Meet must be a valid URL',
            'spot.string' => 'Spot must be a string',
            'spot.max' => 'Spot must not exceed 100 characters',
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        return ModelUtils::filterNullValues([
            'name' => $request->name,
            'email' => $request->email,
            'dept_id' => $request->dept_id,
            'major_id' => $request->major_id,
            'line' => $request->line,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\AdminController';
    }

   /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['department', 'major', 'schedules'];
    }

    /**
     * Space for calling the relations
     *
     *
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'admin_id');
    }

}
