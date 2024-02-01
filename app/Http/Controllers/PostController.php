<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Delete a post.
     *
     * @param Post $post The post to be deleted.
     * @return RedirectResponse Redirect to the home page after deletion.
     */
    public function deletePost(Post $post): RedirectResponse
    {
        if (auth()->user()->id === $post->user_id) {
            $post->delete();
            return redirect('/');
        }

        // Redirect to home page if the user does not have permission.
        return redirect('/');
    }

    /**
     * Update a post.
     *
     * @param Post $post The post to be updated.
     * @param Request $request The HTTP request.
     * @return RedirectResponse Redirect to the home page after updating.
     */
    public function actuallyUpdatePost(Post $post, Request $request): RedirectResponse
    {
        if (auth()->user()->id !== $post->user_id) {
            // Redirect to home page if the user does not have permission.
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        return redirect('/');
    }

    /**
     * Show the edit screen for a post.
     *
     * @param Post $post The post to be edited.
     * @return View|RedirectResponse View for editing the post or redirect to home page if the user does not have permission.
     */
    public function showEditScreen(Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            // Redirect to home page if the user does not have permission.
            return redirect('/');
        }

        return view('/edit-post', ['post' => $post]);
    }

    /**
     * Create a new post.
     *
     * @param Request $request The HTTP request.
     * @return RedirectResponse Redirect to the home page after creating the post.
     */
    public function createPost(Request $request): RedirectResponse
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);

        return redirect('/');
    }
}
