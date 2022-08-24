<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'logo'
    ];

    public function getLogoAttribute($value){
        if($value != '' && $value != null){
            if(isset($value)) {
                return (url('public/storage/logo/').'/').$value;
            }else{
                return '';
            }
        }else {
            return '';
        }
    }
}
