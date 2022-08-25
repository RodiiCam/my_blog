<?php

namespace App\Services;

class PostValidationService
{
    public function postEditValidation($request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
    }
}