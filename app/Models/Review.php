<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review
{
    private User $reviewBy;
    private Apply $apply;
    private $mark;
    private $comment;

    public const MAX_MARK = 10;

    public function __construct(User $reviewBy, Apply $apply, $mark, $comment)
    {
        $this->reviewBy = $reviewBy;
        $this->apply = $apply;
        $this->mark = $mark;
        $this->comment = $comment;
    }

    public function getReviewBy() : User {return $this->reviewBy;}
    public function getApply() : Apply {return $this->apply;}
    public function getMark() {return $this->mark;}
    public function getComment() {return $this->comment;}
}
