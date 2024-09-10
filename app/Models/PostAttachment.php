<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

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

    protected static function boot() {
        parent::boot();

        static::deleted(function (self $model) {
            Storage::disk('public')
                ->delete($model->path);
        });
    }


}
