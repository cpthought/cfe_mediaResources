<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//videoLibrary/header.php"; ?>
<script type='text/javascript' src='/ajaxGetRelevantInvoice/<?php echo $data['now']; ?>.js' charset='utf-8'></script>
<script type='text/javascript' src='<?php echo  WEB_SITE_GLOBAL  ?>js/invoice.js?1.02' charset='utf-8'></script>

  <body>
    <div class="page-group">
        <div class="page page-current">
          <header class="bar bar-nav">
            <a class="icon icon-left pull-left" href="/invoice"></a>
            <h1 class="title holidayTBg">申请开票</h1>
          </header>
            <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//videoLibrary/invoiceNav.php"; ?>
            <div class="content">
            <form action="/invoiceAddDo" method="post"  id="invoiceAdd"  >
            
            <input type="hidden" name="invoiceType" id="invoiceType" value="0">
           <input type="hidden" name="doPost"  id="doPost" value="1">
            
              <div class="list-block">
                <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">发票类型</div>
                        <div class="item-input">
                          <input type="text" readonly="readonly" id="invoiceTypeName" value="增值税普通发票" class="invoiceType" placeholder="增值税普通发票">
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>

              <div class="list-block" >
                <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-input">
                          <p id="smart-msg">发票内容粘贴，自动识别信息</p>
                          <textarea placeholder="识别填写的顺序：单位 识别码 地址 电话 开户银行 账户" node-smart=invoiceValue class="textarea-bor"></textarea>
                          <div class="btn-wrap clearfix">
                            <a href="javascript:void(0)" node-clear=invoiceValue class="button button-big button-light btn-regular">清空</a>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              
              <div class="list-block" id="plainInvoice_box">
                <ul>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">发票抬头</div>
                        <div class="item-input">
                          <textarea name="invoiceTitle" id="invoiceTitle" ></textarea>
                          
                        </div>
                      </div>
                    </div>
                  </li>
                  
                  
                  
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">纳税人识别码</div>
                        <div class="item-input">
                          <input type="text" name="TINT" id="TINT" autoIFBTIN placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">注册地址</div>
                        <div class="item-input">
                          <textarea name="addressT" id="addressT"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">注册电话</div>
                        <div class="item-input">
                          <input type="text" name="phoneT" id="phoneT" placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">开户银行</div>
                        <div class="item-input">
                          <textarea name="bankT" id="bankT"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">银行账户</div>
                        <div class="item-input">
                          <input type="text" name="bankAccountT"  id="bankAccountT" placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">发票备注</div>
                        <div class="item-input">
                        <textarea name="remarkT" id="remarkT" placeholder="用于发票右下角备注栏内容，如项目名称、项目地点"></textarea>
                          
                        </div>
                      </div>
                    </div>
                  </li>
                  
                </ul>
              </div>
              
              <div class="list-block" id="specialInvoice_box"  style="display:none" >
                <ul>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">单位名称</div>
                        <div class="item-input">
                          <textarea name="invoiceCompany" id="invoiceCompany"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">纳税人识别码</div>
                        <div class="item-input">
                          <input type="text" name="TIN" id="TIN" placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">注册地址</div>
                        <div class="item-input">
                          <textarea name="address" id="address"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">注册电话</div>
                        <div class="item-input">
                          <input type="text" name="phone" id="phone" placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">开户银行</div>
                        <div class="item-input">
                          <textarea name="bank" id="bank"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">银行账户</div>
                        <div class="item-input">
                          <input type="text" name="bankAccount"  id="bankAccount" placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">备注</div>
                        <div class="item-input">
                        <textarea name="remark" id="remark" placeholder="用于发票右下角备注栏内容，如项目名称、项目地点"></textarea>
                          
                        </div>
                      </div>
                    </div>
                  </li>
                  
                </ul>
              </div>
                          
              
              <div class="content-block-title">发票详情</div>
              <div class="list-block">
                <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">所在办事处</div>
                        <div class="item-input">
                          <input type="text" name="cid" readonly="readonly" id='pickerOffice' value="" placeholder="请选择您的办事处"/>
                        </div>
                      </div>
                    </div>
                  </li>
                 
                  
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">数量</div>
                        <div class="item-input">
                          <input type="number" name="invoiceQuantity" id="invoiceQuantity" placeholder="必填" min="1" value="1">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">单价</div>
                        <div class="item-input">
                          <input type="text" name="invoiceUnitPrice" id="invoiceUnitPrice" placeholder="必填">
                        </div>
                      </div>
                    </div>
                  </li>
                  
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">开票金额</div>
                        <div class="item-input">
                          <input type="text" id='tp' disabled placeholder="数量*单价=开票金额" value=''>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">开票内容</div>
                        <div class="item-input">
                          <input type="text" readonly="readonly" name="invoiceElement" value="" id='pickerInvoice' placeholder="请选择开票内容">
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              
              <div class="content-block-title">结算方式</div>
              <div class="list-block">
                <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">结算方式</div>
                        <div class="item-input">
                          <input type="text" readonly="readonly" name='settlementType' id='settlementType' value="软件销售" class="invoiceaccounts" placeholder="请选择结算方式">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li training_li style="display:none">
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">培训班名称</div>
                        <div class="item-input">
                        
                        <select name='trainId' id='trainId' >
									<?php foreach($data['itList'] as $k1=>$v1): ?>
									<option value="<?php echo $v1['itidKey']; ?>"><?php echo $v1['trainDate']; ?>&nbsp;<?php echo $v1['trainName']; ?></option>
									<?php endforeach; ?>
									</select>
                        
                        
                        
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              
              <div class="content-block-title">邮寄信息</div>
              <div class="list-block">
                <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">是否邮寄</div>
                        <div class="item-input">
                          <input type="text" readonly="readonly" id="doPostName" value="是" class="invoiceMail" placeholder="选择是否邮寄">
                        </div>
                      </div>
                    </div>
                  </li>
                  </ul>
                  </div>

                  <div id="mail_box">

                    <div class="list-block">
                <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-input">
                          <p>粘贴整段地址，识别地址、电话和姓名</p>
                          <textarea placeholder="识别填写的顺序：地址 电话 姓名" node-smart='addressValue' class="textarea-bor"></textarea>
                          <div class="btn-wrap clearfix">
                            <a href="javascript:void(0)" node-clear=address class="button button-big button-light btn-regular">清空</a>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
                  
                  <div class="list-block"  >
                  <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">收件人</div>
                        <div class="item-input">
                          <input type="text" name="recipients" id="recipients" placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">手机/电话</div>
                        <div class="item-input">
                          <input type="text" name="recipientsPhone" id="recipientsPhone" placeholder="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">收件地址</div>
                        <div class="item-input">
                          <textarea name="recipientsAddress" id="recipientsAddress"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                  </ul>
              </div>
                
                  <div class="list-block">
                <ul>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">邮寄物品</div>
                        <div class="item-input">
                        	
                        	
                          <label class="label-checkbox item-content">
                            <input type="checkbox" name="softLock" value="1">
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                              <div class="item-subtitle">
                                <span class="item-input-title">软件锁</span>
                              </div>
                            </div>
                          </label>
                          <div class="gw_num">
                            <em class="jian">-</em>
                            <input type="text" value="1" name="softLockNum" class="num"/>
                            <em class="add">+</em>
                          </div>
                          <label class="label-checkbox item-content">
                            <input type="checkbox" name="my-checkbox" checked disabled>
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                              <div class="item-subtitle">发票<span class="ml-4">1</span></div>
                            </div>
                          </label>
                          
                          <label class="label-checkbox item-content">
                            <input type="checkbox" name="contract" value="1">
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                              <div class="item-subtitle">
                                <span class="item-input-title">合同</span>
                              </div>
                            </div>
                          </label>
                          <div class="gw_num">
                            <em class="jian">-</em>
                            <input type="text" value="1" name="contractNum" class="num"/>
                            <em class="add">+</em>
                          </div>
                          <label class="label-checkbox item-content">
                            <input type="checkbox" name="instructions" value="1">
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                              <div class="item-subtitle">
                                <span class="item-input-title">说明书</span>
                              </div>
                            </div>
                          </label>
                          <div class="gw_num">
                            <em class="jian">-</em>
                            <input type="text" value="1" name="instructionsNum" class="num"/>
                            <em class="add">+</em>
                          </div>
                          <label class="label-checkbox item-content">
                            <input type="checkbox" name="remittance" value="1">
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                              <div class="item-subtitle">汇款账单号</div>
                            </div>
                          </label>
                          <label class="label-checkbox item-content">
                            <input type="checkbox" name="my-checkbox" checked disabled>
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                              <div class="item-subtitle height7">备注 <textarea name="mailItems"  placeholder="备注信息或其他需要邮寄物品请填写在这，写明数量。"></textarea>
                            </div>
                          </label>
                        
                         
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              
              </div>
              
              
              <div class="content-block">
                <div class="row">
                  <div class="col-50"><a href="/invoice" class="button button-big button-fill button-danger">取消</a></div>
                  <div class="col-50">
                  <input type="submit"  class="button button-big button-fill button-success" data-toggle="modal" value="提交">
                  </div>
                </div>
              </div>
              </form>
              
            </div>
        </div>
    </div>

       
  </body>
</html>