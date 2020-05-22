<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Create a new LikeController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function likeIt(Reply $reply) {
        $reply->like()->create([
            'user_id'=> auth()->id()
        ]);
        return response('Success Like it', 200);
    }

    public function unLikeIt(Reply $reply) {
        $reply->like()->where('user_id', auth()->id())->first()->delete();
        return response('Success delete like', 200);
    }
}
