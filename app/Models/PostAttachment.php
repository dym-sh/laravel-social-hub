<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAttachment extends Model
{
    use HasFactory;

    // const updated_at = null;

    protected $fillable = [
        'post_id',
        'name',
        'path',
        'mime',
        'size',
        'created_by',
    ];
}
