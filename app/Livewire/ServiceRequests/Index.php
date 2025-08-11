<?php

namespace App\Livewire\ServiceRequests;

use Livewire\Component;
use App\Models\ServiceRequest;
use App\Models\Service;
use App\Models\User;

class Index extends Component
{
    public function render()
    {
       return view('livewire.service-requests.index',[
            'service_requests' => ServiceRequest::all(),
            'services' => Service::all(),
            'users' => ServiceRequest::with('user')->get(),
        ]);
    }
}
