<?php

namespace App\Models;

use DateTime;

class ApplyInfo 
{
    private $id;
    private User $customer;
    private User $specialist;
    private $platform;
    private $dtime;
    private $status;
    private $link;

    function __construct($id, User $customer, User $specialist, $platform, $dtime, $status, $link)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->specialist = $specialist;
        $this->platform = $platform;
        $this->dtime = $dtime;
        $this->status = $status;
        $this->link = $link;
    }

    public function getCustomer() {return $this->customer;}
    public function getSpecialist() {return $this->specialist;}
    public function getPlatform() {return $this->platform;}
    public function getDateTime() {return $this->dtime;}
    public function getId() {return $this->id;}
    public function getStatus() {return $this->status;}
    public function getLink() {return $this->link;}
}
