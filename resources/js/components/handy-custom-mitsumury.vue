<template>
    <section>
        <div class="main-content-container container-fluid px-4" @dblclick="handiNaviShow()" style="min-height: 100vh">
            <!-- Small Stats Blocks -->
            <!--            voice input    -->
            <vue-speech lang="ja-JP" :resume="speech_start" style="display: none" @onTranscriptionEnd="getText"/>
            <!--            voice input  end   -->


            <div class="row">
                <div class="well" style="border: 3px solid #428bca;">
                    <div class="header col-md-12 col-xs-12" style="font-size: 18px; padding: 10px;">
                        <span class="pull-left">見積追加ページ</span>
                        <!-- <button id="handy_shipment_item_insert" class="btn btn-primary pull-right" style="float:right"> 送信</button>&nbsp;-->
                        <a :href="base_url+'/android_home'" class="btn btn-primary pull-right top-button"
                           style="float:right">メニュー</a>
                        <a :href="base_url+'/custom-mitsumury-orders'"
                           class="btn btn-success pull-right top-button mr-2"
                           style="float:right">履歴</a>
                        <!--                        <a href="javascript:void(0)" class="btn btn-success pull-right mr-1 top-button"-->
                        <!--                           style="float:right"> 発注</a>-->
                        <!--                        <a href="javascript:void(0)" class="btn btn-success pull-right mr-1 top-button"-->
                        <!--                           style="float:right"> 採用</a>-->
                        <!--                        <a href="javascript:void(0)" class="btn btn-success pull-right mr-1 top-button"-->
                        <!--                           style="float:right"> 詳細</a>-->

                    </div>
                    <div style="font-size: 18px; padding: 5px 0px 2px 5px;position: relative">

                        <img id="preview">

                        <div class="form-check">
                            <input class="form-check-input check-all hide" @click="selectAll()" v-model="allSelected"
                                   type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label ml-2" for="flexCheckChecked">
                                <button class="btn btn-success" onclick="$('#flexCheckChecked').click()"
                                        style="font-size: 18px;">全て
                                </button>
                            </label>
                        </div>

                        <!--                        <button v-if="productJans.length > 0" @click="selectSuper(' ')"-->
                        <!--                                class="btn btn-success pull-right mr-1 " id="show-super-list"-->
                        <!--                                style="position: absolute; top: 5px; right: 0px;padding: 5px 10px; font-size: 18px;">-->
                        <!--                            メール-->
                        <!--                        </button>-->
<!--                        <a class="btn btn-danger float-right mr-" v-if="productJans.length > 0"-->
<!--                           @click="deleteMistunury(null)"-->
<!--                           style=" position: absolute; top: 5px; right:0px;padding: 5px 10px; font-size: 18px;"-->
<!--                        > 削除</a>-->


                        <div class=" col-centereds col-md-12 col-sm-12 col-sl-12 p-0 row mt-2">
                            <div class="col-sm-6 col-md-3 col-xl-3 image-div" v-for="(product,i) in products"
                                 :class="(productJans.indexOf(product)) > -1 ? 'active-img' : ''">
                                <img :src="product.image" :id="'img'+i"
                                     class="img-thumbnail custom-img"
                                     alt="Cinque Terre" @click="viewInfoForImage(product,product.img)"
                                     @dblclick="viewInfoForImage(product,product.img,1)"
                                     style="cursor: pointer">
                                <input class="form-check-input form-check-input_" type="checkbox"
                                       :id="'check_by_'+product.jan" v-model="productJans"
                                       :value="product">
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true" id="mistumury-mage-preview">
                <div class="modal-dialog modal-lg mt-0">
                    <div class="modal-content">
                        <div class="modal-header" style="padding: 5px;justify-content: right">
                            <a class="btn btn-danger float-right mr-1" @click="deleteMistunury(preview_product)">削除</a>
                            <!--                            <a class="btn btn-success float-right mr-1" @click="naviShow()"> 保存</a>-->
                            <!--                        <a class="btn btn-success float-right mr-2">発注</a>-->
                            <!--                            <a class="btn btn-info float-right" @click="confirmAndHide('mistumury-mage-preview')">戻る</a>-->

                        </div>
                        <div class="modal-body p-0" style="text-align: center">
                            <div
                                style="font-size: 18px;text-align: left;padding: 5px 10px;background: #c3ff8f80;font-weight: bold;">

                                <input class="form-control" type="text" v-model="preview_product.item_name"
                                       @keyup="saveItemName($event)">
                            </div>
                            <div>
                                <img
                                    :src="''+preview_product.image"
                                    class="img-thumbnail custom-img-preview" alt="Cinque Terre"
                                    style="cursor: pointer">
                            </div>
<!--                            <div>-->
<!--                                <table data-v-c9953dda="" class="table table-bordered physical_handy_tabls">-->
<!--                                    <thead data-v-c9953dda="">-->
<!--                                    <tr data-v-c9953dda="">-->
<!--                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">-->
<!--                                            原価-->
<!--                                        </th>-->
<!--                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">-->
<!--                                            売価-->
<!--                                        </th>-->
<!--                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">-->
<!--                                            粗利-->
<!--                                        </th>-->
<!--                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">-->
<!--                                            ％-->
<!--                                        </th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody data-v-c9953dda="" class="physicaltbody">-->
<!--                                    <tr data-v-c9953dda="">-->

<!--                                        <td data-v-c9953dda="">-->
<!--                                            <input data-v-c9953dda="" type="tel" id="cost"-->
<!--                                                   @click="selectItem($event,'cost')"-->
<!--                                                   class="form-control  " v-model="preview_product.cost"-->
<!--                                                   @keyup="calculatePrice('cost')"-->
<!--                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;"-->
<!--                                                   @blur="blurAndSave()"-->
<!--                                                   @keypress="pressEnterAndSave($event,'sell')">-->
<!--                                        </td>-->
<!--                                        <td data-v-c9953dda="">-->
<!--                                            <input data-v-c9953dda="" type="tel" id="sell"-->
<!--                                                   @click="selectItem($event,'sell')"-->
<!--                                                   class="form-control  " v-model="preview_product.sell"-->
<!--                                                   @keyup="calculatePrice('sell')"-->
<!--                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;"-->
<!--                                                   @keypress="pressEnterAndSave($event,'profit_margin')"-->
<!--                                                   @blur="blurAndSave()">-->
<!--                                        </td>-->
<!--                                        <td data-v-c9953dda="">-->
<!--                                            <input data-v-c9953dda="" type="tel" id="profit"-->
<!--                                                   @click="selectItem($event,'profit')"-->
<!--                                                   class="form-control  "-->
<!--                                                   :value="preview_product.sell - preview_product.cost" readonly-->
<!--                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;">-->
<!--                                            &lt;!&ndash;                                        v-model="preview_product.profit"&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                               @keypress="pressEnterAndSave($event,'profit_margin')"&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                                @keyup="calculatePrice('profit')"&ndash;&gt;-->
<!--                                        </td>-->
<!--                                        <td data-v-c9953dda="">-->
<!--                                            <input data-v-c9953dda="" type="tel" id="profit_margin"-->
<!--                                                   @click="selectItem($event,'profit_margin')"-->
<!--                                                   class="form-control  " v-model="preview_product.gross_profit_margin"-->
<!--                                                   @keyup="calculatePrice('profit_margin')"-->
<!--                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;"-->
<!--                                                   @blur="blurAndSave()"-->
<!--                                                   @keypress="pressEnterAndSave($event,'cost')">-->

