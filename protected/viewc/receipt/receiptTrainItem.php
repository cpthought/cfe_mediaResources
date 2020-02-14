<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//receipt/header.php"; ?>

  <body>
    <div class="page-group">
        <div class="page page-current">
          <header class="bar bar-nav">
              <a class="icon icon-left pull-left" href="/myReceiptTrain"></a>
              <h1 class="title holidayTBg">培训班支出</h1>
          </header>
          <div class="bar bar-header-secondary">
            <div class="row" style="overflow: inherit;">
              <div class="col-50">
                <select id="priority" data="<?php echo $data['detail']['ridKey']; ?>" class="button button-block">
                 <?php foreach($data['aiList'] as $k1=>$v1): ?>
								<?php if( $v1['name']!='讲课费' ): ?>
								<option <?php if( $v1['name']==$data['name'] ): ?> selected <?php endif; ?>   value='<?php echo $v1['name']; ?>'><?php echo $v1['name']; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
                </select>
              </div>
              <div class="col-50">
                <button id="timeMachine" data="<?php echo $data['detail']['ridKey']; ?>" class="button button-block">
                  按照添加时间</button>
              </div>
            </div>
          </div>
          <div class="bar bar-footer-secondary">
            <a class="button button-block button-fill button-big" href="invoiceTrainExpensesAdd.html">添加支出</a>
          </div>
            <div class="content">
              <div class="content-block pLR-n">
                <div class="content-block">
                  <div><?php echo $data['receiptTrainingDetail']['trainName']; ?></div>
                </div>
                
                <?php foreach($data['RItemList'] as $k1=>$v1): ?>
                <div class="list-block media-list">
                  <ul>
                    <li>
                      <a href="invoiceTrainExpensesDetails.html" class="item-link item-content">
                        <div class="item-inner">
                          <div class="item-title-row">
                            <div class="item-title"><?php echo $v1['item']; ?></div>
                            <div class="item-after"><?php echo $v1['price']; ?></div>
                          </div>
                          <div class="item-subtitle"><?php echo $v1['creater']; ?>/<?php echo $v1['creatDate']; ?></div>
                          <div class="item-text"><?php echo $v1['describe']; ?></div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <?php endforeach; ?>
                
                
                
              </div>
            </div>
        </div>
    </div>

       
  </body>
</html>