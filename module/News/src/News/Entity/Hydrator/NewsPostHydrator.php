<?php

namespace News\Entity\Hydrator;

use News\Entity\NewsPost;
use Zend\Stdlib\Hydrator\HydratorInterface;

class NewsPostHydrator implements HydratorInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     *
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof NewsPost) {
            return array();
        }

        return array(
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'description' => $object->getDescription(),
            'content' => $object->getContent(),
            'published_date' => $object->getPublishedDate(),
        );
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     *
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof NewsPost) {
            return $object;
        }

        $object->setId(isset($data['id']) ? intval($data['id']) : null);
        $object->setTitle(isset($data['title']) ? $data['title'] : null);
        $object->setDescription(isset($data['description']) ? $data['description'] : null);
        $object->setContent(isset($data['content']) ? $data['content'] : null);
        $object->setPublishedDate(isset($data['published_date']) ? $data['published_date'] : null);

        return $object;
    }
}