@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        用户列表
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
        <li><a href="#">Amaze UI CSS</a></li>
        <li class="am-active">文字列表</li>
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
            <div class="am-g">
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


            </div>
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
                                    <td><a href="#">{{ $user->username }}</a></td>
                                    <td>{{ $user->capital->money }}</td>
                                    <td>{{ $user->bankName->name }}</td>
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
                                    <td class="am-hide-sm-only">{{  $user->enable ? '正常' : '冻结' }}</td>
                                    <td class="am-hide-sm-only">{{ $user->login->isNotEmpty() ? $user->login->first()->login_time : '' }}</td>
                                    <td class="am-hide-sm-only">{{ $user->created_at }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button class="am-btn am-btn-default am-btn-xs am-text-secondary recharge" data-id="{{ $user->id }}"><span
                                                            class="am-icon-pencil-square-o"></span> 充值
                                                </button>
                                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" data-id="{{ $user->id }}">
                                                    <span class="am-icon-trash-o"></span> 冻结
                                                </button>
                                            </div>
                                        </div>
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


@endsection

@push('scripts')
    <script src="/assets/js/user.js"></script>
@endpush
