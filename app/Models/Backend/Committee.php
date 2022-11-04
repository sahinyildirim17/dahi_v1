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

class Committee extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, LogsActivity;

    protected $fillable = ['has_page','name','description','slug','external_url_title','external_url','order'];


    public function members(){
        return $this->hasMany(CommitteeMember::class,'committee_id','id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('committee');
        // Chain fluent methods for configuration options
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName=='created'){
            $description='Kurul eklendi.';
        }else if($eventName=='deleted'){
            $description='Kurul silindi.';
        }else{
            $description='Kurul güncellendi.';
        }
        $activity->description = $description;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb64')
            ->width(64);

        $this->addMediaConversion('small')
            ->width(150);
    }

}