<!--                                        </td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
                            <div class="detail-pro">
                                {{ preview_product.jan }}
                            </div>
                            <div class="detail-pro">
                                {{ preview_product.created_at }}
                            </div>
                            <div class="mb-4" style="margin-bottom: 80px !important;">
                                <table data-v-c9953dda="" class="table table-bordered physical_handy_tabls " style="margin-top: 30px;margin-bottom: 50px">
                                    <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: left;border-right: none !important;">
                                            <input class="form-check-input check-all m-0" @click="selectAllSuper()"
                                                   v-model="allSelectedSuper" type="checkbox" value="">
                                            <label class="form-check-label " style="margin-left: 40px"
                                                   for="flexCheckChecked">
                                                全て
                                            </label>
                                        </th>
                                    </tr>
                                    </thead>
                                    <thead>
                                    <tr>

                                        <th >
                                            スーパー名
                                        </th>
                                        <th>
                                            ランク
                                            設定
                                        </th>
                                        <th >
                                            %
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody data-v-c9953dda="" class="physicaltbody">

                                    <!--                                <tr :class="(selectedSuper.indexOf(vendor.id) > -1) ? 'active-c' : ''"-->
                                    <!--                                    v-for="vendor in vendors" style="border-bottom: 1px solid gray">-->
                                    <!--                                    <td style="width: 50px;padding: 10px;border: none !important;">-->
                                    <!--                                        <input class="form-check-input m-0" type="checkbox" v-model="selectedSuper"-->
                                    <!--                                               :value="vendor.id">-->
                                    <!--                                    </td>-->
                                    <!--                                    <td style="padding: 10px;;border: none !important;">{{ vendor.text }}</td>-->
                                    <!--                                </tr>-->

                                    <template v-for="(vendor ,index ) in vendors">
                                        <tr :class="(selectedSuper.indexOf(vendor.customer_id) > -1) ? 'active-c' : ''"
                                            style="border-bottom: 1px solid gray"
                                            @click="clickAndCheck(vendor.customer_id)">
                                            <td style="display : none;width: 50px;padding: 10px;border: none !important;">
                                                <input class="form-check-input m-0 hide" :id="vendor.customer_id"
                                                       type="checkbox"
                                                       v-model="selectedSuper"
                                                       :value="vendor.customer_id">
                                            </td>
                                            <td style="padding: 10px;;border: none !important;">{{ vendor.name }}</td>
                                            <td style="padding: 10px;border: none !important;text-align: center;text-transform: uppercase">
                                                {{ vendor.rank }}
                                            </td>
                                            <td style="padding: 10px;border: none !important;width: 80px">
                                                <input  type="tel"  class="form-control"
                                                        @keypress="pressEnterAndSGo($event)"
                                                        @blur="saveCustomerWisePrice(vendor,index)"
                                                        style="border-radius: 0px; text-align: center; padding: 7px 0px;" v-model="vendor.price">
                                            </td>
                                        </tr>
                                    </template>

                                    </tbody>

                                </table>
                            </div>

