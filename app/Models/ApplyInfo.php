<?php

namespace App\Models;

use DateTime;

class ApplyInfo 
{
    private Apply $apply;
    private User $customer;
    private User $specialist;

    function __construct(Apply $apply, User $customer, User $specialist)
    {
        $this->apply = $apply;
        $this->customer = $customer;
        $this->specialist = $specialist;
    }

    public function getApply() {return $this->apply;}
    public function getCustomer() {return $this->customer;}
    public function getSpecialist() {return $this->specialist;}
}
