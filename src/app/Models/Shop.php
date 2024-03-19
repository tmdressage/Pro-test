<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'shop_img',
        'shop_area',
        'shop_genre',
        'shop_text'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'owner_shop_id');
    }

    public function already_favorite()
    {
        $id = Auth::id();
        $favoriteShops = array();
        foreach ($this->favorites as $favorite) {
            array_push($favoriteShops, $favorite->user_id);
        }

        if (in_array($id, $favoriteShops)) {
            return true;
        } else {
            return false;
        }
    }
}
