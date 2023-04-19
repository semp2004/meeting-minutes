<?php

namespace App\View\Components;

use App\Models\DecisionLikes;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DecisionLike extends Component
{
    public function __construct($decisionId)
    {
        $this->decisionId = $decisionId;
        $this->HasLiked = DecisionLikes::where('besluit_id', $decisionId)->where('user_id', auth()->user()->id)->first();
    }
    private function HasLiked() {
        if ($this->HasLiked) {
            return true;
        }

        return false;

    }
    public function render(): View
    {
        $Liked = $this->HasLiked();
        return view('components.decision-like', [
            'color' => $Liked,
            'decision' => $this -> decisionId
        ]);
    }
}
