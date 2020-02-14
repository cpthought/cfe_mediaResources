<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//receipt/header.php"; ?>
  <body>
    <div class="page-group">
    
    <form action="/receiptTrainItemDelDo" method="post"  id="itemDelete" >
    <input type="hidden" name="riidKey" id="riidKey" value="<?php echo $data['RItemDetail']['riidKey']; ?>">
    <input type="hidden" name="ridKey" id="ridKey" value="<?php echo $data['RItemDetail']['ridKey']; ?>">
    
        <div class="page page-current">
          <header class="bar bar-nav">
            <a class="icon icon-left pull-left" href="/receiptItemList/<?php echo $data['RItemDetail']['ridKey']; ?>.html" external></a>
            <h1 class="title holidayTBg">培训班支出</h1>
          </header>
          <div class="bar bar-footer">
            <div class="row" style="overflow: inherit;">
              <div class="col-100">
              <input type="button"   class="button button-block button-fill button-danger itemDelete" data-toggle="modal" value="移除">
               
             </div>
            </div>
          </div>
            <div class="content">
              <div class="content-block pLR-n">
        
                <div class="content-block-title"><?php echo $data['RItemDetail']['item']; ?></div>
                <div class="list-block">
                  <ul>
                    <li class="item-content">
                      <div class="item-inner">
                        <div class="item-title">金额</div>
                        <div class="item-after"><?php echo $data['RItemDetail']['price']; ?></div>
                      </div>
                    </li>
                    <li class="item-content">
                      <div class="item-inner">
                        <div class="item-title">经手人</div>
                        <div class="item-after"><?php echo $data['RItemDetail']['inputer']; ?></div>
                      </div>
                    </li>
                    <li class="item-content">
                      <div class="item-inner">
                        <div class="item-title">日期</div>
                        <div class="item-after"><?php echo $data['RItemDetail']['date']; ?></div>
                      </div>
                    </li>
                    <li class="item-content">
                      <div class="item-inner">
                        <div class="item-title">添加人/添加时间</div>
                        <div class="item-after"><?php echo $data['RItemDetail']['creater']; ?> <?php echo $data['RItemDetail']['creatDate']; ?></div>
                      </div>
                    </li>
                    <li class="item-content">
                      <div class="item-inner">
                        <div class="item-title">支出描述 </div>
                        <div class="item-after"><?php echo $data['RItemDetail']['describe']; ?></div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
        
        </form>
    </div>

  </body>
</html>