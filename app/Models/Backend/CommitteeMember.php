<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CommitteeMember extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected $table='committee_has_members';
    protected $fillable = ['committee_id','user_id','name','surname','photo','order','roles'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('small64')
            ->width(64);
        $this->addMediaConversion('small128')
            ->width(128);
        $this->addMediaConversion('256')
            ->width(128);
        $this->addMediaConversion('512')
            ->width(128);
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
            $description='Kurul üyesi eklendi.';
        }else if($eventName=='deleted'){
            $description='Kurul üyesi silindi.';
        }else{
            $description='Kurul üyesi güncellendi.';
        }
        $activity->description = $description;
    }
}
