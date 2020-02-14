<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//mobile/holiday_header.php"; ?>
<body>
<div class="page-group">
    <div class="page page-current" id="routerIndex">
        <header class="bar bar-nav">
            <!-- <a class="icon icon-me pull-left open-panel"></a> -->
            <h1 class="title holidayTBg">请假</h1>
        </header>
        <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//mobile/holiday_nav.php"; ?>
        <div class="content">
            <input type="hidden" id="nianjia" value="<?php echo $data['yearnum']; ?>">
            <input type="hidden" id="cunjia" value="<?php echo $data['addnum']; ?>">
            <input type="hidden" id="hunjia" value="<?php echo $data['hunjianum']; ?>">
            <input type="hidden" id="chanjia" value="<?php echo $data['chanjianum']; ?>">
            <input type="hidden" id="sangjia" value="<?php echo $data['sangjianum']; ?>">
            <input type="hidden" id="gongjia" value="<?php echo $data['gongjianum']; ?>">
            <p class="bg-danger" style="display: none" id="holidayshow">对不起，你没有<span>年假</span>！</p>
            <form action="/addrequest" method="post" onsubmit="return requestSubmit();">
                <input type="hidden" id="typenum" value="1" />
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content create-actions">
                                <div class="item-inner">
                                    <div class="item-title label">假期类型</div>
                                    <div class="item-input">
                                        <input id="holidaytypeshow" type="text" readonly="readonly" placeholder="假期类型 [ 事假 ]" value="事假">
                                        <input id="holidaytype" type="hidden" readonly="readonly" name="holidaytype" value="1">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="list-block" id="otherholiday" style="display: none">
                    <ul>
                        <li>
                            <div class="item-content create-actionsTwo">
                                <div class="item-inner">
                                    <div class="item-title label">其他假期</div>
                                    <div class="item-input">
                                        <input type="text" id="otherholidayshow" readonly="readonly" placeholder="其他假期 [ 调休 ]" value="调休">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="tabs">
                    <!-- 统一模板 -->
                    <div id="tab1" class="tab active">
                        <div class="content-block-title"><span class="tabtitle">事假</span>详情</div>
                        <div class="list-block">
                            <ul>
                                <li class="align-top">
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label"><span class="tabtitle">事假</span>原因</div>
                                            <div class="item-input">
                                                <textarea class="myinput" name="reason" placeholder="请输入内容"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="haveholidaynum" style="display: none;">
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">可用<span class="holidayname"></span></div>
                                            <div class="item-input">
                                                <input type="text" id="holidaynum" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label"><span class="tabtitle">事假</span>时间</div>
                                            <div class="item-input">
                                                <input data-popup=".popup-about" class="open-popup datenote" readonly="readonly" type="text" placeholder="请选择日期">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">合计天数</div>
                                            <div class="item-input">
                                                <input type="number" placeholder="合计天数" class="holidaynum" readonly step="0.1" name="num">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="content-block-title datelistdiv" style="display:none;"><span class="tabtitle">事假</span>日期列表</div>
                        <div class="list-block datelistdiv" style="display:none;">
                            <ul class="datelist">

                            </ul>
                        </div>
                    </div>
                    <!-- 年假模板 -->
                    <div id="tab5" class="tab">
                        <div class="content-block-title">年假详情</div>
                        <div class="list-block">
                            <ul>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">可用年假</div>
                                            <div class="item-input">
                                                <input type="text" value="你的年假 <?php echo $data['yearnum']; ?> 天" readonly disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">年假周期</div>
                                            <div class="item-input">
                                                <input type="text" value="截止至 <?php echo $data['yearday']; ?>" readonly disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">年假时间</div>
                                            <div class="item-input">
                                                <input data-popup=".popup-about5" class="open-popup datenote5" readonly="readonly" disabled="true" type="text" placeholder="请选择日期">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">合计天数</div>
                                            <div class="item-input">
                                                <input type="number" placeholder="合计天数" class="holidaynum5" disabled="true" readonly step="0.1" name="num">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="content-block-title datelistdiv5" style="display:none;">年假日期列表</div>
                        <div class="list-block datelistdiv5" style="display:none;">
                            <ul class="datelist5">

                            </ul>
                        </div>
                    </div>
                    <!--调休模板-->
                    <div id="tab2" class="tab">
                        <div class="list-block">
                            <ul>
                                <li class="align-top">
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">调休原因</div>
                                            <div class="item-input">
                                                <textarea class="myinput tiaoxiureason" name="reason" disabled="true" placeholder="请输入内容"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="list-block">
                            <div class="content-block-title">休假时间</div>
                            <ul>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">休假时间</div>
                                            <div class="item-input">
                                                <input data-popup=".popup-about2" class="open-popup datenote2" readonly="readonly" type="text" placeholder="请选择日期" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">合计天数</div>
                                            <div class="item-input">
                                                <input type="number" placeholder="合计天数" class="holidaynum2" readonly step="0.1" name="num2" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="content-block-title datelistdiv2" style="display:none;">休假日期列表</div>
                        <div class="list-block datelistdiv2" style="display:none;">
                            <ul class="datelist2">

                            </ul>
                        </div>
                        <div class="list-block">
                            <div class="content-block-title">加班时间</div>
                            <ul>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">加班时间</div>
                                            <div class="item-input">
                                                <input data-popup=".popup-about3" class="open-popup datenote3" readonly="readonly" type="text" placeholder="请选择日期" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">合计天数</div>
                                            <div class="item-input">
                                                <input type="number" placeholder="合计天数" class="holidaynum3" readonly step="0.1" name="num3" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="content-block-title datelistdiv3" style="display:none;">加班日期列表</div>
                        <div class="list-block datelistdiv3" style="display:none;">
                            <ul class="datelist3">

                            </ul>
                        </div>
                    </div>
                    <!--长假模板-->
                    <div id="tab3" class="tab">
                        <div class="content-block-title"><span class="tabtitle">婚假</span>详情</div>
                        <div class="list-block">
                            <ul>
                                <li class="align-top">
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label"><span class="tabtitle">婚假</span>原因</div>
                                            <div class="item-input">
                                                <textarea class="myinput" id="longholidayreason" name="reason" placeholder="请输入内容" disabled="true"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">可用假期</div>
                                            <div class="item-input">
                                                <input type="text" id="othernumshow" value="你的假期XX天" readonly disabled="true">
                                                <input type="hidden" id="othernum" value="" readonly disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">开始时间</div>
                                            <div class="item-input">
                                                <input type="text" id="starttime" data-popup=".popup-about4" class="open-popup datenote4" disabled="true" name="starttime" readonly="readonly" placeholder="开始时间">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">结束时间</div>
                                            <div class="item-input">
                                                <input type="text" id="endtime" data-popup=".popup-about4" class="open-popup datenote4" disabled="true" name="endtime" readonly="readonly" placeholder="结束时间">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">合计天数</div>
                                            <div class="item-input">
                                                <input type="number" disabled="true" readonly name="num" step="0.1" class="holidaynum4" placeholder="合计天数">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-block">
                    <ul>
                        <li>
                            <a class="formlabel" href="#routerapprover">
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">审批人</div>
                                        <div class="item-input">
                                            <input type="text" readonly="readonly" placeholder="请选择" class="approvershow">
                                            <input type="hidden" name="approver" class="approver">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="content-block">
                    <!--				<p><button class="button button-fill button-big holidayBtn">提交申请</button></p>-->
                    <!--				<p><button type="submit" class="button button-fill button-big holidayBtn holidayBtnGray" disabled>提交申请</button></p>-->
                    <p><button type="submit" class="button button-fill button-big holidayBtn" style="width:100%;">提交申请</button></p>
                </div>
            </form>
        </div>
    </div>
    <div class="page" id="routerapprover">
        <header class="bar bar-nav">
            <!--<a href="holidayIndexDetail.html" class="pull-left open-panel"><span class="icon icon-left fL"></span></a>-->
            <a class="button button-link button-nav pull-left back" href="/request"><span class="icon icon-left"></span></a>
            <h1 class="title">选择审批人</h1>
        </header>
        <nav class="bar bar-tab">
            <a href="javascript:;" class="tab-item external active" onclick="return getapproval();">
                <span class="tab-label">提交</span>
            </a>
        </nav>
        <div class="content">
            <div class="list-block media-list">
                <ul>
                    <?php if( !empty($data['acmanlist']) ): ?>
                    <?php foreach($data['acmanlist'] as $k1=>$v1): ?>
                    <li>
                        <label class="label-checkbox item-content">
                            <input type="radio" name="my-radio" value="<?php echo $v1['id']; ?>">
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title"><?php echo $v1['typename']; ?></div>
                                    <!-- <div class="item-after">17:14</div> -->
                                </div>
                                <!-- <div class="item-subtitle">通用组</div> -->
                                <div class="item-text"><?php echo $v1['name']; ?></div>
                            </div>
                        </label>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--统一模板-->
