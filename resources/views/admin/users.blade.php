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
                                <th class="table-type">余额</th>
                                <th class="table-type">银行用户名</th>
                                <th class="table-type">银行卡号</th>
                                <th class="table-author am-hide-sm-only">状态</th>
                                <th class="table-date am-hide-sm-only">上次登录日期</th>
                                <th class="table-date am-hide-sm-only">注册日期</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($users as $user)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $user->id }}</td>
                                    <td class="username"><a href="#">{{ $user->username }}</a></td>
                                    <td class="money">{{ number_format($user->capital->money, 2)  }}</td>
                                    <td>{{ $user->bankName ? $user->bankName->name :  '暂未添加' }}</td>
                                    <td>
                                        <div class="am-dropdown" data-am-dropdown>
                                            <button class="am-btn am-btn-primary am-dropdown-toggle"
                                                    style="color: #000;" data-am-dropdown-toggle>银行账户列表 <span
                                                        class="am-icon-caret-down"></span></button>
                                            <ul class="am-dropdown-content">
                                                @foreach($user->cards as $card)
                                                    <li class="am-disabled">{{ $card->bank->name }}
                                                        ：{{ $card->number }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="am-hide-sm-only enable">{{  $user->enable ? '正常' : '冻结' }}</td>
                                    <td class="am-hide-sm-only">{{ $user->login->isNotEmpty() ? $user->login->first()->login_time : '' }}</td>
                                    <td class="am-hide-sm-only">{{ $user->created_at }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"
                                                        class="am-btn am-btn-default am-btn-xs am-text-secondary recharge"
                                                        data-id="{{ $user->id }}"><span
                                                            class="am-icon-pencil-square-o"></span> 充值
                                                </button>
                                                <button type="button" data-id="{{ $user->id }}" class="am-btn am-btn-default am-btn-xs am-text-secondary change-money"><span class="am-icon-pencil-square-o"></span>编辑余额</button>

                                                @if($user->enable)

                                                    <button type="button"
                                                            class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only frozen"
                                                            data-id="{{ $user->id }}">
                                                        <span class="am-icon-trash-o"></span> 冻结
                                                    </button>

                                                @else
                                                    <button type="button"
                                                            class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only reFrezen"
                                                            data-id="{{ $user->id }}">
                                                        <span class="am-icon-trash-o"></span> 解冻
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>



                        {!! $users->links()  !!}


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



    <div class="am-modal am-modal-prompt" tabindex="-1" id="changeMoney">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">账户余额修改</div>
            <div class="am-modal-bd">
                您正在修改：<span class="username" style="color: red;"></span> 的账户余额
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
    <script src="/assets/js/user.js"></script>
@endpush
