<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ShoppingList extends Model
{
    protected static function boot()
    {
        parent::boot();

        // global scope 
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', Auth::user()->id);
        });

        // model event
        static::creating(function($shoppingList) {
            $shoppingList->user_id = Auth::user()->id;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description'
    ];

    /**
     * Shopping list/product relationship.
     */
    public function products($order = 'title')
    {
        return $this->belongsToMany('App\Product')->orderBy($order)
            ->withPivot('note')
            ->withTimestamps();
    }
}
