<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topic::with(['comments'])->latest()->paginate(10);

        return view('topics.index', ['topics' => $topics]);
    }

    public function create()
    {
        return view('topics.create');
    }

    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->content = $request->content;
        $topic->user_id = \Auth::user()->id;

        $topic->save();

        return redirect()->route('topics.index');
    }

    public function show($topic_id)
    {
        $topic = Topic::findOrFail($topic_id);

        return view('topics.show',[
            'topic' => $topic,
        ]);
    }

    public function edit($topic_id)
    {
        $topic = Topic::findOrFail($topic_id);

        return view('topics.edit',[
            'topic' => $topic,
        ]);
    }

    public function update($topic_id, Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max:800',
        ]);

        $topic = Topic::findOrFail($topic_id);
        $topic->fill($params)->save();

        return redirect()->route('topics.show', ['topic' => $topic]);
    }

    public function destroy($topic_id)
    {
        $topic = Topic::findOrFail($topic_id);

        $topic->delete();

        return redirect()->route('topics.index');
    }
}
