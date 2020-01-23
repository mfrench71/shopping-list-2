<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected static function boot()
    {
        parent::boot();

        // global scope 
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', Auth::user()->id);
        });

        // model event
        static::creating(function($product) {
            $product->user_id = Auth::user()->id;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'title', 'essential'
    ];

    /**
     * Set the product title.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    /**
     * Scope a query to only include essential products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEssential($query)
    {
        return $query->where('essential', 1);
    }

    /**
     * Scope a query to only include available products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query, $shoppingList)
    {
        return $query->whereDoesntHave('shoppingLists', function($subQuery) use($shoppingList) {
            $subQuery->where('id', $shoppingList->id);
        })->orderBy('title')->get();
    }

    /**
     * Product/shopping list relationship.
     */
    public function shoppingLists()
    {
        return $this->belongsToMany('App\ShoppingList')
            ->withPivot('note')
            ->withTimestamps();
    }

    /**
     * Category/products relationship.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
}
