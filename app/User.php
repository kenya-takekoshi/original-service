<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('type')->withTimestamps();
    }

    public function favorite_items()
    {
        return $this->items()->where('type', 'favorite');
    }

    public function favorite($itemId)
    {
        // 既に Favorite しているかの確認
        $exist = $this->is_favoriting($itemId);

        if ($exist) {
            // 既に Favorite していれば何もしない
            return false;
        } else {
            // 未 Favorite であれば Favorite する
            $this->items()->attach($itemId, ['type' => 'favorite']);
            return true;
        }
    }

    public function unfavorite($itemId)
    {
        // 既に Favorite しているかの確認
        $exist = $this->is_favoriting($itemId);

        if ($exist) {
            // 既に Favorite していれば Favorite を外す
            \DB::delete("DELETE FROM item_user WHERE user_id = ? AND item_id = ? AND type = 'favorite'", [\Auth::user()->id, $itemId]);
        } else {
            // 未 Favorite であれば何もしない
            return false;
        }
    }

    public function is_favoriting($itemIdOrCode)
    {
        if (is_numeric($itemIdOrCode)) {
            $item_id_exists = $this->favorite_items()->where('item_id', $itemIdOrCode)->exists();
            return $item_id_exists;
        } else {
            $item_code_exists = $this->favorite_items()->where('code', $itemIdOrCode)->exists();
            return $item_code_exists;
        }
    }
}