<!--                            <button-->
<!--                                class="btn btn-danger float-left mr-1 " @click="deleteMistunury(preview_product)"-->
<!--                                style="padding: 5px 5px; font-size: 18px;float: left;">-->
<!--                                削除-->
<!--                            </button>-->
<!--                            <button-->
<!--                                class="btn btn-success float-right mr-1 " @click="sendtoSuper()" :disabled="selectedSuper.length <= 0 ? true : false"-->
<!--                                style="top: 5px; right: 0px;padding: 5px 5px; font-size: 18px; float: right;">-->
<!--                                送信-->
<!--                            </button>-->


                        </div>
                        <!--                    <div class="modal-footer " style="padding: 6px">-->
                        <!--                    </div>-->
                    </div>
                </div>
            </div>
            <!--        // mistumury-prodct-add-modal-->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true" id="mistumury-prodct-add-modal">
                <div class="modal-dialog modal-lg mt-0">
                    <div class="modal-content">
                        <div class="modal-header" style="padding: 5px;justify-content: right">
                            <!--                        <button class="btn btn-success float-right mr-1" id="product-add&#45;&#45;"-->
                            <!--                                @click="saveNewMistumuryProduct($event,1)"> 保存と送信-->
                            <!--                        </button>-->
                            <!--                        <button class="btn btn-success float-right mr-1" id="product-add-"-->
                            <!--                                @click="saveNewMistumuryProduct($event)"> 保存-->
                            <!--                        </button>-->
                            <!--                        &lt;!&ndash;                        <a class="btn btn-success float-right mr-2">発注</a>&ndash;&gt;-->
                            <!--                        <a class="btn btn-info float-right" @click="confirmAndHide('mistumury-prodct-add-modal')">戻る</a>-->

                        </div>
                        <div class="modal-body p-0" style="text-align: center">
                            <div
                                style="font-size: 18px;text-align: left;padding: 5px 10px;background: #c3ff8f80;font-weight: bold;">
                                <input type="text" v-model="mistumury_product.title" class="form-control"
                                       placeholder="商品名を入力してください" @click="handiNaviShow_()">
                            </div>
                            <div>
                                <div class="form-group text-center">
                                    <input type="file" :accept="open_camera ? 'image;capture=camera' : 'image/*'"
                                           @change="previewImage" class="form-control-file hide"
                                           id="my-file" alt="00" capture="camera" ref="file">
                                    <button class="btn btn-info" id="click-file" @click="clickAddFile(0)">画像を選ぶ</button>
                                    <button class="btn btn-primary" id="open-camera" @click="clickAddFile(1)">写真を撮る
                                    </button>
                                </div>
                                <img v-if="preview"
                                     :src="preview"
                                     class="img-thumbnail custom-img-preview" alt="Cinque Terre"
                                     style="cursor: pointer">
                            </div>
                            <div>
                                <table data-v-c9953dda="" class="table table-bordered physical_handy_tabls">
                                    <thead data-v-c9953dda="">
                                    <tr data-v-c9953dda="">
                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">
                                            原価
                                        </th>
                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">
                                            売価
                                        </th>
                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">
                                            粗利
                                        </th>
                                        <th data-v-c9953dda="" style="width: 50px; text-align: center; padding: 5px;">
                                            ％
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody data-v-c9953dda="" class="physicaltbody">
                                    <tr data-v-c9953dda="">
                                        <td data-v-c9953dda="">
                                            <input data-v-c9953dda="" type="tel" id="cost_" @click="selectItem($event)"
                                                   class="form-control  " v-model="mistumury_product.cost"
                                                   @keypress="pressEnterAndNext($event,'sell_')"
                                                   @keyup="calculateNewProductAddPrice('cost')"
                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;">
                                        </td>
                                        <td data-v-c9953dda="">
                                            <input data-v-c9953dda="" type="tel" id="sell_" @click="selectItem($event)"
                                                   class="form-control  " v-model="mistumury_product.sell"
                                                   @keypress="pressEnterAndNext($event,'profit_margin_')"
                                                   @keyup="calculateNewProductAddPrice('sell')"
                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;">
                                        </td>
                                        <td data-v-c9953dda="">
                                            <input data-v-c9953dda="" type="tel" id="profit_"
                                                   @click="selectItem($event)"
                                                   class="form-control  "
                                                   :value="(mistumury_product.sell && mistumury_product.cost) ? mistumury_product.sell - mistumury_product.cost : ''"
                                                   readonly
                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;">
                                            <!--                                        v-model="preview_product.profit"-->
                                            <!--                                               @keypress="pressEnterAndNext($event,'profit_margin')"-->
                                            <!--                                               @keyup="calculatePrice('profit')"-->
                                        </td>
                                        <td data-v-c9953dda="">
                                            <input data-v-c9953dda="" type="tel" id="profit_margin_"
                                                   @click="selectItem($event)"
                                                   @keypress="pressEnterAndNext($event,'cost_')"
                                                   class="form-control  " v-model="mistumury_product.profit_margin"
                                                   @keyup="calculateNewProductAddPrice('profit_margin')"
                                                   style="border-radius: 0px; text-align: center; padding: 7px 0px;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group" style="display: none">
                                <select class="form-control" id="vendprs" v-model="maker_id"
                                        @change="updateVendorData()">
                                    <option value="0">問屋を選択</option>
                                    <option v-for="vendor in vendors" :value="vendor.id">
                                        {{ vendor.text }}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <!--                    <div class="modal-footer " style="padding: 6px">-->
                        <!--                    </div>-->
                    </div>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true" id="mistumury-select-super">
                <div class="modal-dialog modal-lg mt-0">
                    <div class="modal-content">
                        <div class="modal-header" style="padding: 5px;justify-content: right">
                            <!--                            <button class="btn btn-success mr-2" @click="sendtoSuper()"-->
                            <!--                                    :disabled="(productJans.length > 0 && selectedSuper.length > 0 ) ? false : true">送信-->
                            <!--                            </button>-->
                            <!--                            <a class="btn btn-info float-right" @click="confirmAndHide('mistumury-select-super')">戻る</a>-->
                        </div>
                        <div class="modal-body p-0" style="text-align: center">
                            <div
                                style="font-size: 16px;text-align: left;padding: 5px 10px;background: #c3ff8f80;font-weight: bold;">
                                スーパーを選択して送信してください
                            </div>
                            <div>
                                <table data-v-c9953dda="" class="table table-bordered physical_handy_tabls">
                                    <thead>
                                    <tr>
                                        <th colspan="2 " style="text-align: left">
                                            <input class="form-check-input check-all m-0" @click="selectAllSuper()"
                                                   v-model="allSelectedSuper" type="checkbox" value="">
                                            <label class="form-check-label " style="margin-left: 40px"
                                                   for="flexCheckChecked">
                                                全て
                                            </label>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody data-v-c9953dda="" class="physicaltbody">

                                    <!--                                <tr :class="(selectedSuper.indexOf(vendor.id) > -1) ? 'active-c' : ''"-->
                                    <!--                                    v-for="vendor in vendors" style="border-bottom: 1px solid gray">-->
                                    <!--                                    <td style="width: 50px;padding: 10px;border: none !important;">-->
                                    <!--                                        <input class="form-check-input m-0" type="checkbox" v-model="selectedSuper"-->
                                    <!--                                               :value="vendor.id">-->
                                    <!--                                    </td>-->
                                    <!--                                    <td style="padding: 10px;;border: none !important;">{{ vendor.text }}</td>-->
                                    <!--                                </tr>-->

                                    <template v-for="vendor in vendors">
                                        <tr :class="(selectedSuper.indexOf(vendor.customer_id) > -1) ? 'active-c' : ''"
                                            style="border-bottom: 1px solid gray"
                                            @click="clickAndCheck(vendor.customer_id)">
                                            <td style="width: 50px;padding: 10px;border: none !important;">
                                                <input class="form-check-input m-0 hide" :id="vendor.customer_id"
                                                       type="checkbox"
                                                       v-model="selectedSuper"
                                                       :value="vendor.customer_id">
                                            </td>
                                            <td style="padding: 10px;;border: none !important;">{{ vendor.name }}</td>
                                        </tr>

                                        <tr v-if="selectedSuper.indexOf(vendor.customer_id) > -1">
                                            <td colspan="2">
                                                <table data-v-c9953dda=""
                                                       class="table table-borderless physical_handy_tabls">
                                                    <tr style="border-bottom: 1px solid gray"
                                                        v-for="shop in vendor.shops"
                                                        :class="(checkExist(shop.customer_shop_id)) ? 'active-c' : ''"
                                                        @click="selectSuperShop(vendor.customer_id,shop.customer_shop_id)">
                                                        <td style="border: none !important;padding: 10px"></td>
                                                        <td style="border: none !important;padding: 10px"></td>
                                                        <td style="padding: 10px;;border: none !important;">
                                                            {{ shop.shop_name }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </template>

                                    </tbody>

                                </table>
                            </div>

                            <div class="form-group" v-if="message">
                                <label><h5 class="text-warning">ここにメッセージを書くことができます </h5></label>
                                <textarea class="form-control" autofocus v-model="message"
                                          style="border: 1px solid; background: beige;"
                                          id="exampleFormControlTextarea1" rows="3">

                            </textarea>
                            </div>


                        </div>
                        <!--                    <div class="modal-footer " style="padding: 6px">-->
                        <!--                    </div>-->
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg" style="top: 100px" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true" id="mistumury-add-product-continue">
                <div class="modal-dialog modal-lg mt-0">
                    <div class="modal-content">
                        <div class="modal-header" style="padding: 20px;">
                                <button @click="addProductModal(1)"
                                        class="btn btn-info float-left mr-1 "
                                        style="padding: 5px 10px; font-size: 22px;float: left;">
                                    続ける
                                </button>
                                <button onclick="$('#mistumury-add-product-continue').modal('hide')"
                                        class="btn btn-primary pull-right mr-1 " id="show-super-list_-"
                                        style="top: 5px; right: 0px;padding: 5px 10px; font-size: 22px; float: right;">
                                    戻る
                                </button>

                        </div>
                        <div class="modal-body" style="padding: 5px">
                            <button
                                    class="btn btn-success float-left mr-1 "
                                    style="padding: 5px 5px; font-size: 18px;float: left;">
                                スーパー一覧表
                            </button>
                            <button @click="super_price = super_price ? 0 : 1"
                                    class="btn btn-primary float-right mr-1 "
                                    style="top: 5px; right: 0px;padding: 5px 5px; font-size: 18px; float: right;">
                                スーパー別
                            </button>
                            <div>
                                <table data-v-c9953dda="" class="table table-bordered physical_handy_tabls " style="margin-top: 30px;margin-bottom: 50px">
                                    <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: left;border-right: none !important;">
                                            <input class="form-check-input check-all m-0" @click="selectAllSuper()"
                                                   v-model="allSelectedSuper" type="checkbox" value="">
                                            <label class="form-check-label " style="margin-left: 40px"
                                                   for="flexCheckChecked">
                                                全て
                                            </label>
                                        </th>
                                    </tr>
                                    </thead>
                                    <thead>
                                    <tr>

                                        <th >
                                            スーパー名
                                        </th>
                                        <th>
                                            ランク
                                            設定
                                        </th>
                                        <th >
                                            %
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody data-v-c9953dda="" class="physicaltbody">

                                    <!--                                <tr :class="(selectedSuper.indexOf(vendor.id) > -1) ? 'active-c' : ''"-->
                                    <!--                                    v-for="vendor in vendors" style="border-bottom: 1px solid gray">-->
                                    <!--                                    <td style="width: 50px;padding: 10px;border: none !important;">-->
                                    <!--                                        <input class="form-check-input m-0" type="checkbox" v-model="selectedSuper"-->
                                    <!--                                               :value="vendor.id">-->
                                    <!--                                    </td>-->
                                    <!--                                    <td style="padding: 10px;;border: none !important;">{{ vendor.text }}</td>-->
                                    <!--                                </tr>-->

                                    <template v-for="(vendor ,index ) in vendors">
                                        <tr :class="(selectedSuper.indexOf(vendor.customer_id) > -1) ? 'active-c' : ''"
                                            style="border-bottom: 1px solid gray"
                                            @click="clickAndCheck(vendor.customer_id)">
                                            <td style="display : none;width: 50px;padding: 10px;border: none !important;">
                                                <input class="form-check-input m-0 hide" :id="vendor.customer_id"
                                                       type="checkbox"
                                                       v-model="selectedSuper"
                                                       :value="vendor.customer_id">
                                            </td>
                                            <td style="padding: 10px;;border: none !important;">{{ vendor.name }}</td>
                                            <td style="padding: 10px;border: none !important;text-align: center;text-transform: uppercase">
                                                {{ vendor.rank }}
                                            </td>
                                            <td style="padding: 10px;border: none !important;width: 80px">
                                                <input  type="tel"  class="form-control"
                                                        @keypress="pressEnterAndSGo($event)"
                                                        @blur="saveCustomerWisePrice(vendor,index)"
                                                        style="border-radius: 0px; text-align: center; padding: 7px 0px;" v-model="vendor.price">
                                            </td>
                                        </tr>
                                    </template>

                                    </tbody>

                                </table>
                            </div>

                            <button
                                class="btn btn-danger float-left mr-1 " @click="deleteMistunury(preview_product)"
                                style="padding: 5px 5px; font-size: 18px;float: left;">
                                削除
                            </button>
                            <button
                                    class="btn btn-success float-right mr-1 " @click="sendtoSuper()" :disabled="selectedSuper.length <= 0 ? true : false"
                                    style="top: 5px; right: 0px;padding: 5px 5px; font-size: 18px; float: right;">
                                送信
                            </button>
                        </div>


                    </div>
                </div>
            </div>

            <div class="jn nav_disp-w" style="z-index: 9999;width: 270px; right: 15px; bottom: 15px;"
                 id="handy-navi">
                <div class="card card-warning jn_old_popup " style="padding: 6px">
                    <!--                <div class="card-heading">-->
                    <!--                    <a class="btn btn-light float-right" href="javascript:void(0)"-->
                    <!--                       onclick="$('#handy-navi').hide()">戻る</a>-->
                    <!--                </div>-->
                    <div class="card-body">
                        <a class="btn btn-light float-right" href="javascript:void(0)"
                           v-if="selected_products.length <= 0"
                           onclick="$('#handy-navi').hide();$('#mistumury-mage-preview').modal('hide');">戻る</a>

                        <a class="btn btn-light float-right" href="javascript:void(0)" v-else
                           @click="confirm()">***</a>

                        <ol id="handy-navi-body" v-html="handi_navi">

                        </ol>


                    </div>
                </div>
            </div>
            <div class="jn nav_disp-w" style="z-index: 9999; right: 15px; bottom: 15px;" :class="navi_button == 4 ? 'navi-width-100' : 'navi-width-350'"
                 id="handy-camara-navi">
                <div class="card card-warning jn_old_popup " style="padding: 6px">
                    <div class="card-heading">
                        <!--                    <a class="btn btn-light float-right" href="javascript:void(0)"-->
                        <!--                       onclick="$('#handy-camara-navi').hide()">戻る</a>-->
                    </div>
                    <div class="card-body" style="text-align: center;font-size: 16px">
                        <template v-if="navi_button == 1">
                            <span style="width: 100%;color: green;">{{ success_navi }}</span><br>
                            <button @click="addProductModal(0)" v-if="productJans.length <= 0"
                                    class="btn btn-info pull-right mr-1 "
                                    style=" top: 5px; right: 115px;padding: 5px 10px; font-size: 22px;float: right;font-size: 20px;">
                                メンテ
                            </button>
                            または
                            <button @click="addProductModal(1)" v-if="productJans.length <= 0"
                                    class="btn btn-primary pull-right mr-1 " id="show-super-list__"
                                    style="top: 5px; right: 0px;padding: 5px 10px; font-size: 22px; float: left;font-size: 20px;">
                                撮影
                            </button>
                            <br>を選んで下さい

                        </template>
                        <template v-else-if="navi_button == 2">
                            <button class="btn btn-success mr-1" id="product-add--" style="font-size: 20px;"
                                    @click="saveNewMistumuryProduct($event,1)">送信
                            </button>
                        </template>

                        <template v-else-if="navi_button == 4">
                            <a class="btn btn-info float-right" style="font-size: 20px;"
                               @click="confirmAndHide('mistumury-mage-preview')">戻る</a>
                            <br>
                            <button class="btn btn-info pull-left mr-1 "  @click="sendtoSuper()" :disabled="selectedSuper.length <= 0 ? true : false"
                                    style=" top: 5px; right: 115px;padding: 5px 10px; font-size: 22px;float: left;font-size: 20px;">
                                送信
                            </button>
<!--                            <div style="width: 100%;margin-top: 20px;text-align: center">-->
<!--                                <button class="btn btn-info pull-right mr-1 "  @click="sendtoSuper()" :disabled="selectedSuper.length <= 0 ? true : false"-->
<!--                                        style=" top: 5px; right: 115px;padding: 5px 10px; font-size: 22px;float: right;font-size: 20px;">-->
<!--                                    送信-->
<!--                                </button>-->
<!--                                <button class="btn btn-primary pull-right mr-1 " id="show-super-list&#45;&#45;"-->
<!--                                        style="top: 5px; right: 0px;padding: 5px 10px; font-size: 22px; float: left;font-size: 20px;">-->
<!--                                    全体-->
<!--                                </button>-->
<!--                                <br>-->
<!--                                <button class="btn btn-primary pull-right mr-1 " id="show-super-list"-->
<!--                                        style="top: 5px; right: 0px;padding: 5px 10px; font-size: 22px; float: left;font-size: 20px;width: 200px">-->
<!--                                    スーパー別のランク付け-->
<!--                                </button>-->
<!--                            </div>-->

                        </template>


                        <template v-else-if="navi_button == 5">
                            <button class="btn btn-success mr-2 float-left" style="font-size: 20px;"
                                    @click="sendtoSuper()" v-if="(productJans.length > 0 && selectedSuper.length > 0 )"
                                    :disabled="(productJans.length > 0 && selectedSuper.length > 0 ) ? false : true">送信
                            </button>
                            <a class="btn btn-primary float-left" style="font-size: 20px;" v-else
                               onclick="$('#mistumury-select-super').modal('hide')">商品選択画面</a>
                            <a class="btn btn-info float-right" style="font-size: 20px;"
                               @click="confirmAndHide('mistumury-select-super')">戻る</a>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
import TextRecognition from "./text-recognition";
import {StreamBarcodeReader} from "vue-barcode-reader";

export default {
    props: ['base_url'],
    name: "handy-custom-mistumury",
    data() {
        return {
            speech_start: 0,
            jan_code: '',
            order_data: [],
            select_status: 0,
            products: [],
            selected_products: [],
            handi_navi: '',
            search_data: null,
            product_pics: [],
            preview_product: {},
            maker_id: 0,
            vendors: [],
            images: [],
            selected: [],
            allSelected: false,
            allSelectedSuper: false,
            productJans: [],
            selectedSuper: [],
            message: null,
            mistumury_product: {
                title: '',
                cost: 100,
                sell: 120,
                profit_margin: 20
            },
            preview: null,
            open_camera: 0,
            selectedSuperShops: [],
            check: null,
            selected_input: '',
            navi_button: null,
            product_select_mode: 0,
            success_navi: '',
            super_price : 0

        }
    },
    mounted() {
        // this.getProducts();
        let _this = this;
        this.images = ['57.jpg', 'cocacola.jpeg', 's-l1600.jpg', 'fish.jpeg', '4901005109803.jpg', '69813_11.png', '69813_11.png', 'Whocoded.jpg'];
        $('#jan_').focus()
        $('#jan_').select()
        this.getVendorList();
        this.getProducts();
        this.handiNaviShow();
        setTimeout(function () {
            // _this.addProductModal(1);
        }, 3000)

    },
    methods: {
        getProducts() {
            let _this = this;
            axios.get(this.base_url + '/get-all-custom-mistumury-products')
                .then(function (res) {
                    let data = res.data;
                    _this.products = data.products;
                    _this.productJans = [];
                    _this.preview_product = _this.products[0];
                    _this.vendors.map(function (customer) {
                        customer.price = _this.products[0].selling_price;
                    })
                })
                .catch(function () {

                })
                .finally(function () {

                })
        },
        getProductsUpdate() {
            let _this = this;
            axios.get(this.base_url + '/get-all-custom-mistumury-products')
                .then(function (res) {
                    let data = res.data;
                    _this.products = data.products;
                    _this.productJans = [];
                })
                .catch(function () {

                })
                .finally(function () {

                })
        },
        setSelectStatus() {
            this.select_status = this.select_status ? 0 : 1;
            if (this.select_status === 1) {
                this.handi_navi = '0000000000000';
                $('#handy-navi').show();
            } else {
                this.selected_products = [];
            }
        },
        selectProduct(product) {
            if (!this.select_status) {
                return false;
            }
            let index = this.selected_products.indexOf(product.jan);
            if (index < 0) {
                this.selected_products.push(product.jan)
            } else {
                this.selected_products.splice(index, 1);
            }

            if (this.selected_products.length > 0) {
                this.handi_navi = '***********';
                $('#handy-navi').show();
            }


        },
        confirm() {
            this.select_status = 0;
            this.selected_products = [];
            // this.handi_navi = '---------';
            // $('#handy-navi').show();
        },
        viewInfoForImage(product, img, i = 0) {

            if (i === 0 && this.product_select_mode) {
                $('#check_by_' + product.jan).click();
                // $('#handy-camara-navi').hide();
                return 0;
            }
            product.item_name = product.name;
            // product.img = img;
            product.profit_margin = product.profit_margin;
            this.previewProductInfoWithImage(product);
            return true;
        },
        confirmAndHide(type) {
            this.product_select_mode = 0
            $('#' + type).modal('hide')
            $('#' + type).modal('hide')
            if (type == 'mistumury-mage-preview' || type == 'mistumury-select-super') {
                $('#handy-camara-navi').hide();
            }
            if (type == 'mistumury-select-super') {
                this.product_select_mode = 0;
            }

        },
        getOrderDataByJan() {
            let _this = this;
            let reg = /^\d+$/;
            if (!reg.test(this.jan_code)) {
                _this.getSearchData(_this.jan_code);
                return false
            }
            if (_this.jan_code.length <= 0) {
                return false;
            }
            $('.loading_image_custom').show()
            _this.loader = 1
            axios.get(this.base_url + '/handy_stock_detail_get_by_jan_code/' + _this.jan_code)
                .then(function (res) {
                    //_this.resetField();
                    if (res.data.status == 400) {
                        console.log('log here');
                        _this.handi_navi = '<li>0000000</li>';
                        $('#handy-navi').show();
                        return false;
                    }
                    if (res.data.result.length > 0) {
                        _this.order_data = res.data.result;
                        _this.order_data_ = _this.order_data[0];
                        _this.product_name = _this.order_data[0].item_name;
                        _this.order_data[0].img = _this.order_data[0].jan == '4901005500341' ? 'chocolate.jpg' : _this.images[Math.floor(Math.random() * 7)];


                        _this.previewProductInfoWithImage(_this.order_data[0]);

                        _this.calculateTotalQuantity();

                        if (_this.type == 0) {
                            $('#stock-order-show-by-jan').modal({backdrop: 'static', keyboard: false})
                            setTimeout(function () {
                                $('#case0').focus()
                                $('#case0').select()
                                if ($('#rack' + 0).length <= 0) {
                                    // $('#order-place-button').focus()
                                } else {
                                    // if (!_this.readonly) {
                                    //     $('#rack' + 0).focus()
                                    //     $('#rack' + 0).select()
                                    // } else {
                                    //     $('#order-place-button').focus()
                                    // }
                                }
                            }, 720)
                        }
                        $('#handy-navi').hide();
                    } else {
                        _this.handi_navi = '<li>このjanコードはマスターに見つかりません</li>';
                        $('#handy-navi').show();
                    }


                })
                .catch(function () {

                })
                .finally(function () {
                    //_this.jan_code = ''
                    $('.loading_image_custom').hide()
                    _this.loader = 0

                })
        },
        checkAndGetData(e) {
            let _this = this;

            if (this.loader === 1 || this.jan_code.length <= 0) {
                return false;
            }
            let reg = /^\d+$/;

            if (this.jan_code.length >= 13 || this.jan_code.length == 8) {
                if (reg.test(this.jan_code)) {
                    this.insertToJanList()
                }
            }
            if (e.keyCode === 13) {
                if (reg.test(this.jan_code) && this.jan_code.length >= 8) {
                    this.insertToJanList()
                }
            }
            if (!reg.test(this.jan_code)) {
                setTimeout(function () {
                    _this.getSearchData(_this.jan_code);
                }, 1200)
            }

        },
        getSearchData(text) {
            let _this = this;
            if (text.length <= 0) {
                return false;
            }
            $('.loading_image_custom').show()
            _this.jan_code = text;
            axios.post(_this.base_url + '/item_search_by_name', {'name': text})
                .then(function (res) {
                    res = res.data
                    _this.search_data = res.name_list;
                    if (_this.search_data.length > 0) {
                        $('#handy-navi').hide()
                        $('#handy-navi-jan-list').show()
                    } else {
                        _this.handi_navi = '<li>XXXXXXX。</li>';
                        $('#handy-navi').show()
                    }

                })
                .catch(function () {

                })
                .finally(function () {
                    $('.loading_image_custom').hide()
                })


        },
        selectItem(e, selected_id) {
            e.target.select()
            this.startSpeech();
            this.selected_input = selected_id;
        },
        pressEnterAndSave(e, type) {
            let _this = this;
            if (e.keyCode == 13) {
                $('#' + type).focus()
                $('#' + type).select()
                // return false;
                if (parseFloat(_this.preview_product.cost) > parseFloat(_this.preview_product.sell)) {
                    _this.handi_navi = 'XXXXX';
                    $('#handy-navi').show()
                    return false;
                }
                // let data = {
                //     vendor_item_id: _this.preview_product.vendor_item_id,
                //     product_name: _this.preview_product.item_name,
                //     case_qty: parseInt(_this.preview_product.case_inputs),
                //     ball_qty: parseInt(_this.preview_product.ball_inputs),
                //     price: parseInt(_this.preview_product.cost),
                //     gross_profit_margin: parseInt(_this.preview_product.profit_margin),
                //     gross_profit: parseInt(_this.preview_product.sell - _this.preview_product.cost),
                //     selling_price: parseInt(_this.preview_product.sell),
                //     sale_selling_price: parseInt(_this.preview_product.sale_selling_price)
                // }

                // return false;
                let data = {
                    jan: _this.preview_product.jan,
                    price: parseFloat(_this.preview_product.cost),
                    gross_profit_margin: parseFloat(_this.preview_product.profit_margin),
                    gross_profit: ((_this.preview_product.sell - _this.preview_product.cost) / _this.preview_product.sell * 100).toFixed(2),
                    selling_price: parseFloat(_this.preview_product.sell),
                    sale_selling_price: parseInt(_this.preview_product.sale_selling_price)
                }

                // axios.post(_this.base_url + '/update_custom_estimate_items', data)
                //     .then(function (response) {
                //         // _this.getOrderDataByJan();
                //         _this.getProducts();
                //         _this.handi_navi = '仕入・販売先マスターへ登録されました';
                //         $('#handy-navi').show()
                //     })
                //     .catch(function (e) {
                //         console.log(e)
                //     })

            }
        },
        pressEnterAndNext(e, type) {
            let _this = this;
            if (e.keyCode == 13) {
                $('#' + type).focus()
                $('#' + type).select()
                // return false;
                if (parseFloat(_this.preview_product.cost) > parseFloat(_this.preview_product.sell)) {
                    _this.handi_navi = 'XXXXX';
                    $('#handy-navi').show()
                    return false;
                }

                // return false;
                let data = {
                    jan: _this.preview_product.jan,
                    price: parseFloat(_this.preview_product.cost),
                    gross_profit_margin: parseFloat(_this.preview_product.profit_margin),
                    gross_profit: ((_this.preview_product.sell - _this.preview_product.cost) / _this.preview_product.sell * 100).toFixed(2),
                    selling_price: parseFloat(_this.preview_product.sell),
                    sale_selling_price: parseInt(_this.preview_product.sale_selling_price)
                }

            }
        },
        blurAndSave() {
            let _this = this;

            // return false;

            if (parseFloat(_this.preview_product.cost) > parseFloat(_this.preview_product.sell)) {
                _this.handi_navi = 'XXXXX';
                $('#handy-navi').show()
                return false;
            }
            let data = {
                id: _this.preview_product.id,
                cost: parseFloat(_this.preview_product.cost),
                gross_profit_margin: parseFloat(_this.preview_product.gross_profit_margin),
                sell: parseFloat(_this.preview_product.sell)
            }

            axios.post(_this.base_url + '/update_custom_estimate_items', data)
                .then(function (response) {
                    // _this.getOrderDataByJan();
                    _this.getProducts();
                    // _this.handi_navi = '仕入・販売先マスターへ登録されました';
                    // $('#handy-navi').show()
                })
                .catch(function (e) {
                    console.log(e)
                })

        },
        calculatePrice(type) {

            let _this = this;

            if (type == 'profit_margin') {
                _this.preview_product.sell = parseFloat(_this.preview_product.cost) + parseFloat((_this.preview_product.cost * _this.preview_product.gross_profit_margin) / 100);
                _this.preview_product.sell = _this.preview_product.sell.toFixed(2)
                // _this.preview_product.profit = (_this.preview_product.sell - _this.preview_product.cost).toFixed(2);
                _this.preview_product.profit = (((_this.preview_product.sell - _this.preview_product.cost) / _this.preview_product.sell) * 100).toFixed(2);
            } else if (type == 'sell') {
                _this.preview_product.gross_profit_margin = ((parseFloat(_this.preview_product.sell) - parseFloat(_this.preview_product.cost)) * 100) / _this.preview_product.cost
                _this.preview_product.gross_profit_margin = _this.preview_product.gross_profit_margin.toFixed(2);
                // _this.preview_product.profit = (_this.preview_product.sell - _this.preview_product.cost).toFixed(2);
                _this.preview_product.profit = (((_this.preview_product.sell - _this.preview_product.cost) / _this.preview_product.sell) * 100).toFixed(2);

            } else if (type == 'profit') {
                _this.preview_product.sell = parseFloat(_this.preview_product.cost) + parseFloat($('#profit').val())
                _this.preview_product.gross_profit_margin = ((parseFloat(_this.preview_product.sell) - parseFloat(_this.preview_product.cost)) * 100) / _this.preview_product.cost;
                _this.preview_product.sell = _this.preview_product.sell.toFixed(2);
                _this.preview_product.gross_profit_margin = _this.preview_product.gross_profit_margin.toFixed(2);
            } else if (type == 'cost') {
                _this.preview_product.sell = parseFloat(_this.preview_product.cost) + parseFloat((_this.preview_product.cost * _this.preview_product.gross_profit_margin) / 100);
                _this.preview_product.sell = _this.preview_product.sell.toFixed(2)
                // _this.preview_product.profit = (_this.preview_product.sell - _this.preview_product.cost).toFixed(2);
                _this.preview_product.profit = (((_this.preview_product.sell - _this.preview_product.cost) / _this.preview_product.sell) * 100).toFixed(2);

            }

            // localStorage.setItem('preview_product', JSON.stringify(_this.preview_product));

        },
        calculateNewProductAddPrice(type) {

            let _this = this;

            if (type == 'profit_margin') {
                _this.mistumury_product.sell = parseFloat(_this.mistumury_product.cost) + parseFloat((_this.mistumury_product.cost * _this.mistumury_product.profit_margin) / 100);
                _this.mistumury_product.sell = _this.mistumury_product.sell.toFixed(2)
                // _this.mistumury_product.profit = (_this.mistumury_product.sell - _this.mistumury_product.cost).toFixed(2);
                _this.mistumury_product.profit = (((_this.mistumury_product.sell - _this.mistumury_product.cost) / _this.mistumury_product.sell) * 100).toFixed(2);
            } else if (type == 'sell') {
                _this.mistumury_product.profit_margin = ((parseFloat(_this.mistumury_product.sell) - parseFloat(_this.mistumury_product.cost)) * 100) / _this.mistumury_product.cost
                _this.mistumury_product.profit_margin = _this.mistumury_product.profit_margin.toFixed(2);
                // _this.mistumury_product.profit = (_this.mistumury_product.sell - _this.mistumury_product.cost).toFixed(2);
                _this.mistumury_product.profit = (((_this.mistumury_product.sell - _this.mistumury_product.cost) / _this.mistumury_product.sell) * 100).toFixed(2);

            } else if (type == 'profit') {
                _this.mistumury_product.sell = parseFloat(_this.mistumury_product.cost) + parseFloat($('#profit').val())
                _this.mistumury_product.profit_margin = ((parseFloat(_this.mistumury_product.sell) - parseFloat(_this.mistumury_product.cost)) * 100) / _this.mistumury_product.cost;
                _this.mistumury_product.sell = _this.mistumury_product.sell.toFixed(2);
                _this.mistumury_product.profit_margin = _this.mistumury_product.profit_margin.toFixed(2);
            } else if (type == 'cost') {
                _this.mistumury_product.sell = parseFloat(_this.mistumury_product.cost) + parseFloat((_this.mistumury_product.cost * _this.mistumury_product.profit_margin) / 100);
                _this.mistumury_product.sell = _this.mistumury_product.sell.toFixed(2)
                // _this.mistumury_product.profit = (_this.mistumury_product.sell - _this.mistumury_product.cost).toFixed(2);
                _this.mistumury_product.profit = (((_this.mistumury_product.sell - _this.mistumury_product.cost) / _this.mistumury_product.sell) * 100).toFixed(2);

            }

            // localStorage.setItem('preview_product', JSON.stringify(_this.preview_product));

        },
        updateVendorData() {
            let _this = this;
            if (_this.maker_id == null) {
                _this.handi_navi = '「仕入先」を指示してください。';
                $('#handy-navi').show()
                return false;
            }
            axios.post(_this.base_url + '/vendor_master_update_by_vendor_id', {
                vendor_item_id: _this.preview_product.vendor_item_id,
                vendor_id: _this.maker_id,
                maker_id: _this.preview_product.maker_id
            }).then(function (response) {
                _this.getOrderDataByJan();
                _this.handi_navi = '000000';
                $('#handy-navi').show()
            })
        },
        getVendorList() {
            let _this = this;
            axios.post(_this.base_url + '/get_customer_list')
                .then(function (response) {
                    // console.log(response.data)
                    _this.vendors = response.data.all_customer_list;
                    // $('#select_tonya').modal({backdrop: 'static', keyboard: false})
                })
                .catch(function (e) {

                })
        },
        previewProductInfoWithImage(product) {
            let _this = this;
            _this.preview_product = product;
            _this.selectedSuper = [];
            let prices = [];
            _this.preview_product.customer_prices.map(function (price) {
                prices[price.customer_id] = price.price
            })
            _this.vendors.map(function (customer) {
                customer.price = prices[customer.customer_id];
            })
            _this.vendors.sort((a,b) => a.price - b.price);
            _this.preview_product.prices = prices
            let i,alphabet= [];
            for(i=9;++i<36;){
                alphabet.push( i.toString(36));
            }

            _this.vendors.map(function (customer,key) {
                customer.rank = alphabet[key];
            })

            _this.maker_id = 0;
            _this.preview_product.title = product.name;
            _this.preview_product.cost = product.cost_price;
            _this.preview_product.sell = product.selling_price;
            // _this.preview_product.profit = product.selling_price - product.cost_price;
            _this.preview_product.profit = (((_this.preview_product.sell - _this.preview_product.cost) / _this.preview_product.sell) * 100).toFixed(2);
            _this.preview_product.gross_profit_margin = _this.preview_product.gross_profit_margin ? _this.preview_product.gross_profit_margin : (((_this.preview_product.sell - _this.preview_product.cost) / _this.preview_product.cost) * 100).toFixed(2);

            $('#mistumury-mage-preview').modal({backdrop: 'static'})
            // $('#special-price').focus();
            // $('#special-price').select();
            setTimeout(function () {
                $('#cost').focus();
                $('#cost').select();
                _this.startSpeech();
                _this.selected_input = 'cost';
                $('#handy-camara-navi').hide();

                _this.navi_button = 4;
                $('#handy-camara-navi').show();

            }, 700)

        },
        updateVendorItemProperty(vendor, type = null) {
            let _this = this;
            console.log(vendor)
            if (type == 'profit_margin') {
                vendor.selling_price = parseFloat(vendor.cost_price) + parseFloat((vendor.cost_price * vendor.profit_margin) / 100);
                vendor.selling_price = vendor.selling_price.toFixed(2)
            } else if (type == 'sell') {
                vendor.profit_margin = ((parseFloat(vendor.selling_price) - parseFloat(vendor.cost_price)) * 100) / vendor.cost_price
                vendor.profit_margin = vendor.profit_margin.toFixed(2);
            } else if (type == 'profit') {
                vendor.selling_price = parseFloat(vendor.cost_price) + parseFloat($('#profit').val())
                vendor.profit_margin = ((parseFloat(vendor.selling_price) - parseFloat(vendor.cost_price)) * 100) / vendor.cost_price;
                vendor.selling_price = vendor.selling_price.toFixed(2);
                vendor.profit_margin = vendor.profit_margin.toFixed(2);
            } else if (type == 'cost') {
                vendor.selling_price = parseFloat(vendor.cost_price) + parseFloat((vendor.cost_price * vendor.profit_margin) / 100);
                vendor.selling_price = vendor.selling_price.toFixed(2)
            }

            if (parseFloat(vendor.cost_price) > parseFloat(vendor.selling_price)) {
                _this.handi_navi = 'XXXXX';
                $('#handy-navi').show()
                return false;
            }
            let data = {
                vendor_item_id: vendor.vendor_item_id,
                product_name: vendor.item_name,
                case_qty: parseInt(vendor.case_inputs),
                ball_qty: parseInt(vendor.ball_inputs),
                price: parseInt(vendor.cost_price),
                gross_profit_margin: parseInt(vendor.profit_margin),
                gross_profit: ((vendor.selling_price - vendor.cost_price) / vendor.selling_price * 100).toFixed(2),
                selling_price: parseInt(vendor.selling_price)
            }

            axios.post(_this.base_url + '/update_vendor_master_item_content', data)
                .then(function (response) {
                    _this.getOrderDataByJan();
                    _this.handi_navi = '000000';
                    $('#handy-navi').show()
                })
                .catch(function (e) {
                    console.log(e)
                })


        },
        insertToJanList() {
            let _this = this;
            if (_this.jan_code.length <= 0) {
                return false
            }
            $('.loading_image_custom').show()
            _this.loader = 1;
            let jan_code = _this.jan_code;
            axios.post(_this.base_url + '/get_jan_info', {jan_code: _this.jan_code})
                .then(function (response) {
                    let api_response = response.data.api_data;
                    let data_resource = response.data.data_resource;

                    if (api_response == 'invalid_jan_code') {
                        //$('.handy_error_msg').html(`商品がありません`);
                        //$('.handdy_error').removeClass('hide').addClass('show');
                        _this.handi_navi = 'JAN コードを入力してください';
                        $('#handy-navi').show();
                    } else {
                        if (response.data.vendor_item_data == 1) {
                            console.log('this jan code is already registered');
                            _this.getOrderDataByJan();
                            _this.getProducts();
                            _this.jan_code = ''
                        } else {
                            console.log('do insert ' + jan_code);
                            let item_name = api_response.name;
                            let case_qty = 0;
                            let ball_qty = 0;
                            let api_maker_name = '';
                            if (data_resource == 'database') {
                                case_qty = api_response.case_inputs;
                                ball_qty = api_response.ball_inputs;
                            } else if (data_resource == 'api') {
                                api_maker_name = api_response.maker_name;
                            }
                            let vendor_id = response.data.vendor_id;
                            let price = 100;
                            /*insert auto vendor item*/
                            let order_point_unit = 'ケース';
                            let order_point_quantity = 1;
                            let order_lot_unit = 'ケース';
                            let order_lot_quantity = 1;
                            let vendor_item_id = null;
                            let sale_price = 0;
                            let basic_start_date = '2020-01-01';
                            let basic_end_date = '2021-12-31';
                            let sale_start_date = '2020-01-01';
                            let sale_end_date = '2021-12-31';
                            let data = {
                                maker_id: response.data.maker_id,
                                vendor_id: vendor_id,
                                jan_code: jan_code,
                                item_name: item_name,
                                case_qty: case_qty,
                                ball_qty: ball_qty,
                                price: price,
                                vendor_item_id: vendor_item_id,
                                order_point_unit: order_point_unit,
                                order_point_quantity: order_point_quantity,
                                order_lot_unit: order_lot_unit,
                                order_lot_quantity: order_lot_quantity,
                                sale_price: sale_price,
                                basic_start_date: basic_start_date,
                                basic_end_date: basic_end_date,
                                sale_start_date: sale_start_date,
                                sale_end_date: sale_end_date,
                                api_maker_name: api_maker_name,
                            }

                            axios.post(_this.base_url + '/add_vendor_item', data)
                                .then(function (response) {
                                    _this.getProducts();
                                    _this.getOrderDataByJan();
                                })
                                .catch(function (er) {

                                })


                        } //else

                    } //else

                })
                .then(function (er) {

                })
                .finally(function () {
                    // _this.jan_code = '';
                    $('.loading_image_custom').hide()
                    _this.loader = 0
                })
        },
        naviShow() {
            // this.handi_navi = '仕入・販売先マスターへ登録されました';
            // $('#handy-navi').show();
        },
        // select all
        selectAll() {
            this.productJans = [];
            if (!this.allSelected) {
                this.productJans = this.products
            }


        },
        selectAllSuper() {
            let _this = this;
            this.selectedSuper = [];
            this.selectedSuperShops = [];
            if (!_this.allSelectedSuper) {
                _this.vendors.map(function (ven) {
                    _this.selectedSuper.push(ven.customer_id)
                    _this.selectedSuperShops.push({
                        c_id: ven.customer_id, s_ids: ven.shops.map(function (sp) {
                            return sp.customer_shop_id;
                        })
                    })
                })
            }


        },
        // select super
        selectSuper(message = null) {
            this.message = message
            $('#mistumury-select-super').modal({backdrop: 'static'})
        },
        // add product model
        saveItemName(e) {
            let _this = this;
            if (e.keyCode == 13) {

                let data = {
                    jan: _this.preview_product.jan,
                    title: _this.preview_product.item_name
                }

                axios.post(_this.base_url + '/update_custom_estimate_items', data)
                    .then(function (response) {
                        // _this.getOrderDataByJan();
                        _this.getProducts();
                        _this.handi_navi = '000';
                        $('#handy-navi').show()
                    })
                    .catch(function (e) {
                        console.log(e)
                    })
            }
        },
        //
        addProductModal(type) {
            this.clickAddFile(type)
            if (!type) {
                return false;
            }
            setTimeout(function () {
                // $('#mistumury-prodct-add-modal').modal({backdrop: 'static'})
                $('#click-file').show()
                $('#open-camera').show()
            }, 2000)
        },
        //sendtoSuper
        sendtoSuper() {
            let _this = this;
            _this.confirmAndHide('mistumury-select-super');
            this.allSelected = false
            this.allSelectedSuper = false
            // this.productJans
            let data = {'item_info': [_this.preview_product], 'super_info': this.selectedSuperShops, 'message': this.message};
            this.handi_navi = '少しお待ちどして下さい';
            $('#handy-navi').show();
            $('#mistumury-select-super').modal('hide');
            // console.log(base_url)
            // console.log(base_url.includes('localhost'));
            // console.log(base_url.indexOf('localhost') !== -1);
            // var setApiUrl = (base_url.indexOf('localhost') !== -1 ? '/rv3_tonyav1' : '/rv3_superv1');
            var setApiUrl = '/rv3_superv1';

            axios.post(setApiUrl + '/api/custom-estimation-data', data)
                .then(function (response) {
                    // _this.getOrderDataByJan();
                    _this.getProductsUpdate();

                    $('#mistumury-add-product-continue').modal('hide')
                    _this.handi_navi = '見積スーパーに送信されました';
                    $('#handy-navi').show()
                    $('#handy-camara-navi').hide();
                })
                .catch(function (e) {
                    console.log(e)
                })
            this.selectedSuper = [];
            this.productJans = [];
        },
        //
        previewImage: function (event) {
            let _this = this;
            var input = event.target;
            if (input.files) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.preview = e.target.result;
                    // console.log(this.preview)
                    // this.mistumury_product.image = e.target.result
                    var img = new Image;
                    img.onload = resizeImage;
                    img.src = e.target.result;
                    function resizeImage() {
                        var newDataUri = _this.imageToDataUri(this, 150, 150);
                        // console.log(newDataUri)

                        let imag = _this.dataURLtoFile(newDataUri,'data.png');
                        _this.mistumury_product.image = imag;
                        _this.saveNewMistumuryProduct();
                    }
                }
                // this.mistumury_product.image = input.files[0];
                reader.readAsDataURL(input.files[0]);
            }
            $('#click-file').hide()
            $('#open-camera').hide()
            // navi button change
            $('#handy-camara-navi').hide();
            // this.navi_button = 2;

            this.mistumury_product.title = '000'
            // this.saveNewMistumuryProduct();

        },

        dataURLtoFile(dataurl, filename) {

            var arr = dataurl.split(','),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n);

            while(n--){
                u8arr[n] = bstr.charCodeAt(n);
            }

            return new File([u8arr], filename, {type:mime});
        },

        imageToDataUri(img, width, height) {

            // create an off-screen canvas
            var canvas = document.createElement('canvas'),
                ctx = canvas.getContext('2d');

            // set its dimension to target size
            canvas.width = width;
            canvas.height = height;

            // draw source image into the off-screen canvas:
            ctx.drawImage(img, 0, 0, width, height);

            // encode image to data-uri with base64 version of compressed image
            return canvas.toDataURL();
        },

        //image base64

        saveNewMistumuryProduct: function (event, i = null) {
            if (i == 1) {
                $('#product-add--').prop('disabled', true);
                $('#product-add-').prop('disabled', true);
            } else {
                $('#product-add-').prop('disabled', true);
                $('#product-add--').prop('disabled', true);
            }
            $('#handy-camara-navi').hide();
            let _this = this;
            if (this.mistumury_product.title.length <= 0 || this.mistumury_product.cost <= 0 || this.mistumury_product.sell <= 0) {
                this.handi_navi = '商品名を入力してください';
                $('#product-add-').prop('disabled', false);
                $('#product-add--   ').prop('disabled', false);
                $('#handy-navi').show();
                return false;
            }

            $('.loading_image_custom').show()
            _this.loader = 1
            let fd = new FormData()

            fd.append('image', _this.mistumury_product.image)

            fd.append('cost', _this.mistumury_product.cost)
            fd.append('sell', _this.mistumury_product.sell)
            fd.append('title', _this.mistumury_product.title)
            fd.append('profit_margin', _this.mistumury_product.profit_margin)
            //

            $('#mistumury-add-product-continue').modal({backdrop : 'static'})

            //
            axios.post(_this.base_url + '/custom-mistumury-products', fd)
                .then(function (response) {

                    _this.getProducts();
                    // _this.handi_navi = '仕入・販売先マスターへ登録されました';
                    // $('#handy-navi').show();
                    $('#handy-camara-navi').hide();
                    // $('#handy-camara-navi').show();
                    // _this.navi_button = 1;
                    $('#handy-navi').hide();

                    $('#mistumury-prodct-add-modal').modal('hide');
                    $('#product-add-').prop('disabled', false);
                    $('#product-add--').prop('disabled', false);
                    _this.mistumury_product.image = null
                    _this.preview = null
                    _this.mistumury_product.title = ''
                    $('#my-file').val('')
                    setTimeout(function () {
                        if (i == 1) {
                            $('#check_by_' + response.data.jan).click()
                            setTimeout(function () {
                                if (_this.productJans.length > 0) {
                                    $('#show-super-list').click()
                                }
                            }, 500)

                        }
                        // $('#img0').click()
                        // $('#handy-camara-navi').show();
                    }, 1000)
                    _this.success_navi = '画像保存されました'
                    $('.loading_image_custom').hide()
                    _this.loader = 0
                    setTimeout(function () {
                        _this.success_navi = '';
                    }, 10000)
                })
        },

        deleteMistunury: function (product) {
            let _this = this;
            _this.productJans = product ? [product] : _this.productJans

            $('#handy-camara-navi').hide();
            this.handi_navi = '<span style="font-size: 20px"> 削除しますか？ </span> ' +
                '<a href="javascript:void(0)" class="btn btn-danger btn-sm" id="delete-product" >はい　</a>' +
                '<a href="#" class="btn btn-info btn-sm" onclick="$(\'#handy-navi\').hide();$(\'#handy-camara-navi\').show();">いいえ</a>';
            $('#handy-navi').show();

            setTimeout(function () {
                $('#delete-product').on('click', function () {
                    _this.deleteProduct();
                })
            }, 1000)


            return 1;

            axios.post(_this.base_url + '/custom-mistumury-products-delete', {jan: jans})
                .then(function (response) {
                    _this.getProducts();
                    _this.handi_navi = '000000';
                    $('#mistumury-mage-preview').modal('hide')
                })
        },

        deleteProduct: function () {
            let _this = this;
            _this.productJans = _this.preview_product ? [_this.preview_product]  : _this.products
            let data = _this.productJans.map(function (pr) {
                return pr.jan
            })

            axios.post(_this.base_url + '/custom-mistumury-products-delete', {jan: data})
                .then(function (response) {
                    _this.getProducts();
                    _this.handi_navi = '000000';
                    $('#mistumury-mage-preview').modal('hide')
                    $('#mistumury-add-product-continue').modal('hide')
                    $('#').modal('hide')
                })
        },

        clickAddFile(type) {
            let _this = this;
            this.open_camera = type;
            if (!type) {
                _this.product_select_mode = 1;
                _this.navi_button = 5;
                _this.selectSuper(' ')
                // $('#mistumury-prodct-add-modal').hide();
                return false;
            }
            setTimeout(function () {
                // $('#my-file').click()
                // _this.$refs.file.$el.click()
                _this.performClick('my-file');
            }, 200)
        },

        performClick(elemId) {
            var elem = document.getElementById(elemId);
            if (elem && document.createEvent) {
                var evt = document.createEvent("MouseEvents");
                evt.initEvent("click", true, false);
                elem.dispatchEvent(evt);
            }
        },

        selectSuperShop(customer_id, shop_id) {
            let _this = this;
            this.selectedSuperShops.map(function (p, key) {
                if (p.c_id == customer_id) {
                    if (p.s_ids.indexOf(shop_id) > -1) {
                        p.s_ids.splice(p.s_ids.indexOf(shop_id), 1)
                    } else {
                        p.s_ids.push(shop_id)
                    }
                }
                console.log(key, p)
            })


        },

        checkExist(id) {
            var check = 0;
            this.selectedSuperShops.map(function (p, key) {
                if (p.s_ids.indexOf(id) > -1) {
                    check = 1;
                }
            })
            return check;
        },

        // for checkbox clcik
        clickAndCheck(id) {
            $('#' + id).click();
            let _this = this;
            _this.check = null;
            this.selectedSuperShops.map(function (p, key) {
                if (p.c_id == id) {
                    _this.check = key;
                }
                console.log(p.c_id, id, key, p)
            })

            if (_this.check == null) {
                this.selectedSuperShops.push({c_id: id, s_ids: []})
            } else {
                this.selectedSuperShops.splice(_this.check, 1)
            }

            if (this.selectedSuper.length) {
                // this.navi_button = 5;
                // $('#handy-camara-navi').show();
            }

        },
        // voice input
        placeValueToInputField(text) {
            let _this = this;
            text = parseInt(text);
            setTimeout(function () {
                if (_this.speech_start && text != NaN && text > 0) {
                    if (_this.selected_input == "cost") {
                        _this.preview_product.cost = text;
                    } else if (_this.selected_input == "sell") {
                        _this.preview_product.sell = text;
                    } else if (_this.selected_input == "profit_margin") {
                        _this.preview_product.gross_profit_margin = text;
                    }
                    console.log(text)
                    if (_this.selected_input != "profit") {
                        _this.calculatePrice(_this.selected_input);
                        _this.blurAndSave();
                    }
                    _this.speech_start = 0;
                    _this.product = null;
                    _this.selected_input = '';
                } else {
                    console.log(text)
                }
            }, 50)
        },
        getText({lastSentence, transcription}) {
            let _this = this;
            _this.placeValueToInputField(lastSentence);

        },
        startSpeech() {
            let _this = this
            _this.speech_start = (_this.speech_start === 0) ? 1 : 0;
        },
        handiNaviShow() {
            if (this.productJans.length <= 0) {
                $('#handy-camara-navi').show();
                this.navi_button = 1;
                this.confirmAndHide('mistumury-prodct-add-modal')
            }

        },
        handiNaviShow_() {
            if (this.productJans.length <= 0) {
                $('#handy-camara-navi').show();
                this.navi_button = 2;

            }

        },

        saveCustomerWisePrice(customer,index){
            let _this = this;
            let data = [];

            if (index == 0) {
                let price =  customer.price;
                _this.vendors.map(function (v,i) {
                    data.push({
                        customer_id : v.customer_id,
                        jan : _this.preview_product.jan,
                        price : (parseInt(price)+parseInt(i*5))
                    })
                })

                _this.vendors.map(function (v,i) {
                    v.price = (parseInt(price)+parseInt(i*5))
                })

            } else {
                data = [{
                    customer_id : customer.customer_id,
                    jan : _this.preview_product.jan,
                    price : customer.price
                }]
            }
            _this.vendors.sort((a,b) => a.price - b.price);

            let i,alphabet= [];
            for(i=9;++i<36;){
                alphabet.push( i.toString(36));
            }

            _this.vendors.map(function (customer,key) {
                customer.rank = alphabet[key];
            })

            axios.post(_this.base_url + '/customer-mistumury-products-price', {data : data})
                .then(function (response) {
                    _this.getProductsUpdate()
                })
        },

        pressEnterAndSGo(e) {
            let _this = this;
            if (e.keyCode == 13) {
                $(e.target).blur();
            }
        },
    },
    watch: {}
}
</script>

