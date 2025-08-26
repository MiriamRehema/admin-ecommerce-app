<?php

namespace App\Livewire\ServiceRequests;

use Livewire\Component;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\OrderService;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $mode = 'index';

    public $serviceRequests;
    public $users;
    public $services;

    public $user_id;
    public $payment_method;
    public $payment_status;
    public $status = 'new';
    public $currency = 'USD';
    public $grand_total = 0;

    public $orderServices = [];

    public $selectedRequest;
    public $confirmingDelete = false;
    public $requestToDelete;

    public function mount()
    {
        $this->users = User::all();
        $this->services = Service::all();
        $this->resetOrderServices();
    }

    public function render()
    {
        $this->serviceRequests = ServiceRequest::with('user')->latest()->get();
        return view('livewire.service-requests.index');
    }

    public function resetOrderServices()
    {
        $this->orderServices = [
            ['service_id' => null, 'quantity' => 1, 'unit_amount' => 0, 'total_amount' => 0]
        ];
    }

    public function create()
    {
        $this->resetForm();
        $this->mode = 'create';
    }

    public function resetForm()
    {
        $this->user_id = null;
        $this->payment_method = null;
        $this->payment_status = null;
        $this->status = 'new';
        $this->currency = 'USD';
        $this->grand_total = 0;
        $this->resetOrderServices();
    }

    public function addService()
    {
        $this->orderServices[] = ['service_id' => null, 'quantity' => 1, 'unit_amount' => 0, 'total_amount' => 0];
    }

    public function removeService($index)
    {
        unset($this->orderServices[$index]);
        $this->orderServices = array_values($this->orderServices); // Reindex
    }

    public function calculateTotal()
    {
        $this->grand_total = collect($this->orderServices)->sum('total_amount');
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'status' => 'required|string',
            'currency' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $this->calculateTotal();

            $request = ServiceRequest::create([
                'user_id' => $this->user_id,
                'payment_method' => $this->payment_method,
                'payment_status' => $this->payment_status,
                'status' => $this->status,
                'currency' => $this->currency,
                'grand_total' => $this->grand_total,
            ]);

            foreach ($this->orderServices as $service) {
                OrderService::create([
                    'service_request_id' => $request->id,
                    'service_id' => $service['service_id'],
                    'quantity' => $service['quantity'],
                    'unit_amount' => $service['unit_amount'],
                    'total_amount' => $service['total_amount'],
                ]);
            }

            DB::commit();

            session()->flash('message', 'Service request created successfully.');
            $this->mode = 'index';
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->mode = 'edit';

        $request = ServiceRequest::with('orderServices')->findOrFail($id);
        $this->selectedRequest = $request;

        $this->user_id = $request->user_id;
        $this->payment_method = $request->payment_method;
        $this->payment_status = $request->payment_status;
        $this->status = $request->status;
        $this->currency = $request->currency;
        $this->grand_total = $request->grand_total;

        $this->orderServices = $request->orderServices->map(function ($service) {
            return [
                'service_id' => $service->service_id,
                'quantity' => $service->quantity,
                'unit_amount' => $service->unit_amount,
                'total_amount' => $service->total_amount,
            ];
        })->toArray();
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'status' => 'required|string',
            'currency' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $this->calculateTotal();

            $this->selectedRequest->update([
                'user_id' => $this->user_id,
                'payment_method' => $this->payment_method,
                'payment_status' => $this->payment_status,
                'status' => $this->status,
                'currency' => $this->currency,
                'grand_total' => $this->grand_total,
            ]);

            OrderService::where('service_request_id', $this->selectedRequest->id)->delete();

            foreach ($this->orderServices as $service) {
                OrderService::create([
                    'service_request_id' => $this->selectedRequest->id,
                    'service_id' => $service['service_id'],
                    'quantity' => $service['quantity'],
                    'unit_amount' => $service['unit_amount'],
                    'total_amount' => $service['total_amount'],
                ]);
            }

            DB::commit();

            session()->flash('message', 'Service request updated successfully.');
            $this->mode = 'index';
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $this->selectedRequest = ServiceRequest::with(['user', 'orderServices.services'])->findOrFail($id);
        $this->mode = 'show';
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->requestToDelete = $id;
    }

    public function deleteConfirmed()
    {
        $request = ServiceRequest::findOrFail($this->requestToDelete);

        $request->orderServices()->delete();
        $request->delete();

        $this->confirmingDelete = false;
        $this->requestToDelete = null;
        $this->mode = 'index';

        session()->flash('message', 'Service request deleted.');
    }
}
