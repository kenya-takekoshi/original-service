<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Item;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        $count_favorite = $user->favorite_items()->count();
        $items = \DB::table('items')->join('item_user', 'items.id', '=', 'item_user.item_id')->select('items.*')->where('item_user.user_id', $user->id)->distinct()->paginate(20);

        return view('users.show', [
            'user' => $user,
            'items' => $items,
            'count_favorite' => $count_favorite,
        ]);
    }
}
