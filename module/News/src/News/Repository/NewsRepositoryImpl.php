<?php

namespace News\Repository;

//use News\Entity\Hydrator\CategoryHydrator;
use News\Entity\Hydrator\NewsPostHydrator;
use News\Entity\NewsPost;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class NewsRepositoryImpl implements NewsRepository
{
    use AdapterAwareTrait;

    public function save(NewsPost $NewsPost)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'title' => $NewsPost->getTitle(),
                'description' => $NewsPost->getDescription(),
                'content' => $NewsPost->getContent(),
                'Published_date'=> $NewsPost->getPublishedDate(),

            ))
            ->into('news_feeds');

        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
    }

    public function fetch($page)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->columns(array(
                'id',
                'title',
                'description',
                'content',
                'Published_date',
                'image'
            ))
            ->from(array('p' => 'news_feeds'));
//            ->join(
//                array('c' => 'user'), // Table name
//                'c.id = p.user_id', // Condition
//                array( 'desplayName',), // Columns
//                $select::JOIN_INNER
//            )
//            ->order('p.id DESC');

        $hydrator = new AggregateHydrator();
        $hydrator->add(new NewsPostHydrator());
       // $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new NewsPost());
        $paginatorAdapter = new \Zend\Paginator\Adapter\DbSelect($select, $this->adapter, $resultSet);
        $paginator = new \Zend\Paginator\Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(5);

        return $paginator;
    }

    /**
     * @param $categorySlug string
     * @param $PostSlug string
     *
     * @return Post|null
     */
    public function find($categorySlug, $NewsPostSlug)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->columns(array(
                'id',
                'title',
                'slug',
                'content',
                'created',
            ))
            ->from(array('p' => 'news'))
            ->join(
                array('c' => 'category'), // Table name
                'c.id = p.category_id', // Condition
                array('category_id' => 'id', 'name', 'category_slug' => 'slug'), // Columns
                $select::JOIN_INNER
            )->where(array(
                'c.slug' => $categorySlug,
                'p.slug' => $NewsPostSlug,
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new NewsPostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new NewsPost());
        $resultSet->initialize($results);

        return ($resultSet->count() > 0 ? $resultSet->current() : null);
    }

    /**
     * @param $PostId int
     *
     * @return Post|null
     */
    public function findById($NewsPostId)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->columns(array(
            'id',
            'title',
            'slug',
            'content',
            'created',
        ))
            ->from(array('p' => 'news'))
            ->join(
                array('c' => 'category'), // Table name
                'c.id = p.category_id', // Condition
                array('category_id' => 'id', 'name', 'category_slug' => 'slug'), // Columns
                $select::JOIN_INNER
            )->where(array(
                'p.id' => $NewsPostId,
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new NewsPostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new NewsPost());
        $resultSet->initialize($results);

        return ($resultSet->count() > 0 ? $resultSet->current() : null);
    }

    /**
     * @param Post $Post
     *
     * @return void
     */
    public function update(NewsPost $NewsPost)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->update('news')
            ->set(array(
                'title' => $NewsPost->getTitle(),
                'slug' => $NewsPost->getSlug(),
                'content' => $NewsPost->getContent(),
                'category_id' => $NewsPost->getCategory()->getId(),
            ))
            ->where(array(
                'id' => $NewsPost->getId(),
            ));

        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
    }

    /**
     * @param $PostId int
     *
     * @return void
     */
    public function delete($NewsPostId)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $delete = $sql->delete()
            ->from('news')
            ->where(array(
                'id' => $NewsPostId,
            ));

        $statement = $sql->prepareStatementForSqlObject($delete);
        $statement->execute();
    }
}