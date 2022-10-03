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

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $currentPage = $request->get("page") ?? 0;
        $offset = $request->get("page") ? ($request->get("page") - 1) * $perPage : 0;

        $posts = $this->postRepository->getPostsPaginated($perPage, $offset);
        $postsCount = $this->postRepository->getPostsCounts();

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

        return view('home.index', ['paginatedPosts' => $paginatedPosts]);
    }
}
