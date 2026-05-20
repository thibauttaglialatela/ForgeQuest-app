<?php

declare(strict_types=1);

namespace App\Tests\Voter;

use App\Entity\Review;
use App\Entity\User;
use App\Voter\ReviewVoter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

final class ReviewVoterTest extends TestCase
{
    private function createToken(User $user): TokenInterface
    {
        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($user);

        return $token;
    }

    private function createReviewWithAuthor(User $author): Review
    {
        $review = new Review();
        $review->setAuthor($author);
        $review->setComment('Super scénario !');
        $review->setGrade(4);
        $review->setCreatedAt(new \DateTimeImmutable());

        return $review;
    }

    public function testAnotherUserCannotDeleteAReview(): void
    {
        $author = $this->createMock(User::class);
        $hacker = $this->createMock(User::class);
        $review = $this->createReviewWithAuthor($author);

        $voter = new ReviewVoter();
        $token = $this->createToken($hacker);

        $result = $voter->vote($token, $review, [ReviewVoter::DELETE]);

        $this->assertSame(VoterInterface::ACCESS_DENIED, $result);
    }

    public function testUserCanDeleteHisOwnReview(): void
    {
        $author = $this->createMock(User::class);
        $review = $this->createReviewWithAuthor($author);

        $voter = new ReviewVoter();
        $token = $this->createToken($author);

        $result = $voter->vote($token, $review, [ReviewVoter::DELETE]);

        $this->assertSame(VoterInterface::ACCESS_GRANTED, $result);
    }

    public function testAnotherUserCannotEditAReview(): void
    {
        $author = $this->createMock(User::class);
        $hacker = $this->createMock(User::class);
        $review = $this->createReviewWithAuthor($author);

        $voter = new ReviewVoter();
        $token = $this->createToken($hacker);

        $result = $voter->vote($token, $review, [ReviewVoter::EDIT]);

        $this->assertSame(VoterInterface::ACCESS_DENIED, $result);
    }
}
