<?php

declare(strict_types=1);

namespace App\EventListener;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: BeforeEntityPersistedEvent::class)]
class GlobalCreatedAtListener
{
    public function __construct(private readonly Security $security)
    {
    }

    public function __invoke(BeforeEntityPersistedEvent $beforeEntityPersistedEvent): void
    {
        /** @var object $entity */
        $entity = $beforeEntityPersistedEvent->getEntityInstance();

        if (!is_object($entity)) {
            return;
        }

        if (property_exists($entity, 'createdAt') && method_exists($entity, 'setCreatedAt')) {
            // @phpstan-ignore-next-line
            if (null === $entity->getCreatedAt()) {
                $entity->setCreatedAt(new \DateTimeImmutable());
            }
        }

        if (property_exists($entity, 'author') && method_exists($entity, 'setAuthor')) {
            // @phpstan-ignore-next-line
            if (null === $entity->getAuthor()) {
                $entity->setAuthor($this->security->getUser());
            }
        }
    }
}
