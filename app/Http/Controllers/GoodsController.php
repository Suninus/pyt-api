<?php

namespace App\Http\Controllers;

use App\Models\ChannelColumn;
use App\Models\Goods;
use App\Services\ChannelColumnService;
use App\Services\GoodsService;
use Illuminate\Database\Schema\Grammars\ChangeColumn;
use Illuminate\Http\Request;


/**
 * 商品列表
 * Class GoodsController
 * @package App\Http\Controllers
 */
class GoodsController extends Controller
{
    /**
     * 获取商品列表
     */
    public function goodList(Request $request){
        //商品分类
        $category = $request->get('category');
        //商品排序
        $sort = $request->get('sort');
        //搜索关键字
        $keyword = $request->get('keyword');


        $list = (new GoodsService())->goodList($category, $sort, $keyword);
        return $this->ajaxSuccess($list);
    }

    /**
     * 商品详情
     * @param $goodId
     * @return static
     */
    public function detail($goodId){
        $data = (new GoodsService())->detail($goodId);
        if(!$data){
            return $this->ajaxError("商品不存在", 404);
        }

        return $this->ajaxSuccess($data);
    }

    /**
     * 获取栏目商品列表
     * @param $columnCode 栏目代码
     * @return static
     */
    public function columnGoods($columnCode){
        if(!(new ChannelColumnService())->getByCode($columnCode)){
            return $this->ajaxError("栏目不存在");
        }

        $list = (new GoodsService())->columnGoodList($columnCode);
        return $this->ajaxSuccess($list);
    }

    /**
     * 热搜词列表
     * @return static
     */
    public function hotKeyWord(){
        $data = ['耳机', '面膜', '口红', '保温杯', '卫衣', '毛衣女', '睡衣', '女鞋', '洗面奶', '充电宝'];
        return $this->ajaxSuccess($data);
    }

}
