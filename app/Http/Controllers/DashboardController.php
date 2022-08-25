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

    public function postEdit(Request $request, $postId)
    {
        $this->postValidationService->postEditValidation($request);
        $post = $this->postRepository->getPostById($postId);

        return view('dashboard.post.edit', ['paginatedPosts' => $post]);
    }
}
