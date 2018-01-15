@extends('admin.layout')

@section('main')

    <div class="tpl-content-page-title">
        代理信息
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span>
                代理信息
            </div>


        </div>
        <div class="tpl-block ">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    <form class="am-form am-form-horizontal" action="{{ route('admin.agentsUpdate', ['agent'=>$agent->id]) }}" method="post">

                        {!! csrf_field() !!}
                        {!! method_field('PUT') !!}
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">返点(%)：</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="point" required placeholder="返点数（%）" value="{{ $agent->point }}" name="point">
                                {{--<small>输入参数...</small>--}}
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">备注内容</label>
                            <div class="am-u-sm-9">
                                <textarea class="" rows="5" required="" id="tips" placeholder="备注内容..." name="tips">{{ $agent->tips }}</textarea>
                            </div>
                        </div>


                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">修改代理信息</button>
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
