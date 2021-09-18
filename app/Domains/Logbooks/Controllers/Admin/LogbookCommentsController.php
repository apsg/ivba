<?php
namespace App\Domains\Logbooks\Controllers\Admin;

use App\Domains\Logbooks\Models\LogbookComment;
use App\Domains\Logbooks\Requests\Admin\StoreLogbookCommentRequest;
use App\Http\Controllers\Controller;

class LogbookCommentsController extends Controller
{
    public function store(StoreLogbookCommentRequest $request)
    {
        /** @var LogbookComment $comment */
        $comment = LogbookComment::create([
            'user_id'          => $request->user()->id,
            'logbook_entry_id' => $request->input('entry_id'),
            'comment'          => $request->input('comment'),
        ]);
        $comment = $comment->load('user');

        return $this->status(200, compact('comment'));
    }

    public function destroy(LogbookComment $comment)
    {
        $comment->delete();

        return $this->statusOk();
    }
}
