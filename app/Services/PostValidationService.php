<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class PostValidationService
{
    /**
     * Post edit validation
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function postEditValidation($request)
    {
        $rules = [
            'post_title' => 'required|max:255',
            'post_body' => 'required',
            'post_status' => 'required',
        ];

        $messages = [
            'post_title.required' => 'Post title is required!',
            'post_title.max' => 'Post title has reached max number of characters!',
            'post_body.required' => 'Post body is required!',
            'post_status.required' => 'Post status is required!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    /**
     * Post delete validation
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function postDeleteValidation($postId)
    {
        $rules = [
            'post_id' => ['required', 'exists:posts,id']
        ];

        $messages = [
            'post_id.required' => 'Post ID is required!',
            'post_id.exists' => 'Post does not exist!',
        ];

        $validator = Validator::make(['post_id' => $postId], $rules, $messages);

        return $validator;
    }

    /**
     * Post create validation
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function postCreateValidation($request)
    {
        $rules = [
            'post_title' => 'required|max:255',
            'post_body' => 'required',
            'post_status' => 'required',
        ];

        $messages = [
            'post_title.required' => 'Post title is required!',
            'post_title.max' => 'Post title has reached max number of characters!',
            'post_body.required' => 'Post body is required!',
            'post_status.required' => 'Post status is required!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }
}