<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSos extends Model
{
    use HasFactory;

    protected $table = 'contactsos';
    protected $primaryKey = 'cs_id';

}