<div class="popup popup-aboutTime popup-about">
    <div class="content-block m-0">
        <p>请选择申请日期</p>
        <div class="datepicker-here" id="datepicker-here" data-language='zh' data-multiple-dates="10"></div>
        <input type="hidden" id="selectdate" />
        <div class="row p-1">
            <div class="col-50"><a href="javascript:;" class="button button-fill btnGray btnSelf close-popup">取消</a></div>
            <div class="col-50"><a href="javascript:;" id="getholidayday" class="button button-fill btnSelf" onclick="return getholidayday('');">提交</a></div>
        </div>
    </div>
</div>
<!--年假模板-->
<div class="popup popup-aboutTime popup-about5">
    <div class="content-block m-0">
        <p>请选择申请日期</p>
        <div class="datepicker-here" id="datepicker-here5" data-language='zh' data-multiple-dates="10"></div>
        <input type="hidden" id="selectdate5" />
        <div class="row p-1">
            <div class="col-50"><a href="javascript:;" class="button button-fill btnGray btnSelf close-popup">取消</a></div>
            <div class="col-50"><a href="javascript:;" id="getholidayday5" class="button button-fill btnSelf" onclick="return getholidayday(5);">提交</a></div>
        </div>
    </div>
</div>
<!--调休模板-->
<div class="popup popup-aboutTime popup-about2">
    <div class="content-block m-0">
        <p>请选择开始日期</p>
        <div class="datepicker-here" id="datepicker-here2" data-language='zh' data-multiple-dates="10"></div>
        <input type="hidden" id="selectdate2" />
        <div class="row p-1">
            <div class="col-50"><a href="javascript:;" class="button button-fill btnGray btnSelf close-popup">取消</a></div>
            <div class="col-50"><a href="javascript:;" id="getholidayday2" class="button button-fill btnSelf" onclick="return getholidayday(2);">提交</a></div>
        </div>
    </div>