<style scoped>

.navi-width-100 {
    width: 220px;
}
.navi-width-350 {
    width: 300px;
}

.physicaltbody >tr >td {
    /*text-align: center;*/
}

.detail-pro {
    font-size: 16px;
    text-align: left;
    padding: 5px 10px;
    background: rgba(255, 229, 250, 0.5);
    border: 1px solid #d6d6d6;
}

.active-c {
    background: #b5ffb1;
}

.active-img {
    box-shadow: inset 0px 0px 18px #0079ff;
}

.well {
    padding: 0 !important;
}

.order_quantity_ {
    /*background: #F3F885 !important;*/
}

.select {
    border-color: #ad5ba1;
    background-color: #ffb400;
}

.select-row {
    border-color: #fd85ea;
    background-color: #f4fc71;
}

td {
    padding: 0 0 0 5px;
    word-break: break-all;
}

table thead tr th, table tbody tr td {
    border: 1px solid #9f9f9f !important;
}

@supports (-webkit-touch-callout: none) {
    /*/CSS specific to iOS devices */
    .search-button-ios {
        display: block !important;
    }

    #handy-navi {
        top: 235px !important;
    }

}

.image-div {
    width: 24%;
    position: relative;
}

.form-check-input_ {
    position: absolute;
    top: 0;
    right: 0;
    display: none;
}

