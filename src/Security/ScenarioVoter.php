<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\Scenario;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class ScenarioVoter extends Voter
{
    public const DELETE = 'delete';
    public const EDIT   = 'edit';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::DELETE, self::EDIT], true)) {
            return false;
        }

        if (!$subject instanceof Scenario) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }
        /** @var Scenario $scenario */
        $scenario = $subject;

        return match ($attribute) {
            self::DELETE => $this->canDelete($scenario, $user),
            self::EDIT   => $this->canEdit($scenario, $user),
            default      => throw new \LogicException('This code should not be reached!'),
        };
    }

    private function canEdit(Scenario $scenario, User $user): bool
    {
        return $user === $scenario->getAuthor();
    }

    private function canDelete(Scenario $scenario, User $user): bool
    {
        if ($this->canEdit($scenario, $user)) {
            return true;
        }

        return false;
    }
}
