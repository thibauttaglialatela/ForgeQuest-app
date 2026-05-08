<?php

declare(strict_types=1);

namespace App\Tests\Voter;

use App\Entity\Review;
use App\Entity\User;
use App\Voter\ReviewVoter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

final class ReviewVoterTest extends TestCase
{
    private function createToken(User $user): TokenInterface
    {
        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($user);

        return $token;
    }

    public function testAnotherUserCannotReview(): void
    {
        $author = $this->createMock(User::class);
        $hacker = $this->createMock(User::class);

        $currentDate = new \DateTimeImmutable();
        $review      = new Review();
        $review->setAuthor($author);
        $review->setComment('commentaire');
        $review->setGrade(3);
        $review->setCreatedAt($currentDate);

        $authChecker = $this->createMock(AuthorizationCheckerInterface::class);
        $authChecker->method('isGranted')->willReturn(false);

        $voter = new ReviewVoter();

        $token = $this->createToken($hacker);

        $result = $voter->vote($token, $review, [ReviewVoter::DELETE]);

        $this->assertSame(VoterInterface::ACCESS_DENIED, $result);
    }

    public function testUserCanDeleteHisOwnReview(): void
    {
        $author = $this->createMock(User::class);

        $currentDate = new \DateTimeImmutable();
        $review      = new Review();
        $review->setAuthor($author);
        $review->setComment('commentaire');
        $review->setGrade(3);
        $review->setCreatedAt($currentDate);

        $authChecker = $this->createMock(AuthorizationCheckerInterface::class);
        $authChecker->method('isGranted')->willReturn(true);

        $voter = new ReviewVoter();

        $token = $this->createToken($author);

        $result = $voter->vote($token, $review, [ReviewVoter::DELETE]);

        $this->assertSame(VoterInterface::ACCESS_GRANTED, $result);
    }
}
