@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        添加收款账户
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 收款账户
            </div>



        </div>
        <div class="tpl-block ">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    <form class="am-form am-form-horizontal" action="{{ route('admin.accountSubmit') }}" method="post">

                        {!! csrf_field() !!}
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">收款账户姓名：</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="title" required placeholder="收款账户姓名" name="name">
                                {{--<small>输入参数...</small>--}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">收款号码：</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="title" required placeholder="收款号码" name="number">
                                {{--<small>输入参数...</small>--}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">收款地址：</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="title" required placeholder="收款地址(银行)" name="way">
                                {{--<small>输入参数...</small>--}}
                            </div>
                        </div>



                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">备注</label>
                            <div class="am-u-sm-9">
                                <textarea class="" rows="5"  id="user-intro" placeholder="备注..." name="tips"></textarea>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">新增账户</button>
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
