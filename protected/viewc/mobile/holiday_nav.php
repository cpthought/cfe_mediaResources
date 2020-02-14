<nav class="bar bar-tab">
    <a class="tab-item external <?php if( $data['thispage'] == 'request' ): ?>active<?php endif; ?>" href="/request">
        <!-- <span class="icon icon-edit"></span> -->
        <span class="tab-label">请假申请</span>
    </a>
    <a class="tab-item external <?php if( $data['thispage'] == 'list'  || $data['thispage'] == 'unlist' ): ?>active<?php endif; ?>" href="/holidaylist">
        <!-- <span class="icon icon-me active"></span> -->
        <span class="tab-label">我的假条</span>
    </a>
    <?php if( $data['isapproval'] == 1 ): ?>
    <a class="tab-item external <?php if( $data['thispage'] == 'approval' || $data['thispage'] == 'unapproval' ): ?>active<?php endif; ?>" href="/holidayapprovallist">
        <!-- <span class="icon icon-menu"></span> -->
        <span class="tab-label">假条审批</span>
        <?php if( isset($data['approvalnum']) && !empty($data['approvalnum']) ): ?><span class="badge"><?php echo $data['approvalnum']; ?></span><?php endif; ?>
    </a>
    <?php endif; ?>
</nav>