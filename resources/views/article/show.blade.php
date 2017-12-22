@extends('layouts.app')

@push('css')
    <link href="/themes/simplebootx/Public/css/xtgg.css" rel="stylesheet" type="text/css"/>
@endpush


@section('main')

    <div class="banner_cz"
         style="background:url(/themes/simplebootx/Public/images/banner4.jpg) no-repeat center center">
        <div class="w1000"><a href="93.html" class="czzx"><span class="tit">系统公告</span><span
                        class="en">NEWS CENTER</span></a></div>
    </div>
    <div class="main mt20">
        <div class="w1000">
            <div class="arcnr">
                <div class="arctitle"> {{ $article->title }}</div>
                <div class="arctips"> ({{ $article->created_at }} 来源: 原创 )</div>
                <div class="arcline"></div>
                <p style="text-align: center; font-weight: bold;font-size: 18px; padding: 20px;">
                    {{ $article->body }}

                </p>
                <div class="arcline"></div>

            </div>
        </div>
    </div>


@endsection
