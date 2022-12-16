<?php

namespace App\View\Components\user\review;

use App\Models\User;
use Illuminate\View\Component;

class ReviewMain extends Component
{
    public User $me;
    public User $another;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $me, User $another)
    {
        $this->me = $me;
        $this->another = $another;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.review.review-main');
    }
}
