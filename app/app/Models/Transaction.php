<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'status',
        'email',
    ];

    public static function single($id){
        $transactions =self::all();

        foreach($transactions as $transaction){
            if($transaction['id'] == $id){
                return $transaction;
            }
        }
    }
}
