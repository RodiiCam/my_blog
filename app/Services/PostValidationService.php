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
        ];

        $messages = [
            'post_title.required' => 'Post title is required!',
            'post_title.max' => 'Post title has reached max number of characters!',
            'post_body.required' => 'Post body is required!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }
}