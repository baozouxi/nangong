@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        投注记录
    </div>
    <ol class="am-breadcrumb">
        <li><a href="{{ route('admin.index') }}" class="am-icon-home">首页</a></li>
        <li><a href="#">投注记录</a></li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 列表
            </div>



        </div>
        <div class="tpl-block">
            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="table-title">用户名</th>
                                <th class="table-title">期号</th>
                                <th class="table-title">投注号码</th>
                                <th class="table-title">总投注金额</th>
                                <th class="table-title">赔付金额</th>
                                <th class="table-title">投注时间</th>
                                <th class="table-title">游戏名称</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bets as  $bet)
                                <tr>
                                    <td class="table-title">{{ $bet->user->username }}</td>
                                    <td class="table-title">{{ $bet->actionNo }}</td>
                                    <td class="table-title">{{ $bet->code }}</td>
                                    <td class="table-title">{{ $bet->money }}</td>
                                    <td class="table-title">{{ $bet->profit }}</td>
                                    <td class="table-title">{{ $bet->created_at }}</td>
                                    <td class="table-title">{{ $bet->game->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! $bets->links() !!}
                        <hr>

                    </form>
                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>




@endsection

