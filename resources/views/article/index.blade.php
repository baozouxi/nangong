@extends('layouts.app')
@push('css')

    <link href="/themes/simplebootx/Public/css/xtgg.css" rel="stylesheet" type="text/css"/>
@endpush


@section('main')

    <div class="banner_cz"
         style="background:url(/themes/simplebootx/Public/images/banner4.jpg) no-repeat center center">
        <div class="w1000"><a href="notice.html" class="czzx"><span class="tit">系统公告</span><span
                        class="en">NEWS CENTER</span></a></div>
    </div>
    <div class="main mt20">
        <div class="w1000">
            <div class="xtgg-stb">
                <div class="slideTxtBox">
                    <div class="hd">
                        <ul>
                            <li class="on" onclick="location.href='/portal/index/notice.html?cid=31'">最新公告</li>
                        </ul>
                    </div>
                    <div class="bd clearfix">
                        <ul class="newslist clearfix">

                            @foreach($articles as $article)
                                <li><a href="{{ route('articles.show', ['id' =>$article->id]) }}"
                                       target="_blank">{{ $article->title }}</a><span>{{  $article->created_at }}</span></li>
                            @endforeach

                        </ul>
                    </div>
                    {{--   <div class="page"><span class="current">1</span> <a
                                   href="http://ng077.com/portal/index/notice/p/2.html"> 2</a> <a
                                   href="http://ng077.com/portal/index/notice/p/3.html"> 3</a> <a
                                   href="http://ng077.com/portal/index/notice/p/4.html"> 4</a> <a
                                   href="http://ng077.com/portal/index/notice/p/5.html"> 5</a> <a
                                   href="http://ng077.com/portal/index/notice/p/2.html">下一页</a> <a
                                   href="http://ng077.com/portal/index/notice/p/5.html">尾页</a></div>--}}
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>

@endsection
