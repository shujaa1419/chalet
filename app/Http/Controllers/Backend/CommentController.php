<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(10);
        return view('backend.comments.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = Comment::with(['chalet'])->whereId($id)->first();
        return view('backend.comments.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = Comment::with(['chalet'])->whereId($id)->first();

        return view('backend.comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment = Comment::whereId($id)->first();

        if ($comment) {

            $data['comment'] = Purify::clean($request->comment);
            $data['status'] = $request->status;


            $comment->update($data);

            return redirect()->route('dashboard.comments.index')->with([
                'message' => 'Comment updated successfully',
                'alert-type' => 'success',
            ]);

        }
        return redirect()->route('dashboard.comments.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {

        $comment = Comment::whereId($id)->first();

        if ($comment) {
            $comment->delete();

            return redirect()->route('dashboard.comments.index')->with([
                'message' => 'Comment deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('dashboard.chalets.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
}
