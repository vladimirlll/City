<?php

namespace App\View\Components\user\review;

use App\Models\Apply;
use App\Models\ConsulationRatesConstants;
use App\Models\Roles;
use App\Models\User;
use Doctrine\StaticAnalysis\DBAL\MyConnection;
use Illuminate\View\Component;

class ReviewMain extends Component
{
    public User $me;
    public User $another;
    public Apply $apply;
    public $myComment;
    public $myRate;
    public $minRate;
    public $maxRate;
    public $step;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $me, User $another, Apply $apply)
    {
        $this->me = $me;
        $this->another = $another;
        $this->apply = $apply;
        $myCommentFieldName = Roles::getNameOfNum($this->me->role_id) . "_comment";
        $myRateFieldName = Roles::getNameOfNum($this->me->role_id) . "_rate";
        $this->myComment = $this->apply->{$myCommentFieldName};
        $this->myRate = $this->apply->{$myRateFieldName};
        
        $this->minRate = ConsulationRatesConstants::MIN_RATE;
        $this->maxRate = ConsulationRatesConstants::MAX_RATE;
        $this->step = ConsulationRatesConstants::STEP;
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
