
<nav class="bar bar-tab" >
	<a
		class="tab-item external <?php if( $data['nav'] == 'videoLibrary'): ?>active<?php endif; ?> "
		href="/invoice"> <!-- <span class="icon icon-edit"></span> --> <span
		class="tab-label">我的发票</span>
	</a> 
	<a 
	class="tab-item external <?php if( $data['nav'] == 'invoiceReceivables'  ): ?>active<?php endif; ?> "
		href="/invoiceMyReceivables"> <!-- <span class="icon icon-me"></span> -->
		<span class="tab-label">我的收款</span> 
		<?php if( !empty(ascriptionQuantity($data['staff']['0']['cid'])) ): ?>
		<span class="badge"><?php echo ascriptionQuantity($data['staff']['0']['cid']); ?></span>
		<?php endif; ?>
	</a>

	<?php if( isInvoiceMoldShow($data['staff']['0']['sid'],'发票审批') ): ?>
	<a
		class="tab-item external <?php if( $data['nav'] == 'invoiceApproval'  ): ?>active<?php endif; ?>"
		href="/invoiceApproval"> <span class="tab-label">发票审批</span>
	</a>
	<?php endif; ?>
	
	<?php if( isInvoiceMoldShow($data['staff']['0']['sid'],'发票打印') ): ?>
	<a
		class="tab-item external <?php if( $data['nav'] == 'invoicePrint'  ): ?>active<?php endif; ?>"
		href="/invoicePrint"> <span class="tab-label">发票打印</span>
	</a>
	<?php endif; ?>
</nav>