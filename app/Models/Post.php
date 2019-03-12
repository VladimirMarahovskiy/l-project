<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Intervention\Image\Facades\Image;

class Post extends Model
{
    use CrudTrait;

    const IMAGES_DIR = '/uploads/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'content',
        'views',
        'comments',
        'posted_at',
        'slug',
        'image',
        'thumbnail_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'posted_at'
    ];


    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        if (request()->expectsJson()) {
            return 'id';
        }

        return 'slug';
    }

    public function setPostedAtAttribute($value)
    {
        $this->attributes['posted_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setImageAttribute($value)
    {
        if (!is_null($value)) {
            $image = $value;
            $file_name = md5(time() . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image = Image::make($image)->save(public_path(self::IMAGES_DIR . $file_name));

            $this->attributes['image'] = $file_name;
        } else {
            $this->attributes['image'] = '';
        }
    }

    public function getImageAttribute()
    {

        return !empty($this->attributes['image']) ? self::IMAGES_DIR . $this->attributes['image'] : '';
    }


    /**
     * Scope a query to most read
     */
    public function scopeMostRead(Builder $query, int $limit = 5): Builder
    {
        return $query->orderBy('posted_at', 'desc')
            ->limit($limit);
    }

    /**
     * Scope a query to most read
     */
    public function scopeRecentPost(Builder $query, int $limit = 5): Builder
    {
        return $query->orderBy('posted_at', 'desc')
            ->limit($limit);
    }

    /**
     * Scope a query to search posts
     */
    public function scopeSearch(Builder $query, ?string $search)
    {
        if ($search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        }
    }

    /**
     * Scope a query to order posts by latest posted
     */
    public function scopeLatestPosts(Builder $query, int $limit = 2): Builder
    {
        return $query->orderBy('posted_at', 'desc')
            ->latest()
            ->limit($limit);
    }

    /**
     * Scope a query to order posts by category
     */
    public function scopeCategories(Builder $query, int $category): Builder
    {
        return $query->orderBy('posted_at', 'desc')
            ->where('category_id', $category);
    }

    /**
     * Scope a query to remove old posts
     */
    public function scopeOldPosts(Builder $query, $day): Builder
    {
        return $query->where('posted_at', '<', Carbon::now()->subDays(25));
    }


    /**
     * Scope a query to only include posts posted last month.
     */
    public function scopeLastMonth(Builder $query, int $limit = 5): Builder
    {
        return $query->whereBetween('posted_at', [carbon('1 month ago'), now()])
            ->latest()
            ->limit($limit);
    }

    /**
     * Scope a query to only include posts posted last week.
     */
    public function scopeLastWeek(Builder $query): Builder
    {
        return $query->whereBetween('posted_at', [carbon('1 week ago'), now()])
            ->latest();
    }

    /**
     * Return the post's author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Return the post's comments
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * return the excerpt of the post content
     */
    public function excerpt(int $length = 50): string
    {
        return str_limit($this->content, $length);
    }

}
