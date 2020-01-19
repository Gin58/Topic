<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'body' => 'required|max:300',
        ]);

        $topic = Topic::findOrFail($params['topic_id']);
        $topic->comments()->create($params);

        return redirect()->route('topics.show', ['topic' => $topic]);
    }
}
