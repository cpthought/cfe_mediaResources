<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//receipt/header.php"; ?>
  <body>
    <div class="page-group">
        <div class="page page-current">
          <header class="bar bar-nav">
              <h1 class="title holidayTBg">选择培训班</h1>
          </header>
            <div class="content">
            <?php foreach($data['receiptList'] as $k1=>$v1): ?>
              <div class="card">
                <div class="card-content">
                  <div class="list-block">
                    <ul>
                      <li>
                        <a href="/receiptItemList/<?php echo $v1['ridKey']; ?>.html" external class="item-link item-content">
                          <div class="item-media"><i class="icon icon-f7"></i></div>
                          <div class="item-inner">
                            <div class="item-title item-titleName"><?php echo $v1['trainName']; ?></div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
               <?php foreach($data['receiptExtendList'] as $k1=>$v1): ?>
              <div class="card">
                <div class="card-content">
                  <div class="list-block">
                    <ul>
                      <li>
                        <a href="/receiptItemList/<?php echo $v1['ridKey']; ?>.html" external class="item-link item-content">
                          <div class="item-media"><i class="icon icon-f7"></i></div>
                          <div class="item-inner">
                            <div class="item-title item-titleName"><?php echo $v1['trainName']; ?></div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
              
            </div>
        </div>
    </div>

       
  </body>
</html>