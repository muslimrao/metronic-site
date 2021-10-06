<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tmp_Images_Upload extends Model
{
    use HasFactory;

    protected $table 		= 'tmp_images_upload';
    protected $primaryKey 	= 'id';
}
