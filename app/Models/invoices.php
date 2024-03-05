<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'invoice_number',
        'invoice_Date',
        'due_date',
        'product',
        'section_id',
        'amount_collection',
        'amount_comission',
        'discount',
        'value_vat',
        'rate_vat',
        'Total',
        'Status',
        'value_status',
        'note',
        'user',
        'Payment_Date',
    ];
    
    public function section(){
        return $this->belongsTo(Sections::class);
    }
}
