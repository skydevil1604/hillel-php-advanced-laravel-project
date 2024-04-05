<?php

namespace App\Models;

use App\Services\Contract\FileServiceContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'imageable_id', 'imageable_type'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function url(): Attribute
    {
        return Attribute::get(fn () => Storage::url($this->attributes['path']));
    }

    public function setPathAttribute($path): void
    {
        $this->attributes['path'] = app(FileServiceContract::class)->upload(
            $path['image'],
            $path['directory'] ?? null
        );
    }
}
