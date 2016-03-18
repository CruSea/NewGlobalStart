<?php

namespace News\Service;

use News\Entity\NewsPost;

class NewsServiceImpl implements NewsService
{
    /**
     * @var \News\Repository\NewsRepository $NewsRepository
     */
    protected $NewsRepository;


    /**
     * Saves a News Post
     *
     * @param News $Post
     *
     * @return News
     */
    public function save(NewsPost $NewsPost)
    {
        $this->NewsRepository->save($NewsPost);
    }

    /**
     * @param $page int
     *
     * @return \Zend\Paginator\Paginator
     */
    public function fetch($page)
    {
        return $this->NewsRepository->fetch($page);
    }

    /**
     * @param $categorySlug string
     * @param $PostSlug string
     *
     * @return News|null
     */
    public function find($categorySlug, $NewsPostSlug)
    {
        return $this->NewsRepository->find($categorySlug, $NewsPostSlug);
    }

    /**
     * @param $PostId int
     *
     * @return News|null
     */
    public function findById($NewsPostId)
    {
        return $this->NewsRepository->findById($NewsPostId);
    }

    /**
     * @param News $Post
     *
     * @return void
     */
    public function update(NewsPost $NewsPost)
    {
        $this->NewsRepository->update($NewsPost);
    }

    /**
     * @param $PostId int
     *
     * @return void
     */
    public function delete($NewsPostId)
    {
        $this->NewsRepository->delete($NewsPostId);
    }

    /**
     * @param \News\Repository\NewsRepository $NewsRepository
     */
    public function setNewsRepository($NewsRepository)
    {
        $this->NewsRepository = $NewsRepository;
    }

    /**
     * @return \News\Repository\NewsRepository
     */
    public function getNewsRepository()
    {
        return $this->NewsRepository;
    }
}