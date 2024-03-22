<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentSaveRequest;
use App\Models\Comment;
use App\Models\WorkOrder;

class CommentController extends Controller
{
    public function __invoke(CommentSaveRequest $request, WorkOrder $work_order)
    {
        $comment = Comment::create([
            'content' => $request->get('comment'),
            'user_id' => auth()->id(),
            'work_order_id' => $work_order->id,
        ]);

        $response = $comment === false 
                  ? ['danger', 'Error saving comment, try again...'] 
                  : ['success', "Comment <em>\"{$request->get('comment')}\"</em> saved"];

        return redirect()->route('work-orders.show', [$work_order, 'tab' => 'comments'])->with($response[0], $response[1]);
    }
}
