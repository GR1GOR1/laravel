<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment as StoreRequest;
use App\Models\Comment;

class Comments extends Controller
{
    public function store(StoreRequest $request) {
        $model = $request->checkCommentable();
        // dd($model);
        // dd(Comment::make($request->only('text')));

        $model->comments()->save(Comment::make($request->only('text')));
        return redirect()->back();
    }
}
