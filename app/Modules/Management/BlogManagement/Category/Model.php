<?php

namespace App\Modules\BlogManagement\Category;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    static $model = \App\Modules\BlogManagement\Category\Model::class;

    protected $table = "categories";
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . " " . $random_no;
            $data->slug = Str::slug($slug);
            $data->save();
        });
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function child_cateogories()
    {
        return $this->hasMany(self::$model, 'parent_id')->with('child_cateogories');
    }
}
