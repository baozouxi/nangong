@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        用户列表
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
        <li><a href="#">财务记录</a></li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 列表
            </div>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-small input-inline">
                    <div class="input-icon right">
                        <i class="am-icon-search"></i>
                        <input type="text" class="form-control form-control-solid" placeholder="搜索..."></div>
                </div>
            </div>


        </div>
        <div class="tpl-block">
            {{--            <div class="am-g">
                            <div class="am-u-sm-12 am-u-md-6">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                    class="am-icon-plus"></span> 新增
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span
                                                    class="am-icon-save"></span> 保存
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span
                                                    class="am-icon-archive"></span> 审核
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span
                                                    class="am-icon-trash-o"></span> 删除
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>--}}
            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="table-check"><input type="checkbox" class="tpl-table-fz-check"></th>
                                <th class="table-id">ID</th>
                                <th class="table-title">类别</th>
                                <th class="table-type">操作金额</th>
                                <th class="table-type">用户名</th>
                                <th class="table-type">状态</th>
                                <th class="table-date am-hide-sm-only">操作日期</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($capitalLogs as $capitalLog)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $capitalLog->id }}</td>
                                    <td>
                                        <a href="#">{{ $capitalLog->type == \App\CapitalLog::RECHARGE ? '充值' : '提现' }}</a>
                                    </td>
                                    <td>{{ number_format($capitalLog->money, 2)  }}</td>
                                    <td class="am-hide-sm-only">{{ $capitalLog->user->username }}</td>
                                    <td class="am-hide-sm-only">{{ $capitalLog->ok ? '已到账' : '未处理' }}</td>
                                    <td class="am-hide-sm-only">{{ $capitalLog->created_at }}</td>
                                    <td>
                                        @if($capitalLog->type != \App\CapitalLog::WITHDRAW)
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button type="button"
                                                            class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only order-cancel"
                                                            data-id="{{ $capitalLog->id }}"><span
                                                                class="am-icon-trash-o"></span>撤销
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <div class="am-cf">

                            <div class="am-fr">
                                <ul class="am-pagination tpl-pagination">
                                    <li class="am-disabled"><a href="#">«</a></li>
                                    <li class="am-active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>

                    </form>
                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="recharge">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">账户余额充值</div>
            <div class="am-modal-bd">
                您正在给用户名为：<span class="username" style="color: red;"></span> 的账户充值
                <input type="number" name="money" class="am-modal-prompt-input">
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="/assets/js/capital_log.js"></script>
@endpush
