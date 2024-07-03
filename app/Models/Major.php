<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\MajorRepository;
use App\Services\MajorService;
use App\Http\Resources\MajorResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Major extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'name',
        'english_name',
        'slug',
    ]; 

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     protected $hidden = ['created_at', 'updated_at'];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:100',
            'english_name' => 'required|string|max:100',
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
            'english_name.required' => 'English name is required',
            'slug.required' => 'Slug is required',
            'name.string' => 'Name must be a string',
            'english_name.string' => 'English name must be a string',
            'slug.string' => 'Slug must be a string',
            'name.max' => 'Name must not exceed 100 characters',
            'english_name.max' => 'English name must not exceed 100 characters',
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
            'english_name' => $request->english_name,
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
        return 'App\Http\Controllers\MajorController';
    }

    
  
    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['admins','candidates'];
    }

    /**
     * Space for calling the relations
     *
     *
     */

    public function admins()
    {
        return $this->hasMany(Admin::class, 'major_id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'major_id');
    }

}
