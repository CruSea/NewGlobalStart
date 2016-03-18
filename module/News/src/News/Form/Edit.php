<?php

namespace News\Form;

use News\Entity\Hydrator\CategoryHydrator;
use News\Entity\Hydrator\NewsPostHydrator;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class Edit extends Form
{
    public function __construct()
    {
        parent::__construct('edit');

        $hydrator = new AggregateHydrator();
        $hydrator->add(new NewsPostHydrator());
        $hydrator->add(new CategoryHydrator());
        $this->setHydrator($hydrator);

        $id = new Element\Hidden('id');

        $title = new Element\Text('title');
        $title->setLabel('Title');
        $title->setAttribute('class', 'form-control');

        $slug = new Element\Text('slug');
        $slug->setLabel('Slug');
        $slug->setAttribute('class', 'form-control');

        $content = new Element\Textarea('content');
        $content->setLabel('Content');
        $content->setAttribute('class', 'form-control');

        $category = new Element\Select('category_id');
        $category->setLabel('Category');
        $category->setAttribute('class', 'form-control');
        $category->setValueOptions(array(
            1 => 'WIN',
            2 => 'BUILD',
            3 => 'SEND',
            4 => 'GENERAL',
        ));

        $submit = new Element\Submit('submit');
        $submit->setValue('Add news');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($id);
        $this->add($title);
        $this->add($slug);
        $this->add($content);
        $this->add($category);
        $this->add($submit);
    }
}