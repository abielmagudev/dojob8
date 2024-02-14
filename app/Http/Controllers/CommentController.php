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
            'user_id' => mt_rand(1,10),
            'work_order_id' => $work_order->id,
        ]);

        if( $comment === false ) {
            return redirect()->route('work-orders.show', [$work_order, 'tab' => 'comments'])->with('danger', 'Error saving comment, try again...');
        }

        return redirect()->route('work-orders.show', [$work_order, 'tab' => 'comments'])->with('success', "Comment <em>\"{$request->get('comment')}\"</em> saved");
    }
}
