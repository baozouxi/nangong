@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        后台管理系统
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 红包广告
            </div>


        </div>
        <div class="tpl-block ">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    <form class="am-form am-form-horizontal" action="{{ route('admin.updateAd', ['ad'=>$ad->id]) }}" method="post">

                        {!! csrf_field() !!}
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">广告内容</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="body" required placeholder="广告内容" value="{{ $ad->body }}" name="body">
                                {{--<small>输入参数...</small>--}}
                            </div>
                        </div>


                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">修改广告</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/capital_log.js"></script>
@endpush
