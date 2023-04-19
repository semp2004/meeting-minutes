<?php

namespace App\View\Components;

use App\Models\DecisionDislikes;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DecisionDislike extends Component
{
    public function __construct($decisionId)
    {
        $this->decisionId = $decisionId;
        $this->Disliked = DecisionDislikes::where('besluit_id', $decisionId)->where('user_id', auth()->user()->id)->first();
    }
    private function HasDisliked() {
        if ($this->Disliked) {
            return true;
        }

        return false;

    }
    public function render(): View
    {
        $Liked = $this->HasDisliked();
        return view('components.decision-dislike', [
            'color' => $Liked,
            'decision' => $this -> decisionId
        ]);
    }
}
