<?php

namespace App\Events;

use App\Models\Applicant;
use App\Models\Candidate;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AllApplicantDocumentsUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Candidate $applicant;
    public int $nextStage;

    /**
     * Create a new event instance.
     */
    public function __construct(Candidate $applicant, int $nextStage)
    {
        $this->applicant = $applicant;
        $this->nextStage = $nextStage;
    }
}
