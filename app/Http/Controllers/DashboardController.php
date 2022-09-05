<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Services\PostValidationService;
use App\Models\Permission;
use App\Models\Role;

class DashboardController extends Controller
{
    /**
     *  PostRepository
     */
    public $postRepository;

    /**
     *  UserRepository
     */
    public $userRepository;

    /**
     *  PostValidationService
     */
    public $postValidationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        PostRepository $postRepository,
        PostValidationService $postValidationService,
        UserRepository $userRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->postValidationService = $postValidationService;
    }

    /**
     * Post edit
     *
     * @param Request $request
     * @param integer $postId
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postEdit(Request $request, $postId)
    {
        $post = $this->postRepository->getPostById($postId);

        if($request->isMethod('post')) {
            $validated = $this->postValidationService->postEditValidation($request);

            if($validated->fails()) {
                return redirect()->route('dashboard.post.edit', ['post_id' => $postId])
                    ->withErrors($validated)
                    ->withInput();
            } else {
                $this->postRepository->updatePostById($postId, $validated->validated());

                return redirect()->route('dashboard.post.edit', ['post_id' => $postId])
                    ->with('update_success', 'Post updated!');
            }
        }

        return view('dashboard.post.edit', ['post' => $post]);
    }

    /**
     * Post delete
     *
     * @param Request $request
     * @param integer $postId
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postDelete(Request $request, $postId)
    {
        $post = $this->postRepository->getPostById($postId);

        if($request->isMethod('post')) {
            
        }

        return view('dashboard.post.edit', ['post' => $post]);
    }
}
