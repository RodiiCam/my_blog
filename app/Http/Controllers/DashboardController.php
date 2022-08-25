<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;
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
     *  PostValidationService
     */
    public $postValidationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $postRepository, PostValidationService $postValidationService)
    {
        $this->postRepository = $postRepository;
        $this->postValidationService = $postValidationService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $perPage = 10;
        $currentPage = $request->get("page") ?? 0;
        $offset = $request->get("page") ? ($request->get("page") - 1) * $perPage : 0;

        $posts = $this->postRepository->getPostsPaginatedByUserId($userId, $perPage, $offset);
        $postsCount = $this->postRepository->getPostsCountsByUserId($userId);

        $paginatedPosts = new LengthAwarePaginator(
            $posts,
            $postsCount,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('dashboard.index', ['paginatedPosts' => $paginatedPosts]);
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
}
