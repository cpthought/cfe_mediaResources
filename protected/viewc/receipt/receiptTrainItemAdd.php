<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//receipt/header.php"; ?>
<script type='text/javascript' src='/ajaxGetRelevantReceipt/<?php echo $data['now']; ?>.js' charset='utf-8'></script>
<script >
$(function() {

	$("#Ritem").picker({
		  toolbarTemplate: '<header class="bar bar-nav">\
		  <button class="button button-link pull-right close-picker">确定</button>\
		  <h1 class="title">请选择</h1>\
		  </header>',
		  cols: [
		    {
		      textAlign: 'center',
		      values: item
		    }
		  ]
		});
	
	
	$("#trainItemAdd").submit(function(e){
		var Ritem=$('#Ritem').val();
		var price=$('#price').val();
		var date=$('#date').val();
		var inputer=$('#inputer').val();
		
		if(Ritem==""){
			$.alert('请选择支出项');
			return false;
		}
		
		if(price==""){
			$.alert('请填写支出金额');
			return false;
		}
		if(date==""){
			$.alert('请选择时间');
			return false;
		}
		if(inputer==""){
			$.alert('请填写经手人');
			return false;
		}
		
	});
	
	
// $(document).on('click','.Ritem', function () {
// 	      var buttons1 = [
// 	        {
// 	          text: '请选择',
// 	          label: true,
// 	        },
// 	        {
// 	          text: '增值税普通发票',
// 	          bold: true,
// 	          onClick: function() {
// //	        	  $('#plainInvoice_box').show();
// //	         	 $('#specialInvoice_box').hide();
// //	         	$('#invoiceTypeName').val('增值税普通发票');
// //	         	$('#invoiceType').val(0);
// 	            }
// 	        },
// 	        {
// 	          text: '增值税专用发票',
// 	          onClick: function() {
// //	        	  $('#plainInvoice_box').hide();
// //	         	 $('#specialInvoice_box').show();
// //	         	$('#invoiceTypeName').val('增值税专用发票');
// //	         	$('#invoiceType').val(1);
// 	            }
// 	        }
// 	      ];
// 	      var buttons2 = [
// 	        {
// 	          text: '取消',
// 	        }
// 	      ];
// 	      var groups = [buttons1, buttons2];
// 	      $.actions(groups);
// 	  });

	
})
</script>
  <body>
    <div class="page-group">
        <div class="page page-current">
          <header class="bar bar-nav">
              <a class="icon icon-left pull-left" href="/receiptItemList/<?php echo $data['ridKey']; ?>.html" external></a>
              <h1 class="title holidayTBg">支出信息填写</h1>
          </header>
            <div class="content">
            
            <form action="/receiptTrainItemAddDo" method="post"  id="trainItemAdd"  >
            <input type="hidden" name="ridKey" id="ridKey" value="<?php echo $data['ridKey']; ?>">
              <div class="content-block pLR-n">
                <div class="list-block">
                <ul>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">项目</div>
                        <div class="item-input">
                          <input type="text" readonly="readonly" name="item" id="Ritem" class="Ritem" placeholder="请选择项目">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">支出金额</div>
                        <div class="item-input">
                          <input type="text" placeholder="必填" name="price"  id="price">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">日期</div>
                        <div class="item-input">
                          <input type="date" id="date" name="date" >
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">经手人</div>
                        <div class="item-input">
                          <input type="text" placeholder="必填" name="inputer"  id="inputer">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="item-content align-top">
                      <div class="item-inner">
                        <div class="item-title label">支出描述</div>
                        <div class="item-input">
                          <textarea placeholder="描述内容" name="describe"  id="describe"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              </div>
              <div class="content-block">
                <div class="row">
                  <div class="col-50">
<a href="/receiptItemList/<?php echo $data['ridKey']; ?>.html" external class="button button-big button-fill button-danger">取消</a></div>
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