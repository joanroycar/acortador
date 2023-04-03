<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable =[
        'country','short_link_id'
    ];
    
    public function shortLinks(){
        return $this->belongsTo(ShortLink::class);
    }
}
