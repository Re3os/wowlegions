<?php

namespace App\Forum;

use App\Events\ThreadReceivedNewReply;
use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $with = ['creator', 'channel'];
    protected $appends = ['isSubscribedTo'];
    protected $casts = [
        'locked' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->each->delete();
        });

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);
        });
    }

    public function path()
    {
        return app()->getLocale() . "/forums/topic/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply($reply)
    {
        $reply = $this->create($reply);

        event(new ThreadReceivedNewReply($reply));

        return $reply;
    }

    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function hasUpdatesFor($user)
    {
        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
    }

    public function markBestReply(Reply $reply)
    {
        $this->update(['best_reply_id' => $reply->id]);
    }

    public function toSearchableArray()
    {
        return $this->toArray() + ['path' => $this->path()];
    }
}
