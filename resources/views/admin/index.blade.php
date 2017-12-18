@extends('admin.layout')


@section('main')

    <div class="tpl-content-page-title">
        后台管理系统
    </div>
    <ol class="am-breadcrumb">
        <li><a href="#" class="am-icon-home">首页</a></li>
    </ol>
    <div class="tpl-content-scope">
        <div class="note note-info">
            <h3>您好，超级管理员
                <span class="close" data-close="note"></span>
            </h3>

        </div>
    </div>
@endsection


@push('scripts')
    <script src="/assets/js/echarts.min.js"></script>
    <script src="/assets/js/iscroll.js"></script>
@endpush