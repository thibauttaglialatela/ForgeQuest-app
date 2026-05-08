<?php

declare(strict_types=1);

namespace App\Voter;

use App\Entity\Review;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ReviewVoter extends Voter
{
    public const DELETE = 'delete';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::DELETE], true)) {
            return false;
        }

        if (!$subject instanceof Review) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token, ?Vote $vote = null): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            $vote?->addReason('Utilisateur non connecté');

            return false;
        }

        /** @var Review $review */
        $review = $subject;

        return match ($attribute) {
            self::DELETE => $this->canDelete($review, $user, $vote),
            default      => throw new \LogicException('This code should not be reached!'),
        };
    }

    private function canDelete(Review $review, User $user, ?Vote $vote): bool
    {
        if ($user === $review->getAuthor()) {
            return true;
        }

        $vote?->addReason(sprintf(
            'L\'utilsateur connecté (email: %s) n\'est pas celui qui a créé ce commentaire (id: %d).', $user->getEmail(), $review->getId()
        ));

        return false;
    }
}
