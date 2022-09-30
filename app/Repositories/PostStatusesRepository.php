<?php

namespace App\Repositories;

use App\Models\PostStatuses;

class PostStatusesRepository
{
    /**
     * PostStatuses
     * 
     * @var PostStatuses
     */
    protected $postStatuses;

    /**
     * Create PostStatusesRepository instance
     *
     * @param PostStatuses $postStatuses
     */
    public function __construct(PostStatuses $postStatuses)
    {
        $this->postStatuses = $postStatuses;
    }

    /**
     * Get post statuses
     *
     * @return PostStatuses
     */
    public function getPostStatuses()
    {
        return $this->postStatuses->all();
    }
}