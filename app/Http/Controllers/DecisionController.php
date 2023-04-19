<?php

namespace App\Http\Controllers;

use App\Models\DecisionDislikes;
use App\Models\DecisionLikes;
use App\View\Components\DecisionDislike;

class DecisionController extends Controller
{
    public function like(int $Decision) {
        $UserId = auth()->user()->id;

//        Check if user has already liked
        $Liked = DecisionLikes::where('user_id', $UserId)->where('besluit_id', $Decision)->first();
        if($Liked) {
            DecisionLikes::where('user_id', $UserId)->where('besluit_id',$Decision)->delete();
            return back();
        }

        $DecisionLike = new DecisionLikes();
        $DecisionLike->user_id = $UserId;
        $DecisionLike->besluit_id = $Decision;
        $DecisionLike->save();

        return back();
    }

    public function dislike(int $Decision) {
        $UserId = auth()->user()->id;

        $Disliked = DecisionDislikes::where('user_id',$UserId)->where('besluit_id',$Decision)->first();
        if($Disliked){
            DecisionDislikes::where('user_id',$UserId)->where('besluit_id',$Decision)->delete();
            return back();
        }

        $DecisionDislike = new DecisionDislikes();
        $DecisionDislike->user_id = $UserId;
        $DecisionDislike->besluit_id = $Decision;
        $DecisionDislike->save();

        return back();
    }
}
