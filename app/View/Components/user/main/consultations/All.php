<?php

namespace App\View\Components\user\main\consultations;

use App\Models\ApplyInfo;
use App\Models\ApplyStatuses;
use App\Models\User;
use Illuminate\View\Component;

class All extends Component
{
    public User $user;
    public $activeConsults;
    public $endedConsults;
    public $applies;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->activeConsults = collect();
        $this->endedConsults = collect();
        $this->applies = collect();

        $this->user = $user;

        $allApplies = $this->user->getApplies();

        //dd($allApplies);
        foreach($allApplies as $apply)
        {
            $customer = $apply->apply_user()->getCustomer();
            $specialist = $apply->apply_user()->getSpecialist();
            $newApply = new ApplyInfo($apply, $customer, $specialist);

            if($apply->status == ApplyStatuses::STATUSES['sended'])
                $this->applies->push($newApply);
            else if($apply->status == ApplyStatuses::STATUSES['replied'])
                $this->activeConsults->push($newApply);
            else 
                $this->endedConsults->push($newApply);
            
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.main.consultations.all');
    }
}