</div>
<div class="popup popup-aboutTime popup-about3">
    <div class="content-block m-0">
        <p>请选择结束日期</p>
        <div class="datepicker-here" id="datepicker-here3" data-language='zh' data-multiple-dates="10"></div>
        <input type="hidden" id="selectdate3" />
        <div class="row p-1">
            <div class="col-50"><a href="javascript:;" class="button button-fill btnGray btnSelf close-popup">取消</a></div>
            <div class="col-50"><a href="javascript:;" id="getholidayday3" class="button button-fill btnSelf" onclick="return getholidayday(3);">提交</a></div>
        </div>
    </div>
</div>
<!--长假模板-->
<div class="popup popup-aboutTime popup-about4">
    <div class="content-block m-0">
        <p>请选择开始日期与结束日期</p>
        <div class="datepicker-here" id="datepicker-here4" data-language='zh' data-range="true"></div>
        <input type="hidden" id="selectdate4" />
        <div class="row p-1">
            <div class="col-50"><a href="javascript:;" class="button button-fill btnGray btnSelf close-popup">取消</a></div>
            <div class="col-50"><a href="javascript:;" id="getholidayday4" class="button button-fill btnSelf" onclick="return setstartandendday();">提交</a></div>
        </div>
    </div>
</div>
<script>
    function getapproval(){
        var val = $('input[name="my-radio"]:checked').val();
        if(val==null){
            $.toast('请先选择审批组');
            return false;
        }else{
            $('.approvershow').val($('input[name="my-radio"]:checked').siblings('.item-inner').children('.item-title-row').children('.item-title').text());
            $('.approver').val(val);
//			return true;
            $.router.back();
        }
    }
    jQuery('#datepicker-here').datepicker({
        minDate:new Date(),
        onSelect: function(dates){

            if(dates != ''){
                $('#getholidayday').addClass('close-popup');
            }else{
                $('#getholidayday').removeClass('close-popup');
            }
            $('#selectdate').val(dates);
        }
    });
    jQuery('#datepicker-here5').datepicker({
        minDate:new Date(),
        maxDate:new Date(Date.parse('<?php echo $data['yearday']; ?>'.replace(/-/g, "/"))),
        onSelect: function(dates){
            if(dates != ''){
                $('#getholidayday5').addClass('close-popup');
            }else{
                $('#getholidayday5').removeClass('close-popup');
            }
            $('#selectdate5').val(dates);
        }
    });
    jQuery('#datepicker-here2').datepicker({
        minDate:new Date(),
        onSelect: function(dates){
            if(dates != ''){
                $('#getholidayday2').addClass('close-popup');
            }else{
                $('#getholidayday2').removeClass('close-popup');
            }
            $('#selectdate2').val(dates);
        }
    });
    jQuery('#datepicker-here3').datepicker({
        minDate:new Date(),
        onSelect: function(dates){
            if(dates != ''){
                $('#getholidayday3').addClass('close-popup');
            }else{
                $('#getholidayday3').removeClass('close-popup');
            }
            $('#selectdate3').val(dates);
        }
    });
    jQuery('#datepicker-here4').datepicker({
        <?php if( $data['hunjianum'] == 0 && $data['chanjianum'] == 0 && $data['sangjianum'] == 0 && $data['gongjianum'] == 0 ): ?>
        minDate: new Date(Date.parse('2017-03-08'.replace(/-/g, "/"))),
        maxDate: new Date(Date.parse('2017-03-07'.replace(/-/g, "/"))),
        <?php endif; ?>
        onSelect: function(dates,value,picker){
            if(dates != ''){
                var othernum = $('#othernum').val();
                if(othernum != 0){
                    $('#getholidayday4').addClass('close-popup');
                    var datelist = dates.split(',');
                    if(othernum == 1){
                        $.toast('您只有一天假期,不用再选了');
                        picker.update({
                            minDate: new Date(Date.parse(datelist[0].replace(/-/g, "/"))),
                            maxDate: new Date(Date.parse(datelist[0].replace(/-/g, "/")))
                        });
                    }else{
                        if(datelist[1] == null){
                            var mind = countDate(datelist[0],-(othernum-1));
                            var maxd = countDate(datelist[0],(othernum-1));
                            picker.update({
                                minDate: new Date(Date.parse(mind.replace(/-/g, "/"))),
                                maxDate: new Date(Date.parse(maxd.replace(/-/g, "/")))
                            });
                        }else{
                            if(getDays(datelist[0],datelist[1])+1 > othernum){
                                $.toast('您选择的日期超过了'+othernum+'天');
                                $('#getholidayday4').removeClass('close-popup');
                            }
                            picker.update({
                                minDate: '',
                                maxDate: ''
                            });
                        }
                    }
                }else{
                    $.toast('您当前没有假期');
                    $('#getholidayday4').removeClass('close-popup');
                }
            }else{
                picker.update({
                    minDate: '',
                    maxDate: ''
                });
                $('#getholidayday4').removeClass('close-popup');
            }
            $('#selectdate4').val(dates);
        }
    });

    //计算两个日期天数差
    function getDays(strDateStart,strDateEnd){
        var strSeparator = "-"; //日期分隔符
        var oDate1;
        var oDate2;
        var iDays;
        oDate1= strDateStart.split(strSeparator);
        oDate2= strDateEnd.split(strSeparator);
        var strDateS = new Date(oDate1[0], oDate1[1]-1, oDate1[2]);
        var strDateE = new Date(oDate2[0], oDate2[1]-1, oDate2[2]);
        iDays = parseInt(Math.abs(strDateS - strDateE ) / 1000 / 60 / 60 /24)//把相差的毫秒数转换为天数
        return iDays ;
    }

    //日期加减
    function countDate(date,days){
        var d=new Date(Date.parse(date.replace(/-/g, "/")));
        d.setDate(d.getDate()+days);
        var m=d.getMonth()+1;
        return d.getFullYear()+'-'+m+'-'+d.getDate();
    }

    function setstartandendday(){
        if($('#othernum').val() != 0){
            if($('#selectdate4').val() == ''){
                $.toast('请选择开始和结束日期');
                return false;
            }
            var datelist = $('#selectdate4').val().split(',');
            if(datelist[1] == null){
                $('#starttime').val(datelist[0]+' 08:30');
                $('#endtime').val(datelist[0]+' 18:00');
                $('.holidaynum4').val(1);
            }else{
                var countnum = getDays(datelist[0],datelist[1])+1;
                if(countnum > $('#othernum').val()){
                    $.toast('您选择的日期超过了'+$('#othernum').val()+'天');
                    return false;
                }
                $('#starttime').val(datelist[0]+' 08:30');
                $('#endtime').val(datelist[1]+' 18:00');
                $('.holidaynum4').val(countnum);
            }
        }else{
            $.toast('您当前没有假期');
            return false;
        }
    }

    function getholidayday(num){
        if($('#selectdate'+num).val() == ''){
            $.toast('请选择日期');
            return false;
        }else{
            $('.datelist'+num).html('');
            $('.datelistdiv'+num).show();
            var datelist = $('#selectdate'+num).val().split(',');
            $('.holidaynum'+num).val(datelist.length);
            var html = '';
            $.each(datelist, function(k,v){
                html += '<li><input name="holidayday'+num+'[]" type="checkbox" hidden value="'+v+'_1" class="holidayday" checked="checked" /><div class="item-content"><div class="item-inner"><div class="item-title label">'+v+'</div><div class="item-input"><div class="row"><div class="col-50"><span class="dayname">上午</span>&nbsp;&nbsp;<label class="label-switch labelcheckbox'+num+'"><input type="checkbox" value="2" checked="checked"><div class="checkbox"></div></label></div><div class="col-50"><span class="dayname">下午</span>&nbsp;&nbsp;<label class="label-switch labelcheckbox'+num+'"><input type="checkbox" value="3" checked="checked"><div class="checkbox"></div></label></div></div></div></div></div></li>';
            });
            $('.datelist'+num).append(html);
            $('.datenote'+num).val('你的申请时间如下');
        }
        $('.labelcheckbox'+num).on('click',function(e){
            if($(e.target).is('input')){
                return;
            }
            var msg = $(this).children("input[type='checkbox']");
            var brothermsg = $(this).parents('.col-50').siblings('.col-50').children('.label-switch').children("input[type='checkbox']");
            var day = $(this).parents('.item-inner').children('.item-title').text();
            var dayname = $(this).parents('.col-50').children('.dayname').text();
            if(msg.is(':checked')){
                $.toast('您取消了'+dayname+'时间');
                $('.holidaynum'+num).val(Number($('.holidaynum'+num).val())-0.5);
                if(brothermsg.is(':checked')){
                    $(this).parents('li').children('.holidayday').val(day+'_'+brothermsg.val());
                }else{
                    $(this).parents('li').children('.holidayday').val(day+'_0');
                }
            }else{
                $.toast('您选择了'+dayname+'时间');
                $('.holidaynum'+num).val(Number($('.holidaynum'+num).val())+0.5);
                if(brothermsg.is(':checked')){
                    $(this).parents('li').children('.holidayday').val(day+'_1');
                }else{
                    $(this).parents('li').children('.holidayday').val(day+'_'+msg.val());
                }
            }
        })
    }

    function requestSubmit(){
        if($('#typenum').val() == 1){
            if($('#holidaytype').val() != 12){
                if($('textarea[name="reason"]').val() == ''){
                    $.toast('请填写原因');
                    return false;
                }

                if($('input[name="num"]').val() == 0 || $('input[name="num"]').val() == ''){
                    $.toast('请选择日期');
                    return false;
                }
            }else{
                if($('.holidaynum5').val() == 0 || $('.holidaynum5').val() == ''){
                    $.toast('请选择日期');
                    return false;
                }

                if(parseFloat($('#nianjia').val()) < parseFloat($('.holidaynum5').val())){
                    $.toast('您的年假不足');
                    return false;
                }
            }

            if($('#holidaytype').val() == 10){
                if(parseFloat($('#cunjia').val()) < parseFloat($('input[name="num"]').val())){
                    $.toast('您的存假不足');
                    return false;
                }
            }

        }else if($('#typenum').val() == 2){
            if($('.tiaoxiureason').val() == ''){
                $.toast('请填写原因');
                return false;
            }
            if($('input[name="num2"]').val() == 0 || $('input[name="num2"]').val() == ''){
                $.toast('请选择休假日期');
                return false;
            }
            if($('input[name="num3"]').val() == 0 || $('input[name="num3"]').val() == ''){
                $.toast('请选择加班日期');
                return false;
            }
            if($('input[name="num2"]').val() != $('input[name="num3"]').val()){
                $.toast('请保持休加班天数一致');
                return false;
            }
        }else if($('#typenum').val() == 3){
            if($('#longholidayreason').val() == ''){
                $.toast('请填写原因');
                return false;
            }
            if($('#starttime').val() == ''){
                $.toast('请选择开始时间');
                return false;
            }
            if($('#endtime').val() == ''){
                $.toast('请选择结束时间');
                return false;
            }
            if(parseFloat($('.holidaynum4').val()) > parseFloat($('#othernum').val())){
                $.toast('您的假期不足');
                return false;
            }
        }

        if($('input[name="approver"]').val() == ''){
            $.toast('请选择审批组');
            return false;
        }
    }
</script>
</body>
</html>