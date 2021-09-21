<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'requirement', 'content', 'course_id', 'learn_time'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'lesson_id')->where('course_id', null);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_users', 'lesson_id', 'user_id')->withPivot('learned')->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'lesson_id');
    }

    public function getUsersAttribute()
    {

        return $this->users()->get();
    }

    public function getNumberUsersAttribute()
    {
        return $this->users()->count();
    }

    public function getDocumentsAttribute()
    {
        return $this->documents()->get();
    }

    public function getReviewsAttribute()
    {
        return $this->reviews()->get();
    }

    public function getFiveStarsRateAttribute()
    {
        return $this->reviews()->where('rate', '=', '5')->count();
    }

    public function getFiveStarsRatePercentAttribute()
    {
        $numberReviews = count($this->getReviewsAttribute());

        if($numberReviews == 0) {
            return 0;
        } else {
            return round(($this->getFiveStarsRateAttribute() / $numberReviews) * 100, 1);
        }
    }

    public function getFourStarsRateAttribute()
    {
        return $this->reviews()->where('rate', '=', '4')->count();
    }

    public function getFourStarsRatePercentAttribute()
    {
        $numberReviews = count($this->getReviewsAttribute());

        if($numberReviews == 0) {
            return 0;
        } else {
            return round(($this->getFourStarsRateAttribute() / $numberReviews) * 100, 1);
        }
    }

    public function getThreeStarsRateAttribute()
    {
        return $this->reviews()->where('rate', '=', '3')->count();
    }

    public function getThreeStarsRatePercentAttribute()
    {
        $numberReviews = count($this->getReviewsAttribute());

        if($numberReviews == 0) {
            return 0;
        } else {
            return round(($this->getThreeStarsRateAttribute() / $numberReviews) * 100, 1);
        }
    }

    public function getTwoStarsRateAttribute()
    {
        return $this->reviews()->where('rate', '=', '2')->count();
    }

    public function getTwoStarsRatePercentAttribute()
    {
        $numberReviews = count($this->getReviewsAttribute());

        if($numberReviews == 0) {
            return 0;
        } else {
            return round(($this->getTwoStarsRateAttribute() / $numberReviews) * 100, 1);
        }
    }

    public function getOneStarRateAttribute()
    {
        return $this->reviews()->where('rate', '=', '1')->count();
    }

    public function getOneStarRatePercentAttribute()
    {
        $numberReviews = count($this->getReviewsAttribute());

        if($numberReviews == 0) {
            return 0;
        } else {
            return round(($this->getOneStarRateAttribute() / $numberReviews) * 100, 1);
        }
    }

    public function getRatingOverviewScoreAttribute()
    {
        $numberReviews = count($this->getReviewsAttribute());
        $fiveStarReviews = $this->getFiveStarsRateAttribute();
        $fourStarReviews = $this->getFourStarsRateAttribute();
        $threeStarReviews = $this->getThreeStarsRateAttribute();
        $twoStarReviews = $this->getTwoStarsRateAttribute();
        $oneStarReview = $this->getOneStarRateAttribute();

        if($numberReviews == 0) {
            return $numberReviews;
        } else {
            $ratingOverview = ($fiveStarReviews * 5 + $fourStarReviews * 4 + $threeStarReviews * 3 + $twoStarReviews * 2 + $oneStarReview) / $numberReviews;
            $difference = $ratingOverview - (int)$ratingOverview;
            if($difference < 0.25) {
                return number_format((int)$ratingOverview, 1);
            } elseif($difference >= 0.25 && $difference < 0.75) {
                return (int)$ratingOverview + 0.5;
            } elseif($difference >= 0.75) {
                return number_format((int)$ratingOverview + 1, 1);
            }
        }
    }


    public function getProgressAttribute()
    {
        $isLearnedDocuments = DocumentUser::query()->isLearnedDocuments(Auth::id(), $this->id)->count();
        $allDocumentsOfLesson = ($this->documents()->count() == 0) ? 1 : $this->documents()->count();
        $percentage = ($isLearnedDocuments / $allDocumentsOfLesson) * 100;
        return ($percentage == null) ? 0 : $percentage;
    }

    public function scopeSearch($query, $data, $courseId)
    {
        $query->where([
            ['course_id', '=', $courseId],
            ['title', 'like', '%' . $data['search_form_input'] . '%']
        ]);
    }
}
