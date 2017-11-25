<?php

namespace App\Http\Controllers;

use App\Models\WechatDomain;
use App\Services\CaptchaService;
use App\Services\UserService;
use App\Services\WechatPageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WechatPageController extends Controller
{
    /**
     * 微信单页
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page($id){
        $wechatPage = (new WechatPageService())->getPage($id);
        if(!$wechatPage){
            throw  new NotFoundHttpException();
        }

        $data = [
            'pageInfo' => $wechatPage,
        ];

        $pageContent = view('wechat_page', $data);

        return view('wechat_page_wrap', ['content' => base64_encode($pageContent)]);
    }

    /**
     * 中转域名跳转
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect($id){
        $redirectDomain = config('domains.redirect_domain');
        $domains = WechatDomain::get();
        if($domains){
            $domains = $domains->pluck("domain")->toArray();
        }
        if($domains && !in_array($redirectDomain, $domains)){
            $domain = array_random($domains, 1)[0];
            $url = URL::action('WechatPageController@page', ['id' => $id], false);
            $redirectUrl = "http://".$domain.$url;
            return redirect($redirectUrl);
        }else{
            return $this->page($id);
        }
    }
}
