<?php

namespace App\View\Components\Alerts;

use Illuminate\View\Component;

class SessionAlert extends Component
{
    /** Will store the alert types and messages */
    public $alerts = array();

    private $alertTypes = array(
        'primary',
        'secondary',
        'success',
        'danger',
        'warning',
        'info',
        'light',
        'dark',
    );

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        if (session()->has('alerts')) {
            $alertList = session()->get('alerts');

            foreach ($alertList as $alertType => $alertMessage) {
                if(in_array($alertType,$this->alertTypes)){
                    $this->alerts[$alertType] = $alertMessage;
                }else{
                    $this->alerts['info'] = $alertMessage;
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alerts.session-alert');
    }
}
