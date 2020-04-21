<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GrahamCampbell\Markdown\Facades\Markdown;


class Post extends Model


{
//    protected $attributes = [
//        'view_count' => 1
//    ];

    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id', 'image', 'view_count'];

    protected $dates = ['published_at'];


    public function author()
    {
        return $this->belongsTo(User::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function commentsNumber($label = 'Comment') {
        $commentsNumber = $this->comments->count();
        return $commentsNumber . " " . str_plural($label, $commentsNumber);
    }

    public function createComment(array $data) {
         $this->comments()->create($data);
    }





    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ? : NULL;
    }


    public function tags() {
       return $this->belongsToMany(Tag::class);
    }





    public function getImageUrlAttribute($value)
    {

        $imageUrl = "";

        if (!is_null($this->image)) {

            $directory = config('cms.image.directory');
            $imagePath = public_path() . "/{$directory}/" . $this->image;
            if (file_exists($imagePath)) {
                $imageUrl = asset("{$directory}/" . $this->image);
            }
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {

        $imageUrl = "";

        if (!is_null($this->image)) {

            $directory = config('cms.image.directory');

            $text = substr(strrchr($this->image, '.'), 1);

            $thumbnail = str_replace(".{$text}", "_thumb.{$text}", $this->image);
            $imagePath = public_path() . "/{$directory}/" . $this->$thumbnail;
            if (file_exists($imagePath)) {
                $imageUrl = asset("{$directory}/" . $thumbnail);
            }
        }

        return $imageUrl;
    }

    public function getDateAttribute()
    {
        //return date only if published_at is not NULL
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where("published_at", "<=", Carbon::now());
    }
    public function scopeScheduled($query)
    {
        return $query->where("published_at", ">", Carbon::now());
    }


    public function scopeDraft($query)
    {
        return $query->whereNull("published_at");
    }

    public function scopeFilter($query, $filter) {

        if (isset($filter['month']) && $month = $filter['month']) {
            $query->whereRaw('month(published_at) = ?', [Carbon::parse($month)->month]);
        }

        if (isset($filter['year']) && $year   = $filter['year']) {
            $query->whereRaw('year(published_at) = ?', [$year]);
        }

        if (isset($filter['term']) && $term = $filter['term']) {
            $query->where(function($q) use ($term) {
                $q->whereHas('author', function ($qr) use ($term) {
                    $qr->where('name', 'LIKE', "%{$term}%");
                });

                $q->orwhereHas('category', function ($qr) use ($term) {
                    $qr->where('title', 'LIKE', "%{$term}%");
                });

                $q->orwhere('title', 'LIKE', "%{$term}%");
                $q->orwhere('excerpt', 'LIKE', "%{$term}%");
                $q->orwhere('body', 'LIKE', "%{$term}%");
            });
        }
    }



    public function getExcerptHtmlAttribute($value)
    {
        return $this->excerpt ? Markdown::convertToHTML(e($this->excerpt)) : NULL;
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? Markdown::convertToHTML(e($this->body)) : NULL;
    }

    public function getTagsHtmlAttribute($value) {

        $anchors = [];

        foreach($this->tags as $tag) {
            $anchors[] = '<a href="' . route('tag', $tag->slug) . ' "> ' . $tag->name . '</a>';
        }

        return implode(",", $anchors);
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if ($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);

    }

    public function publicationLabel() {

        if (!$this->published_at) {
            return '<span class="label label-warning">Draft</span>';
        }elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="label label-info">Scheduled</span>';
        }
        else {
            return '<span class="label label-success">Published</span>';
        }

    }

    public function createTags($tagString)
    {
        $tags = explode(",", $tagString);
        $tagIds = [];

        foreach ($tags as $tag)
        {

            $newTag = Tag::firstOrCreate(
                ['slug' => str_slug($tag)], ['name' => trim($tag)]
            );

//            $newTag = new Tag();
//            $newTag->name = ucwords(trim($tag));
//            $newTag->slug = str_slug($tag);
//            $newTag->save();
//
//            $tagIds[] = $newTag->id;
        }
        $this->tags()->detach();
        $this->tags()->attach($tagIds);

        //$this->tags()->sync($tagIds);
    }

    public function getTagsListAttribute()
    {
        return $this->tags->pluck('name');
    }

}
