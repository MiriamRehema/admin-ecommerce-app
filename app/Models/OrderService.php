<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderService extends Model
{
    use HasFactory;

    protected $table = 'order_services';

    protected $fillable = [
        
        'service_request_id',
        'service_id',
        'quantity',
        'unit_amount',
        'total_amount',
        
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
