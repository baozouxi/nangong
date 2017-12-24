@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        用户列表
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
        <li><a href="#">用户列表</a></li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 列表
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
                                <th class="table-title">用户名</th>
                                <th class="table-title">账户余额</th>
                                <th class="table-type">提现金额</th>
                                <th class="table-type">提现银行</th>
                                <th class="table-type">提现姓名</th>
                                <th class="table-type">提现卡号</th>
                                <th class="table-author am-hide-sm-only">状态</th>
                                <th class="table-date am-hide-sm-only">请求日期</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($withdraws as $withdraw)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $withdraw->id }}</td>
                                    <td><a href="#">{{ $withdraw->user->username }}</a></td>
                                    <td>{{ $withdraw->user->capital->money  }}</td>
                                    <td class="am-hide-sm-only">{{ $withdraw->money }}</td>
                                    <td class="am-hide-sm-only">{{ $withdraw->card->bank->name }}</td>
                                    <td class="am-hide-sm-only">{{ $withdraw->user->bankName->name }}</td>
                                    <td class="am-hide-sm-only">{{ $withdraw->card->number }}</td>
                                    <td class="am-hide-sm-only">{{ $withdraw->ok ? '已处理' :  '待处理'}}</td>
                                    <td class="am-hide-sm-only">{{ $withdraw->created_at }}</td>
                                    <td>
                                        @if(!$withdraw->ok)
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button type="button"
                                                            class="am-btn am-btn-default am-btn-xs am-text-secondary update"
                                                            data-id="{{ $withdraw->id }}"><span
                                                                class="am-icon-pencil-square-o"></span> 已打款
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                      {!! $withdraws->links() !!}
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
    <script src="/assets/js/withdraw.js"></script>
@endpush
