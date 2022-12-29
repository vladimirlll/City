<?php

namespace App\View\Components\review;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class AllReviews extends Component
{
    public Collection $userReviews;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $userReviews)
    {
        $this->userReviews = $userReviews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.review.all-reviews');
    }
}
