<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Repositories\PostStatusesRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Services\PostValidationService;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Post;

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
     *  PostStatusesRepository
     */
    public $postStatusesRepository;

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
        UserRepository $userRepository,
        PostStatusesRepository $postStatusesRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->postValidationService = $postValidationService;
        $this->postStatusesRepository = $postStatusesRepository;
    }

    /**
     * Post create
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postCreate(Request $request)
    {
        $userId = Auth::id();
        $user = $this->userRepository->getUserById($userId);
        $postStatuses = $this->postStatusesRepository->getPostStatuses();

        if($request->isMethod('post')) {
            $validated = $this->postValidationService->postCreateValidation($request);

            if($validated->fails()) {
                return redirect()->route('dashboard.post.create')
                    ->withErrors($validated)
                    ->withInput();
            } else {
                $user->createPost($validated->validated());

                return redirect()->route('dashboard.post.create')
                    ->with('create_success', 'Post created!');
            }
        }

        return view('dashboard.post.create', ['post_statuses' => $postStatuses]);
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
        $this->authorize('update', $post);
        $postStatuses = $this->postStatusesRepository->getPostStatuses();

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

        return view('dashboard.post.edit', [
            'post' => $post,
            'post_statuses' => $postStatuses
        ]);
    }

    /**
     * Post delete
     *
     * @param Request $request
     * @param integer $postId
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function postDelete(Request $request, $postId)
    {
        $post = $this->postRepository->getPostById($postId);
        $this->authorize('update', $post);

        if($request->isMethod('post')) {
            $validated = $this->postValidationService->postDeleteValidation($postId);
            
            if($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validated->errors()
                ]);
            } else {
                $post = $this->postRepository->getPostById($postId);
                $post->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Post deleted!'
                ]);
            }
        }
    }
}
