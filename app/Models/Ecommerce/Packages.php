<?php

namespace App\Models\Ecommerce;

use App\Contracts\BuilderContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Packages extends Model
{
    use HasFactory;
    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'goal_id',
        'board_id',
        'class_id',
        'thumbnail_id',
        'title',
        'code',
        'slug',
        'description',
        'code',
        'description',
        'valid_from',
        'valid_to',
        'enrollment_start_date',
        'enrollment_end_date',
        'is_trial_available',
        'is_paid',
        'package_type',
        'validity_type',
        'valid_for',
        'is_published',
        'is_external_course',
        'instructions',
        'old_id',
        'mdl_package',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('slug')) {
                $slug = Str::slug($model->title);
                $count = self::where('slug', $slug)->count();
                if ($count > 0) {
                    $slug .= '-'.($count + 1);
                }
                $model->slug = $slug;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('ecommerce');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Ecommerce\Packages';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function payment_types()
    {
        return [
            'Free',
            'Paid',
        ];
    }

    public function package_types()
    {
        return [
            'course',
            'test',
        ];
    }

    public function getPackageTypeNameAttribute()
    {
        $types = $this->package_types();

        return isset($types[$this->attributes['package_type']]) ? $types[$this->attributes['package_type']] : '';
    }

    public function getPaymentTypeNameAttribute()
    {
        return $this->attributes['is_paid'] ? 'Paid' : 'Free';
    }

    public function setValidForAttribute($value)
    {
        if ($this->attributes['validity_type'] == 'date') {
            $this->attributes['valid_for'] = strtotime($value);
        } else {
            $this->attributes['valid_for'] = $value;
        }
    }

    public function getValidForAttribute()
    {
        if ($this->attributes['validity_type'] == 'date') {
            return date('d M Y', $this->attributes['valid_for']);
        } else {
            return $this->attributes['valid_for'];
        }
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Ecommerce\PackageHasCourses', 'package_id', 'id');
    }

    public function goal()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'goal_id', 'id');
    }

    public function board()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'board_id', 'id');
    }

    public function classes()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'class_id', 'id');
    }

    public function batches()
    {
        return $this->hasMany('App\Models\Ecommerce\Batches', 'package_id', 'id');
    }

    public function pages()
    {
        return $this->hasOne('App\Models\Website\PageBuilder\Page', 'package_id', 'id');
    }

    public function activeBatches()
    {
        $today = Carbon::now();
        $batches = $this->batches()
                    ->whereDate('enrollment_start_date', '<=', $today)
                    ->whereDate('enrollment_end_date', '>=', $today)
                    ->withCount('enrollments')
                    ->having('enrollments_count', '<', \DB::raw('batches.student_limit'))
                    ->orderBy('enrollment_start_date', 'asc')
                    ->where('is_active', 1)->get();

        return $batches;
    }

    public function pricing()
    {
        return $this->hasMany('App\Models\Ecommerce\PackagePricing', 'package_id', 'id');
    }

    public function thumbnail()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'thumbnail_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Models\Content\Enrollment', 'package_id', 'id')->where('status', '!=', 0);
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Ecommerce\Order', 'package_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Modules\PackageRating', 'package_id', 'id');
    }

    public function average_rating()
    {
        return $this->ratings()->avg('rating');
    }

    public function hasPurchased()
    {
        $user = auth()->user() ? auth()->user()->id : 0;
        if ($user) {
            $hasorder = $this->enrollments()->subscribed()->where('user_id', $user)->first();

            return $hasorder ? true : false;
        }

        return false;
    }

    public function hasRated()
    {
        $user = auth()->user() ? auth()->user()->id : 0;
        if ($user) {
            $userrating = $this->ratings()->where('user_id', $user)->first();

            return $userrating ? true : false;
        }

        return false;
    }

    public function hasTrialSubscription()
    {
        $user = auth()->user() ? auth()->user()->id : 0;
        if ($user) {
            $hastrial = $this->enrollments()->trail()->where('user_id', $user)->first();

            return $hastrial ? true : false;
        }

        return false;
    }

    public function isAcceptingEnrolments()
    {
        $enrolmentstart = Carbon::parse($this->attributes['enrollment_start_date']);
        $enrolmentend = Carbon::parse($this->attributes['enrollment_end_date']);
        $today = Carbon::today();

        return $today->between($enrolmentstart, $enrolmentend) ? true : false;
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', 1);
    }
}
