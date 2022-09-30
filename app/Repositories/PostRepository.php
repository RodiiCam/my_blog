<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    /**
     * Post
     * 
     * @var Post
     */
    protected $post;

    /**
     * Create PostRepository instance
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get posts
     *
     * @return Collection|Post
     */
    public function getPosts()
    {
        return $this->post->all();
    }

    /**
     * Get posts count
     *
     * @return int
     */
    public function getPostsCounts()
    {
        return $this->post->count();
    }

    /**
     * Get paginated posts
     * 
     * @param integer $limit
     * @param integer $page
     * @return Collection
     */
    public function getPostsPaginated($limit, $page = 0)
    {
        $posts = $this->post->offset($page)->limit($limit)->get();

        return $posts;
    }

    /**
     * Get posts count by user id
     * @param integer $userId
     * @return integer
     */
    public function getPostsCountsByUserId($userId)
    {
        return $this->post->where('user_id', $userId)->count();
    }

    /**
     * Undocumented function
     *
     * @param integer $userId
     * @param integer $limit
     * @param integer $page
     * @return Collection
     */
    public function getPostsPaginatedByUserId($userId, $limit, $page = 0)
    {
        $posts = $this->post->where('user_id', $userId)->offset($page)->limit($limit)->get();

        return $posts;
    }

    /**
     * Get post by id
     *
     * @param integer] $id
     * @return Post
     */
    public function getPostById($id)
    {
        return $this->post->where('id', $id)->first();
    }

    /**
     * Update post by id
     *
     * @param integer $id
     * @return void
     */
    public function updatePostById($id, $input)
    {
        $this->post->where('id', $id)->update([
            'title' => $input['post_title'],
            'body' => $input['post_body'],
            'status' => $input['post_status']
        ]);

        return;
    }
}