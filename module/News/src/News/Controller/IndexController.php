<?php

namespace News\Controller;

//use News\Entity\Hydrator\CategoryHydrator;
use News\Entity\Hydrator\NewsPostHydrator;
use News\Entity\NewsPost;
use News\Form\Add;
use News\Form\Edit;
use News\InputFilter\AddNewsPost;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'paginator' => $this->getNewsService()->fetch($this->params()->fromRoute('page')),
        ));
    }

    public function addAction()
    {
        $form = new Add();
        $variables = array('form' => $form);

        if ($this->request->isPost()) {
            $news = new NewsPost();
            $form->bind($news);
            $form->setInputFilter(new AddNewsPost());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
               // $this->getNewsService()->save($news);
                $this->flashMessenger()->addSuccessMessage('The News Post has been added!');
            }
        }

        return new ViewModel($variables);
    }

    public function viewNewsPostAction()
    {
        $categorySlug = $this->params()->fromRoute('categorySlug');
        $NewsPostSlug = $this->params()->fromRoute('PostSlug');
        $NewsPost = $this->getNewsService()->find($categorySlug, $NewsPostSlug);

        if ($NewsPost == null) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
        }

        return new ViewModel(array(
            'Post' => $NewsPost,
        ));
    }

    public function editAction()
    {
        $form = new Edit();

        if ($this->request->isPost()) {
            $NewsPost = new NewsPost();
            $form->bind($NewsPost);
            $form->setData($this->request->getPost());


            if ($form->isValid()) {
                $this->getNewsService()->update($NewsPost);
                $this->flashMessenger()->addSuccessMessage('The Post has been updated!');
            }
        } else {
            $NewsPost = $this->getNewsService()->findById($this->params()->fromRoute('PostId'));

            if ($NewsPost == null) {
                $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            } else {
                $form->bind($NewsPost);
                $form->get('category_id')->setValue($NewsPost->getCategory()->getId());
                $form->get('slug')->setValue($NewsPost->getSlug());
                $form->get('id')->setValue($NewsPost->getId());
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function deleteAction()
    {
        $this->getNewsService()->delete($this->params()->fromRoute('PostId'));
        $this->flashMessenger()->addSuccessMessage('The News Post has been deleted!');
        return $this->redirect()->toRoute('news');
    }

    /**
     * @return \News\Service\NewsService $NewsService
     */
    protected function getNewsService()
    {
        return $this->getServiceLocator()->get('News\Service\NewsService');
    }
} 