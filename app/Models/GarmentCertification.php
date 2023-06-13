<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarmentCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'branch_office_id',
        'description',
        'carat',
        'image',
        'weight',
        'stone_type',
        'price',
        'observations'
    ];


    public function clients(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function nCertification(){
        $prefix = "CP-";
        $n_certification = str_pad($this->id, 3, '0', STR_PAD_LEFT);
        return $prefix.$n_certification;
    }


    public function date_created(){
        return date_format($this->created_at, "d-m-Y");
    }
}
