<?php

namespace News\Repository;

use Application\Repository\RepositoryInterface;
use News\Entity\NewsPost;

interface NewsRepository extends RepositoryInterface
{
    /**
     * Saves a blog Post
     *
     * @pa$ram NewsPost $NewsPost
     *
     * @return void
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
     * @return Post|null
     */
    public function find($categorySlug, $NewsPostSlug);

    /**
     * @param $PostId int
     *
     * @return Post|null
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