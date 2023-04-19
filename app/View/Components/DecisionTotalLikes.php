<?php

namespace App\View\Components;

use App\Models\DecisionDislikes;
use App\Models\DecisionLikes;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DecisionTotalLikes extends Component
{
    public function __construct(int $decisionId) {
        $this->decision = $decisionId;
    }

    private function GetTotalLikes() {
        $Likes = DecisionLikes::where('besluit_id', $this->decision)->count('id');
        return $Likes;
    }

    private function GetTotalDislikes() {
        $Disliked = DecisionDislikes::where('besluit_id',$this->decision)->count('id');
        return $Disliked;
    }
    public function render(): View
    {
        return view('components.decision-total-likes',[
            'likes' => $this->GetTotalLikes(),
            'dislikes' => $this->GetTotalDislikes()
        ]);
    }
}
