<?php

namespace App\Events;

use App\Models\Applicant;
use App\Models\Candidate;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicantDocumentsUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Candidate $applicant;
    public array $allDocuments;

    /**
     * Create a new event instance.
     */
    public function __construct($applicant, $allDocuments)
    {
        $this->applicant = $applicant;
        $this->allDocuments = $allDocuments;
    }
}
