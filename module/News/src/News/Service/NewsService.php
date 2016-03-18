<?php

namespace News\Service;

use News\Entity\NewsPost;

interface NewsService
{
    /**
     * Saves a news Post
     *
     * @pa$ram NewsPost $NewsPost
     *
     * @return NewsPost
     */
    public function save(NewsPost $NewsPost);

    /**
     * @param $page int
     *
     * @return \Zend\Paginator\Paginator
     */
    public function fetch($page);

    /**
     * @param $categorySlug string
     * @param $PostSlug string
     *
     * @return NewsPost|null
     */
    public function find($categorySlug, $NewsPostSlug);

    /**
     * @param $PostId int
     *
     * @return NewsPost|null
     */
    public function findById($NewsPostId);

    /**
     * @param Post $Post
     *
     * @return void
     */
    public function update(NewsPost $NewsPost);

    /**
     * @param $PostId int
     *
     * @return void
     */
    public function delete($NewsPostId);
} 