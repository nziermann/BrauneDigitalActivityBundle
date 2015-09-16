<?php
namespace BrauneDigital\ActivityBundle\EventListener;

use BrauneDigital\ActivityBundle\Services\ActivityBuilder;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class DoctrineSubscriber implements EventSubscriber
{
    public function __construct(ActivityBuilder $activityBuilder) {
        $this->activityBuilder = $activityBuilder;
    }
    public function getSubscribedEvents()
    {
        return array(Events::postUpdate, Events::postPersist);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->activityBuilder->update($args->getEntity());
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->activityBuilder->persist($args->getEntity());
    }
}