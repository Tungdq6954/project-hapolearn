<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title', 'logo_path', 'description', 'price'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tags', 'course_id', 'tag_id')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_users', 'course_id', 'user_id')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id');
    }

    public function getNumberLessonAttribute()
    {
        return $this->lessons()->count();
    }

    public function getNumberUserAttribute()
    {
        return $this->users()->count();
    }

    public function getLearnTimeAttribute()
    {
        return $this->lessons()->sum('learn_time');
    }

    public function getLessonsAttribute()
    {
        return $this->lessons()->paginate(config('constants.pagination'));
    }

    public function getTagsAttribute()
    {
        return $this->tags()->get();
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
            } else if($difference >= 0.25 && $difference < 0.75) {
                return (int)$ratingOverview + 0.5;
            } else if($difference >= 0.75) {
                return number_format((int)$ratingOverview + 1, 1);
            }
        }
    }

    public function getTeacherAttribute()
    {
        return $this->users()->where('role', config('constants.role.teacher'))->get();
    }

    public function scopeMainCourse($query)
    {
        return $query->withCount(['users' => function ($subquery) {
            $subquery->where('role', config('constants.role.student'));
        }])->orderByDesc('users_count')->limit(3);
    }

    public function scopeOtherCourse($query, $id)
    {
        return $query->where('id', '<>', $id)->orderByDesc('id');
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['search_form_input'])) {
            $query->where('title', 'like', '%' . $data['search_form_input'] . '%')
                ->orWhere('description', 'like', '%' . $data['search_form_input'] . '%');
        }

        if (isset($data['teacher'])) {
            $query->whereHas('users', function ($subquery) use ($data) {
                $subquery->where('user_id', $data['teacher']);
            });
        }

        if (isset($data['tag'])) {
            $query->whereHas('tags', function ($subquery) use ($data) {
                $subquery->where('tag_id', $data['tag']);
            });
        }

        if (isset($data['newest_oldest'])) {
            if ($data['newest_oldest'] == config('constants.options.desc')) {
                $query->orderByDesc('id');
            } else {
                $query->orderBy('id');
            }
        }

        if (isset($data['number_of_learner'])) {
            if ($data['number_of_learner'] == config('constants.options.desc')) {
                $query->withCount([
                    'users' => function ($subquery) {
                        $subquery->where('role', config('constants.role.student'));
                    }
                ])->orderByDesc('users_count');
            } else {
                $query->withCount([
                    'users' => function ($subquery) {
                        $subquery->where('role', config('constants.role.student'));
                    }
                ])->orderBy('users_count');
            }
        }

        if (isset($data['learn_time'])) {
            if ($data['learn_time'] == config('constants.options.desc')) {
                $query->withSum('lessons', 'learn_time')->orderByDesc('lessons_sum_learn_time');
            } else {
                $query->withSum('lessons', 'learn_time')->orderBy('lessons_sum_learn_time');
            }
        }

        if (isset($data['number_of_lesson'])) {
            if ($data['number_of_lesson'] == config('constants.options.desc')) {
                $query->withCount('lessons')->orderByDesc('lessons_count');
            } else {
                $query->withCount('lessons')->orderBy('lessons_count');
            }
        }

        if (isset($data['review'])) {
            if ($data['review'] == config('constants.options.desc')) {
                $query->withCount(['reviews' => function ($subquery) {
                    $subquery->where('lesson_id', null);
                }])->orderByDesc('reviews_count');
            } else {
                $query->withCount(['reviews' => function ($subquery) {
                    $subquery->where('lesson_id', null);
                }])->orderBy('reviews_count');
            }
        }

        return $query;
    }
}
