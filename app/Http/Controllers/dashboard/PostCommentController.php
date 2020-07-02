<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\ModelosFormulario\Post;
use App\ModelosFormulario\PostComment;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rol.admin');
    }

    public function index()
    {
        $postComments = PostComment::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.post-comment.index', ['postComments' => $postComments]);
    }

    public function post(Post $post)
    {

        $posts = Post::all(); // obtiene todos los post 

        $postComments = PostComment
            ::orderBy('created_at', 'desc')
            ->where('post_id', '=', $post->id)
            ->paginate(10);

        return view('dashboard.post-comment.post',
            ['postComments' => $postComments,
                'posts' => $posts, //se le cargan con todos los post    
                'post' => $post]); //se le anexa el post en sigular que  es el que selleciono el usuario
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        //  $postComment = PostComment::findOrFail($id);
        return view('dashboard.post-comment.show', ["postComment" => $postComment]);

    }

    public function jshow(PostComment $postComment)
    {
        //  $postComment = PostComment::findOrFail($id);
        return response()->json($postComment);
        //return view('dashboard.post-comment.show', ["postComment" => $postComment]);
    }

    public function proccess(PostComment $postComment)
    {
        if ($postComment->approved == '0') {
            $postComment->approved = '1';
        } else {
            $postComment->approved = '0';
        }

        $postComment->save();
        //$postComment->update(array("approved"=>$postComment->approved));

        return response()->json($postComment->approved);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        $postComment->delete();
        return back()->with('status', 'Comentario eliminado con exito');

    }
}
