@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        浮动客服
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 浮动客服
            </div>


        </div>
        <div class="tpl-block ">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    <form class="am-form am-form-horizontal" action="{{ route('admin.kefuUpdate', ['kefu'=>$kefu->id]) }}" method="post">

                        {!! csrf_field() !!}
                        {!! method_field('PUT') !!}
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">联系方式：</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="way" required placeholder="联系方式（qq号" value="{{ $kefu->way }}" name="way">
                                {{--<small>输入参数...</small>--}}
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">联系方式：</label>
                            <div class="am-u-sm-9">
                                <select id="doc-select-1" name="type">
                                    <option value="1" {{ $kefu->type == '1' ? 'selected' : '' }}>客服</option>
                                    <option value="2" {{ $kefu->type == '2' ? 'selected' : '' }}>qq群</option>
                                </select>
                                {{--<small>输入参数...</small>--}}
                            </div>
                        </div>


                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">修改浮动客服</button>
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
