<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['view_count'];

    protected $dates = ['published_at'];


    public function author() {
        return $this->belongsTo( User::class);
    }


    public function category() {
        return $this->belongsTo(Category::class);
    }




    public function getImageUrlAttribute($value) {

        $imageUrl = "";

        if (!is_null($this->image)) {

            $imagePath = public_path() . "/img/" . $this->image;
            if (file_exists($imagePath)) {
                $imageUrl = asset("img/" . $this->image);
            }
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value) {

        $imageUrl = "";

        if (!is_null($this->image)) {

            $text = substr(strrchr($this->image, '.'), 1);

            $thumbnail = str_replace(".{$text}", "_thumb.{$text}", $this->image);
            $imagePath = public_path() . "/img/" . $this->$thumbnail;
            if (file_exists($imagePath)) {
                $imageUrl = asset("img/" . $thumbnail  );
            }
        }

        return $imageUrl;
    }

    public function getDateAttribute() {
        //return date only if published_at is not NULL
        return is_null($this->published_at) ? ''  : $this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($query) {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePopular($query) {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopePublished($query) {
        return $query->where("published_at", "<=", Carbon::now());
    }



    public function getExcerptHtmlAttribute($value) {
        return $this->excerpt ? Markdown::convertToHTML(e($this->excerpt)) : NULL;
    }

    public function getBodyHtmlAttribute($value) {
        return $this->body ? Markdown::convertToHTML(e($this->body)) : NULL;
    }



}
