<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTags, SoftDeletes, LogsActivity;

    protected $fillable = ['writer_id','post_type','title','content','slug','is_active','is_featured'];
    protected static $logAttributes = ['title','content','slug','is_active','is_featured'];


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            //->height(84)
            ->sharpen(10);

        $this->addMediaConversion('thumb_midsize')
            ->width(300)
            //->height(168)
            ->sharpen(10);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('post');
        // Chain fluent methods for configuration options
    }

    public function tapActivity(Activity $activity, string $eventName)
    {

        if($eventName=='created'){
            $description='İçerik eklendi.';
        }else if($eventName=='deleted'){
            $description='İçerik silindi.';
        }else{
            $description='İçerik güncellendi.';
        }
        $activity->description = $description;
    }
}
