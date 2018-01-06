@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        代理列表
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
        <li><a href="#">代理列表</a></li>
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

                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-title">用户名</th>
                            <th class="table-title">推广人数</th>
                            <th class="table-title">返现点数</th>
                            <th class="table-title">已返现金额</th>
                            <th class="table-title">备注</th>
                            <th class="table-title">添加时间</th>
                            {{--<th class="table-set">操作</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($agents as $agent)
                            <tr>
                                <td class="table-title username">{{ $agent->user->username }}</td>
                                <td class="table-title">{{ $agent->followers_count }}</td>
                                <td class="table-title">{{ $agent->point }}%</td>
                                <td class="table-title">{{ $agent->money }}</td>
                                <td class="table-title">{{ $agent->tips }}</td>
                                <td class="table-title">{{ $agent->created_at }}</td>
                            {{--    <td class="table-set">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <button type="button" data-id="{{ $agent->id }}"
                                                    class="am-btn am-btn-default am-btn-xs am-text-secondary change-point">
                                                <span class="am-icon-pencil-square-o"></span>编辑提现点数
                                            </button>
                                            <button type="button" data-id="{{ $agent->id }}"
                                                    class="am-btn am-btn-default am-btn-xs am-text-danger kefu-delete am-hide-sm-only">
                                                <span class="am-icon-trash-o"></span> 停用
                                            </button>
                                        </div>
                                    </div>
                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <hr>

                </form>
            </div>

        </div>
    </div>
    <div class="tpl-alert"></div>
    </div>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="changePoint">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">修改代理提成点数</div>
            <div class="am-modal-bd">
                您正在修改：<span class="username" style="color: red;"></span> 的代理提成点数(%)
                <input type="number" name="point" class="am-modal-prompt-input">
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>




@endsection

@push('scripts')
    <script>
        $(function () {
            $('.change-point').click(function () {
                var agent_id = 0;
                var _this = $(this);
                var username = $(this).parents('td').siblings('.username').text();
                agent_id = $(this).attr('data-id');
                var money_obj = $(this).parents('td').siblings('.money');
                $('#changePoint span.username').text(username);
                $('#changePoint').modal({
                    relatedTarget: this,
                    onConfirm: function (e) {
                        // agent(agent_id, e.data, _this);
                    },
                });
            });

        });
    </script>


@endpush
