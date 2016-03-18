<?php

namespace News\Form;

use News\Entity\Hydrator\CategoryHydrator;
use News\Entity\Hydrator\NewsPostHydrator;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
class Add extends Form
{
    public function __construct()
    {
        parent::__construct('add');

        $hydrator = new AggregateHydrator();
        $hydrator->add(new NewsPostHydrator());
//        $hydrator->add(new CategoryHydrator());
        $this->setHydrator($hydrator);

        $title = new Element\Text('title');
        $title->setLabel('Title');
        $title->setAttribute('class', 'form-control');

        $description = new Element\Text('description');
        $description->setLabel('Desciption');
        $description->setAttribute('class', 'form-control');

        $content = new Element\Textarea('content');
        $content->setLabel('Content');
        $content->setAttribute('class', 'form-control');

        $Published_date = new Element\DateSelect('Published_date');
        $Published_date->setLabel('Publish date');
        $Published_date->setAttribute('class', 'form-control');

//        $category = new Element\Select('category_id');
//        $category->setLabel('Category');
//        $category->setAttribute('class', 'form-control');
//        $category->setValueOptions(array(
//            1 => 'WIN',
//            2 => 'BUILD',
//            3 => 'SEND',
//            4 => 'GENERAL',
//        ));

        $submit = new Element\Submit('submit');
        $submit->setValue('Add News');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($title);
        $this->add($description);
        $this->add($content);
        $this->add($Published_date);
        $this->add($submit);
    }
} 