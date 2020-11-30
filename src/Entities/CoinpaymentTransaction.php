<?php

namespace Hexters\CoinPayment\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CoinpaymentTransaction extends Model {

    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'buyer_name',
        'buyer_email',
        'address',
        'amount',
        'amountf',
        'coin',
        'time_expires',
        'currency_code',
        'confirms_needed',
        'payment_address',
        'qrcode_url',
        'received',
        'receivedf',
        'recv_confirms',
        'status',
        'status_text',
        'status_url',
        'timeout',
        'txn_id',
        'type',
        'payload'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'amountf' => 'double',
        'received' => 'double',
        'receivedf' => 'double',
        'payload' => 'array'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    protected static function boot() {
        parent::boot();

        self::creating(function($model) {
            $model->uuid = (String) Str::uuid();
        });
    }

    public function items() {
        return $this->hasMany(CoinpaymentTransactionItem::class, 'coinpayment_transaction_id', 'id');
    }
}
