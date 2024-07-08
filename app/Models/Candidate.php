<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\CandidatesRepository;
use App\Services\CandidatesService;
use App\Http\Resources\CandidatesResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;

class Candidate extends Model
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
        'email',
        'major_id',
        'gpa',
        'gender',
        'religion',
        'birth_place',
        'birth_date',
        'address',
        'phone',
        'line',
        'instagram',
        'tiktok',
        'motivation',
        'commitment',
        'strength',
        'weakness',
        'experience',
        'documents',
        'portfolio',
        'accepted_department',
        'priority_department1',
        'priority_department2',
        'stage',
        'comment',
        'hasil_interview'

    ];


    protected $casts = ['documents' => 'array'];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100|email|unique:candidates,email',
            'major_id' => 'required|uuid|exists:majors,id',
            'gpa' => ['required', 'string', 'regex:/^(4\.00|[0-3]\.[0-9]{2})$/'],
            'gender' => 'required|boolean',
            'religion' => 'required|string|max:50',
            'birth_place' => 'required|string|max:50',
            'birth_date' => 'required|date|date_format:Y-m-d',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:50|regex:/^([0-9]{8,16})$/',
            'line' => 'required|string|max:50',
            'instagram' => 'required|string|max:50',
            'tiktok' => 'nullable|string|max:50',
            'motivation' => 'required|string',
            'commitment' => 'required|string',
            'strength' => 'required|string',
            'weakness' => 'required|string',
            'experience' => 'nullable|string',
            'portfolio' => 'nullable|string|max:100|url',
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|string|max:255', //kenapa
            'accepted_department' => 'nullable|uuid|exists:departments,id',
            'priority_department1' => 'required|uuid|exists:departments,id',
            'priority_department2' => 'nullable|uuid|exists:departments,id|different:priority_department1',
            'stage' => 'required|integer',
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
            'email.string' => 'Email must be a string',
            'email.max' => 'Email must not exceed 100 characters',
            'email.email' => 'Email must be a valid email',
            'email.unique' => 'Email has been taken',
            'major_id.required' => 'Major is required',
            'major_id.uuid' => 'Major must be a valid UUID',
            'major_id.exists' => 'Major must be an existing major',
            'gpa.required' => 'GPA is required',
            'gpa.string' => 'GPA must be a string',
            'gpa.regex' => 'GPA must be a valid GPA',
            'gender.required' => 'Gender is required',
            'gender.boolean' => 'Gender must be a boolean',
            'religion.required' => 'Religion is required',
            'religion.string' => 'Religion must be a string',
            'religion.max' => 'Religion must not exceed 50 characters',
            'birth_place.required' => 'Birth place is required',
            'birth_place.string' => 'Birth place must be a string',
            'birth_place.max' => 'Birth place must not exceed 50 characters',
            'birth_date.required' => 'Birth date is required',
            'birth_date.date' => 'Birth date must be a date',
            'birth_date.date_format' => 'Birth date must be in Y-m-d format',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address must not exceed 100 characters',
            'phone.required' => 'Phone is required',
            'phone.string' => 'Phone must be a string',
            'phone.max' => 'Phone must not exceed 50 characters',
            'phone.regex' => 'Phone must be a valid phone number',
            'line.required' => 'Line is required',
            'line.string' => 'Line must be a string',
            'line.max' => 'Line must not exceed 50 characters',
            'instagram.required' => 'Instagram is required',
            'instagram.string' => 'Instagram must be a string',
            'instagram.max' => 'Instagram must not exceed 50 characters',
            'tiktok.string' => 'Tiktok must be a string',
            'tiktok.max' => 'Tiktok must not exceed 50 characters',
            'motivation.required' => 'Motivation is required',
            'motivation.string' => 'Motivation must be a string',
            'commitment.required' => 'Commitment is required',
            'commitment.string' => 'Commitment must be a string',
            'strength.required' => 'Strength is required',
            'strength.string' => 'Strength must be a string',
            'weakness.required' => 'Weakness is required',
            'weakness.string' => 'Weakness must be a string',
            'experience.string' => 'Experience must be a string',
            'portfolio.string' => 'Portfolio must be a string',
            'portfolio.max' => 'Portfolio must not exceed 100 characters',
            'portfolio.url' => 'Portfolio must be a valid URL',
            'documents.array' => 'Documents must be an array',
            'documents.*.string' => 'Documents must be a string',
            'documents.*.max' => 'Documents must not exceed 255 characters',
            'accepted_department.uuid' => 'Accepted department must be a valid UUID',
            'accepted_department.exists' => 'Accepted department must be an existing department',
            'priority_department1.required' => 'Priority department 1 is required',
            'priority_department1.uuid' => 'Priority department 1 must be a valid UUID',
            'priority_department1.exists' => 'Priority department 1 must be an existing department',
            'priority_department2.uuid' => 'Priority department 2 must be a valid UUID',
            'priority_department2.exists' => 'Priority department 2 must be an existing department',
            'priority_department2.different' => 'Priority department 2 must be different from priority department 1',
            'stage.required' => 'Stage is required',
            'stage.integer' => 'Stage must be an integer',
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
        return 'App\Http\Controllers\CandidatesController';
    }

    // function
    public function getNRP()
    {
        $explodedEmail = explode('@', $this->email);
        return strtolower($explodedEmail[0]);
    }

    public function findByEmail($email, array $columns = ['*'], $relations = null)
    {
        $builder = $relations ? $this->with($relations) : $this;
        return $builder->select(...$columns)
            ->where('email', $email)
            ->first();
    }

    public function findByNRP($nrp, array $columns = ['*'], $relations = null)
    {
        return $this->findByEmail($nrp . '@john.petra.ac.id', $columns, $relations);
    }

    public function cv()
    {
        $this->load($this->relations());
        return Pdf::loadView(
            'pdf.applicant_cv',
            ['applicant' => $this]
        );
    }

    public function addDocument($documentType, $filename)
    {
        $documents = $this->documents;

        if (!$documents) $documents = [];

        $documents[$documentType] = $filename;
        $this->documents = $documents;
        $this->save();
    }


    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['major', 'acceptedDepartment', 'priorityDepartment1', 'priorityDepartment2'];
    }

    /**
     * Space for calling the relations
     *
     *
     */

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function acceptedDepartment()
    {
        return $this->belongsTo(Department::class, 'accepted_department');
    }

    public function priorityDepartment1()
    {
        return $this->belongsTo(Department::class, 'priority_department1');
    }

    public function priorityDepartment2()
    {
        return $this->belongsTo(Department::class, 'priority_department2');
    }


}
