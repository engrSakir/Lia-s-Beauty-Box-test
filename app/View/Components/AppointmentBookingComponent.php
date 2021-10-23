<?php

namespace App\View\Components;

use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\View\Component;

class AppointmentBookingComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $users, $serviceCategories;

    public function __construct()
    {
        $this->users = User::all();
        $this->serviceCategories = ServiceCategory::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.appointment-booking-component');
    }
}
