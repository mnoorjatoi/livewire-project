<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function updatePost(Post $post, Request $req){
        $fields = $req->validate(
            [
                'title' => 'required',
                'body' => 'required'
            ]
        );
        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);
        $post->update($fields);
        return back()->with('success','post successfully updated');

    }

    public function editSinglePost(Post $post){
        return view('edit-post',['post' => $post]);
    }

    public function deletePost(Post $post){
        $post->delete();
        return redirect()->route('user-post-profile', username_lower(auth()->user()->username));
    }

    public function viewSinglePost(Post $post){
        $post['body'] = strip_tags(Str::markdown($post->body), '<p><h1><h2><ul><ol><b><strong>');
        return view('single-post', ['post' => $post]);
    }

    public function SaveNewPost(Request $req){
        $fields = $req->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);
        $fields['user_id'] = auth()->id();
        $newPost = Post::create($fields);
        return redirect("/post/{$newPost->id}")->with('success','New post successfully created.');
    }

    public function ShowPostForm(){
        return view('create-post');
    }
}
