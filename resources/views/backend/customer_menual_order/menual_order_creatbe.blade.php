@extends('backend.layouts.master')
@section('title')
    <title>Shipment Page</title>
@endsection
@section('style')
    <style>
        /*setTimeout(function () {*/
        /*    $('#back-to-home').hide()*/
        /*},500)*/

        #back-to-home {
            display: none;
        }

    </style>
@endsection

@section('content')
    @include('backend.flash_message.flash_message')
    <div id="m_order_message"></div>
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-1">
            <div class="col-md-5 col-sm-5 mb-0 text-left">
                <div class="btn-group jcs_grp">
                    <button type="button" class="btn btn-success">オンライン受注•確定</button>
                    <button type="button" class="btn btn-default deflt_design_adjust">
                        <input type="tel" style="ime-mode: disabled;float:left;border:1px solid #ddd;"
                               class="form-control jan_inpts jan_inpts_online_order" placeholder="ＪＡＮまたはインストア入力">
                    </button>

                    <button type="button" class="btn btn-info"><a class="page_manage custom_online_order"
                                                                  style="color:#fff" href="#">手書</a>
                        <!--                        onlineorder-->
                    </button>

                </div>
                <p class="hmdate">納品日　<?php echo date("m", time());?>月<?php echo date("d", time());?>日</p>

            </div>
            <div class="col-md-7 col-sm-7 mb-0 text-right">
                <input type="hidden" value="0" class="c_ids_v">
                <input type="hidden" value="0" class="customer_manual_order_status">
                <div class="top_btn_list">
                    <ul class="top_page_btn_list_jacos list-inline">
                        <li><a href="#" delete_st="0" class="btn btn-danger btn-lg delete_entry">行削除</a></li>
                        <li><a href="home" class="btn btn-danger btn-lg">業務選択</a></li>
                        <li><a href="shipment" class="btn btn-warning btn-lg">履歴</a></li>
                        <li><a href="{{ route('manualOrder') }}" class="btn btn-info btn-lg">手書</a></li>
                        <li>
                            <button class="btn btn-warning manual_order_exe btn-lg">完了</button>
                        </li>
                        <li>
                            <button class="btn customer_list_show_popup btn-warning btn-lg">販売先一覧</button>
                        </li>
                        <li><a href="#" id="left" class="btn btn-info btn-lg scroll_to_right">左へ移動</a></li>
                        <li><a href="#" id="right" class="btn btn-primary btn-lg scroll_to_left mt-1">右へ移動</a></li>
                        <li><a href="javascript:history.back();" class="btn btn-info btn-lg pull-right mt-1 ">戻る</a>
                        </li>
                    </ul>


                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Small Stats Blocks -->

        <handy-product-order-kouri base_url="{{config('app.url')}}"></handy-product-order-kouri>


    </div>

@endsection
