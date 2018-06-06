<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Item;

class ItemUserController extends Controller
{
    public function favorite()
    {
        $itemCode = request()->itemCode;

        // itemCode から商品を検索
        $client = new \RakutenRws_Client();
        $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
        $rws_response = $client->execute('IchibaItemSearch', [
            'itemCode' => $itemCode,
        ]);
        $rws_item = $rws_response->getData()['Items'][0]['Item'];

        // Item 保存 or 検索（見つかると作成せずにそのインスタンスを取得する）
        $item = Item::firstOrCreate([
            'code' => $rws_item['itemCode'],
            'name' => $rws_item['itemName'],
            'url' => $rws_item['itemUrl'],
            // 画像の URL の最後に ?_ex=128x128 とついてサイズが決められてしまうので取り除く
            'image_url' => str_replace('?_ex=128x128', '', $rws_item['mediumImageUrls'][0]['imageUrl']),
        ]);

        \Auth::user()->favorite($item->id);

        return redirect()->back();
    }

    public function unfavorite()
    {
        $itemCode = request()->itemCode;

        if (\Auth::user()->is_favoriting($itemCode)) {
            $itemId = Item::where('code', $itemCode)->first()->id;
            \Auth::user()->unfavorite($itemId);
        }
        return redirect()->back();
    }
}