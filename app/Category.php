<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    protected static function boot()
    {
        parent::boot();

        // global scope 
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', Auth::user()->id);
        });

        // model event - before create
        static::creating(function($category) {
            $category->user_id = Auth::user()->id;
        });

        // model event - before delete
        static::deleting(function($category) {

            // Check if Uncategorised exists
            if ($uncategorised = Category::where('title', 'Uncategorised')->first())
            {
                // Set products to uncategorised
                $category->products()->update(
                    ['category_id' => $uncategorised->id]
                ); 

            } else {

                // Create Uncategorised category
                $uncategorised = Category::create(
                    ['title' => 'Uncategorised']
                );

                // Set products to uncategorised
                $category->products()->update(
                    ['category_id' => $uncategorised->id]
                ); 
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'sort_order'
    ];

    /**
     * Set the category title.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    /**
     * Category/products relationship.
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
