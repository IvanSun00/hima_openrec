<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\DepartmentRepository;
use App\Services\DepartmentService;
use App\Http\Resources\DepartmentResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'name',
        'slug',
    ]; 

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


     /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100',
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
            'slug.required' => 'Slug is required',
            'slug.string' => 'Slug must be a string',
            'slug.max' => 'Slug must not exceed 100 characters',
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
            'slug' => $request->slug,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\DepartmentController';
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
