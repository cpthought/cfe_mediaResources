<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//mobile/holiday_header.php"; ?>
<style type="text/css">
    .infinite-scroll-preloader {
        margin-top:-20px;
    }
</style>
  <body>
    <div class="page-group">
        <div class="page page-current" id="page-infinite-scroll-bottom">
        	<header class="bar bar-nav">
              <h1 class="title holidayTBg">我的假条</h1>
          </header>
            <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//mobile/holiday_nav.php"; ?>
            <input type="hidden" id="thispage" value="<?php echo $data['onpage']; ?>">
            <input type="hidden" id="allpage" value="<?php echo $data['allpage']; ?>">
            <div class="content infinite-scroll infinite-scroll-bottom" data-distance="100">
                <div class="holidaylist">
                    <?php if( isset($data['holidaylist']) && !empty($data['holidaylist']) ): ?>
                    <?php foreach($data['holidaylist'] as $k1=>$v1): ?>
                    <div class="list-block media-list">
                        <ul>
                            <li>
                                <a href="http://m.cld.smartcost.com.cn/approvalholiday/<?php echo $v1['id']; ?>?gourl=list" class="item-link item-content">
                                    <div class="item-inner">
                                        <div class="item-title-row">
                                            <div class="item-title"><?php echo $v1['typename']; ?>【<?php echo $v1['daynum']; ?>天】</div>
                                            <div class="item-after"><?php if( $v1['status'] == 0 ): ?>审批中<?php elseif( $v1['status'] == 1 ): ?>同意<?php else: ?>不同意<?php endif; ?></div>
                                        </div>
                                        <div class="item-subtitle"><?php echo $v1['daymsg']; ?></div>
                                        <div class="item-text"><?php echo $v1['shortdescription']; ?></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php if( $data['allpage'] != 0 ): ?>
                <!-- 加载提示符 -->
                <div class="infinite-scroll-preloader">
                    <div class="preloader"></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
  <script>
      $(function () {
          //无限滚动
          $(document).on("pageInit", "#page-infinite-scroll-bottom", function (e, id, page) {
              var loading = false;
              var maxItems = $('#allpage').val();

              function addItems(page2) {
                  // 生成新条目的HTML
                  $.ajax({
                      type: 'post',
                      url: '/holidaylist/page',
                      data: {page: page2},
                      dataType: 'json',
                      success: function (data) {
                          $('#thispage').val(data.pagenum);
                          if (data.code == 200) {
                              var html = '';
                              $.each(data.result, function (k, v) {
                                  var status = '审批中';
                                  if (v.status == 1) {
                                      status = '同意';
                                  } else if (v.status == 2) {
                                      status = '不同意';
                                  }
                                  html += '<div class="list-block media-list"><ul><li><a href="http://m.cld.smartcost.com.cn/approvalholiday/' + v.id + '?gourl=list" class="item-link item-content"> <div class="item-inner"> <div class="item-title-row"> <div class="item-title">' + v.typename + '【' + v.daynum + '天】</div> <div class="item-after">' + status + '</div> </div> <div class="item-subtitle">'+ v.daymsg +'</div> <div class="item-text">' + v.shortdescription + '</div></div></a></li></ul></div>';
                              });
                              // 添加新条目
                              $('.infinite-scroll .holidaylist').append(html);
                          } else {
                              $.toast('数据已经加载到底啦');
                              // 加载完毕，则注销无限加载事件，以防不必要的加载
                              $.detachInfiniteScroll($('.infinite-scroll'));
                              // 删除加载提示符
                              $('.infinite-scroll-preloader').remove();
                          }
                      }
                  });
              }

              $(page).on('infinite', function () {
                  // 如果正在加载，则退出
                  if (loading) return;
                  // 设置flag
                  loading = true;
                  // 模拟1s的加载过程
                  setTimeout(function () {
                      // 重置加载flag
                      loading = false;
                      var page2 = $('#thispage').val();
                      if (page2 >= maxItems) {
                          $.toast('数据已经加载到底啦');
                          // 加载完毕，则注销无限加载事件，以防不必要的加载
                          $.detachInfiniteScroll($('.infinite-scroll'));
                          // 删除加载提示符
                          $('.infinite-scroll-preloader').remove();
                          return;
                      }
                      addItems(parseInt(page2) + 1);
                      // 更新最后加载的序号
                      $.refreshScroller();
                  }, 1000);
              });
          });
          $.init();
      });
  </script>
  </body>
</html>