.custom-img {
    width: 100%;
    margin: 5px;
    max-height: 310px !important;
}

.custom-img-preview {
    max-width: 98%;
    min-width: 60%;
    margin: 5px;
    max-height: 600px;
}

.top-button {
    padding: 5px 20px;
    font-size: 20px;
    font-weight: bold;
}

.header span {
    font-size: 24px;
}

.table-borderless {
    margin: 10px;
}

.table-borderless tbody tr td {
    border: none !important;
}

@media screen and (max-width: 420px) {
    .image-div {
        width: 33%;
        max-height: 130px;
    }

    .custom-img {
        width: 100%;
        margin: 3px 0px;
        height: auto;
    }

    .top-button {
        padding: 5px 10px;
        font-size: 16px;
    }

    .header span {
        font-size: 18px;
    }

    .custom-img-preview {
        min-width: 58%;
        max-width: 98%;
        margin: 5px;
        max-height: 500px;
    }

}

@media screen and (max-width: 351px) {
    .image-div {
        width: 50%;
    }

    .custom-img {
        width: 100%;
        margin: 3px 0px;
    }

    .top-button {
        padding: 5px;
        font-size: 13px;
    }

    .header span {
        font-size: 18px;
    }

    .custom-img-preview {
        min-width: 58%;
        max-width: 98%;
        margin: 5px;
        max-height: 500px;
    }

}

input[type="radio"], input[type="checkbox"] {
    width: 25px;
    height: 25px;
    margin: 0px 0px 0px -20px;
    cursor: pointer;
}
</style>
