<?php
Doo::loadCore ( 'db/DooModel' );

class videoLibrary extends DooModel {

	public $id;
	public $userId;
	public $category;
	public $viewers;
	public $favorites;
	public $vod;
	public $shares;
	public $reviews;

	public $labelId;
    public $createTime;

    public $url;
    public $cover;


	public $_table = 'CFE_videoLibrary2020';
	public $_primarykey = 'id';
	public $_fields = array (
			'id',
			'userId',
			'category',
			'viewers',
			'favorites',
			'vod',
			'shares',
			'reviews',
			'labelId',
			'createTime',

            'url',
            'cover',

	);

	public function getRecommend(){

        $sql = 'select *
				from CFE_videoLibrary2020 
				';
        $query = Doo::db ()->query ( $sql );
        return $result = $query->fetchAll ();

    }

    /**
     * 添加一个发票并进入审批状态
     * @param array $item 发票相关数据
     * @return number 返回发票ID
     */
    public function addVideo($item = array()) {
        $lid = 0;
        if (is_array ( $item ) && ! empty ( $item )) {
            foreach ( $item as $key => $value ) {
                $this->$key = $value;
            }
            $lid = $this->insert ();
        }
        return $lid;
    }


	/**
	 * 根据发票ID获取一条发票数据
	 * @param number $iid 发票ID
	 * @param number $select 需要获取的字段,为空获取全部数据
	 * @return array|array() 返回发票数据
	 */
	public function getInvoiceByIid($iid = 0, $select = "") {
		if (! is_numeric ( $iid ))
			$iid = $this->authcode ( $iid );
		
		$condition = array (
				'where' => "iid=" . $iid,
				'asArray' => TRUE 
		);
		if (! empty ( $select ))
			$condition += array (
					'select' => $select 
			);
		
		$Detail = array ();
		if (is_numeric ( $iid ) && ! empty ( $iid ))
			$Detail = $this->getOne ( $condition );
		
		if (isset ( $Detail ['expressCompany'] ) && ! empty ( $Detail ['expressCompany'] )) {
			$express = explode ( ":", $Detail ['expressCompany'] );
			$Detail ['expressCompany'] = $express [0];
			$Detail ['expressCom'] = $express [1];
		}else{
			$Detail ['expressCompany'] = '';
			$Detail ['expressCom'] = '';
		}
		
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		
		$Detail ['iidKeyUrl'] = $XDeode->encode ( $Detail ['iid'] );
		$Detail ['iidKey'] = $this->authcode ( $Detail ['iid'], '' );
		Doo::loadModel ( 'L_category' );
		$lCategory = new L_category ();
		$Detail ['category'] = $lCategory->getCategory ();
		return $Detail;
	}
	public function getInvoiceByIsid($iid = "", $sid = 0) {
		if (empty ( $iid ) || empty ( $sid ))
			return array ();
		
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		$iid = $XDeode->decode ( $iid );
		if (! is_numeric ( $iid ))
			return array ();
		
		$detail = $this->getOne ( array (
				'where' => "iid= '" . $iid . "'", // and sid=".$sid,
				'asArray' => TRUE 
		) );
		
		return $detail;
	}
	
	/**
	 * 获取单个可以打印的发票数据
	 * @param number $iid 发票id
	 * @param number $select 需要获取的字段,为空获取全部数据
	 * @return array|array() 返回发票数据
	 */
	public function getInvoiceByPrint($iid = 0, $select = "") {
		$condition = array (
				'where' => "iid= '" . $iid . "' and status=2",
				'asArray' => TRUE 
		);
		if (! empty ( $select ))
			$condition += array (
					'select' => $select 
			);
		$detail = array ();
		if (! empty ( $iid ) && is_numeric ( $iid ))
			$detail = $this->getOne ( $condition );
		return $detail;
	}

	/**
	 * 根据参数字段更新相应字段（主键ID必须传）
	 * @param array $item 相关需要更新的字段信息
	 * @return number 返回发票ID
	 */
	public function setInvoiceByCondition($item = array()) {
		$lid = 0;
		if (is_array ( $item ) && ! empty ( $item )) {
			foreach ( $item as $key => $value ) {
				$this->$key = $value;
			}
			$lid = $this->update ();
		}
		return $lid;
	}
	/**
	 * 根据管理组和发票当前状态获得打印发票数据；其中当iid为空时获取所有发票数据，反之获取1条数据
	 * @param number $sid 管理组人员ID
	 * @param number $status 状态 为0时获取可以打印数据，为1时获取已经完成打印数据
	 * @param number $iid 发票ID
	 * @return array|array() 返回所有发票数据，当iid有值时返回一条数据
	 */
	public function getPrintInvoiceByManage($sid = 0, $status = 0, $iid = 0) {
		$list = array ();
		if (! empty ( $sid ) && empty ( $iid ))
			$list = $this->find ( array (
					'where' => "status=2 and printStatus=" . $status . " and moldManage like '%[\"" . $sid . "\",%'",
					'desc' => 'iid',
					'asArray' => TRUE 
			) );
		elseif (! empty ( $sid ) && ! empty ( $iid ))
			$list = $this->getOne ( array (
					'where' => "status=2 and printStatus=" . $status . " and moldManage like '%[\"" . $sid . "\",%' and iid=" . $iid,
					'asArray' => TRUE 
			) );
		return $list;
	}
	
	/**
	 * 获得与我相关的发票数据，其中包含 处理中，待处理，最旧入账等数据;当iid有值时获取一条关于sid的发票
	 * @param number $sid 用户ID
	 * @param number $iid 发票ID
	 * @return array|array()
	 */
	public function getMyInvoice($sid = 0, $iid = 0) {
		//$sid=58;
		
		
		Doo::loadModel ( 'invoiceOperationLog' );
		$invoiceOperationLog = new invoiceOperationLog ();
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		$list = array ();
		if (! empty ( $iid )) {
			$list = $this->getOne ( array (
					'where' => " sid=" . $sid . " and iid=" . $iid,
					'asArray' => TRUE 
			) );
		} elseif (! empty ( $sid ) && empty ( $iid )) {
			$list ['pendingInvoice'] = array ();
			$list ['handleInvoice'] = array ();
			$list ['pendingInvoice'] = $this->find ( array (
					'where' => "((status=1 and untreadStatus=0) or (status=2 and printStatus=0 and untreadStatus=0)  or
					( status=2 and printStatus=1 and untreadStatus=1 and untreadPost=0)
					or (postStatus=0 and doPost=1 and status=2 and untreadStatus=0)  or (status=3 or status=4) ) and isDelete=0  and sid=" . $sid,
					'desc' => 'iid',
					'asArray' => TRUE 
			) );
			foreach ( $list ['pendingInvoice'] as $key => $value ) {
				$list ['pendingInvoice'] [$key] ['OperationLog'] = $invoiceOperationLog->getInvoiceOperationLogByIid ( $value ['iid'], 'desc' );
				$list ['pendingInvoice'] [$key] ['iidKeyUrl'] = $XDeode->encode ( $value ['iid'] );
			}
			
			$list ['handleInvoice'] = $this->find ( array (// or ( status=2 and  untreadStatus=3 ) or (status=2  and untreadStatus=2 )
					'where' => "( (status=2 and printStatus=1  )  )  and isDelete=0 and sid=" . $sid,
					'desc' => 'iid',
					'asArray' => TRUE 
			) );//print_r($list ['handleInvoice']);die;
			foreach ( $list ['handleInvoice'] as $key => $value ) {
				$list ['handleInvoice'] [$key] ['iidKey'] = $this->authcode ( $value ['iid'], '' );
				$list ['handleInvoice'] [$key] ['iidKeyUrl'] = $XDeode->encode ( $value ['iid'] );
				$list ['handleInvoice'] [$key] ['OperationLog'] = $invoiceOperationLog->getInvoiceOperationLogByIid ( $value ['iid'], 'desc' );
			}
		}
		
		return $list;
	}
	
	/**
	 * 获得与我有关可收款的发票，已经出票的发票
	 * @param number $sid 开票人ID
	 */
	public function getInvoiceByReceivables($sid = 0) {
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		$list ['handleInvoice'] = $this->find ( array (
				'where' => "(status=2 and printStatus=1 and untreadStatus=0 )  and isDelete=0 and sid=" . $sid,
				'desc' => 'iid',
				'asArray' => TRUE 
		) );
		foreach ( $list ['handleInvoice'] as $key => $value ) {
			$list ['handleInvoice'] [$key] ['iidKey'] = $this->authcode ( $value ['iid'], '' );
			$list ['handleInvoice'] [$key] ['iidKeyUrl'] = $XDeode->encode ( $value ['iid'] );
			// $list ['handleInvoice'] [$key] ['OperationLog'] = $invoiceOperationLog->getInvoiceOperationLogByIid ( $value ['iid'], 'desc' );
		}
		return $list ['handleInvoice'];
	}
	
	/**
	 * 获取需要邮寄的发票
	 * @param integer $postStatus 0为获取需要邮寄的发票，1为获取已经邮寄的发票
	 * @return array|array() 返回相关数据
	 */
	public function getPostByInvoice($postStatus = 0) {
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		$list = $this->find ( array (
				'where' => "postStatus=" . $postStatus . " and doPost=1 and status=2 and isDelete=0",
				'asArray' => TRUE 
		) );
		foreach ( $list as $key => $value ) {
			$list [$key] ['iidKey'] = $this->authcode ( $value ['iid'], '' );
			$list [$key] ['iidKeyK'] = $XDeode->encode ( $value ['iid'] );
			$list [$key] ['expressCompany'] = '';
			$list [$key] ['expressCom'] = '';
			if (! empty ( $value ['expressCompany'] )) {
				$express = explode ( ":", $value ['expressCompany'] );
				$list [$key] ['expressCompany'] = $express [0];
				$list [$key] ['expressCom'] = $express [1];
			}
		}
		return $list;
	}
	
	/**
	 * 根据退票状态获得相关数据，iid有值时只获得一条数据
	 * @param number $untreadStatus 退票状态
	 * @param number $iid 发票ID
	 */
	public function getInvoiceByUntreadStatus($untreadStatus = 1, $iid = 0) {
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		if (empty ( $iid )) {
			$list = $this->find ( array (
					'where' => " printStatus=1 and untreadStatus=" . $untreadStatus . " and status=2 ",
					'asArray' => TRUE 
			) );
			
			if ($untreadStatus == 2) {
				Doo::loadModel ( 'invoiceOperationLog' );
				$invoiceOperationLog = new invoiceOperationLog ();
			}
			foreach ( $list as $key => $value ) {
				$list [$key] ['iidKey'] = $this->authcode ( $value ['iid'], '' );
				$list [$key] ['iidKeyK'] = $XDeode->encode ( $value ['iid'] );
				$list [$key] ['untreadCompany'] = '';
				$list [$key] ['untreadCom'] = '';
				if (! empty ( $value ['untreadCompany'] )) {
					$express = explode ( ":", $value ['untreadCompany'] );
					$list [$key] ['untreadCompany'] = $express [0];
					$list [$key] ['untreadCom'] = $express [1];
				}
				if ($untreadStatus == 2) {
					$list [$key] ['OperationLog'] = $invoiceOperationLog->getInvoiceOperationByStatus ( $value ['iid'], 6 );
				}
			}
		} else {
			$list = $this->getOne ( array (
					'where' => "iid=" . $iid . " and printStatus=1 and untreadStatus=" . $untreadStatus . " and status=2",
					'asArray' => TRUE 
			) );
		}
		return $list;
	}
	/**
	 * 审批中获取相关数据 包括最近的一条操作记录
	 * @param number $status.
	 * @param number $limit.
	 */
	function getInvoiceByProcessStatus($limit = 4, $desc = 'desc') {
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		$list = $this->find ( array (
				'where' => " (status=1 or status=3 or status=4) and processApprovals!=''",
				'limit' => $limit,
				$desc => 'iid',
				'asArray' => TRUE 
		) );
		
		Doo::loadModel ( 'invoiceOperationLog' );
		$invoiceOperationLog = new invoiceOperationLog ();
		
		foreach ( $list as $key => $value ) {
			$list [$key] ['iidKeyK'] = $XDeode->encode ( $value ['iid'] );
			$list [$key] ['operationLog'] = $invoiceOperationLog->getInvoiceOperationLogByIid ( $value ['iid'], 'desc' );
		}
		return $list;
	}
	
	/**
	 * 统计培训班开票
	 */
	function sumOfinvoiceTrain($itidSql) {
		$sql = 'select sum(b.invoicePrice) as invoicePrice ,b.trainId as trainId
				from CLD_invoiceStore as a left join  ' . $this->_table . '  as b on (a.iid=b.iid)
				where b.trainId in (' . $itidSql . ') and b.status=2 and b.printStatus=1 and (b.untreadStatus =0 or b.untreadStatus=3)
				GROUP BY b.trainId';
		$query = Doo::db ()->query ( $sql );
		return $result = $query->fetchAll ();
	}
	function sumOfInvoiceRecelvablesTrain($itidSql) {
		// $sql = 'select sum(b.receivablesPrice) as receivablesPrice ,a.trainId,count(*) as count
		// from ' . $this->_table . ' as a left join CLD_invoiceReceivables as b on find_in_set(a.irid,b.irid)
		// where a.trainId in (' . $itidSql . ') and a.status=2 and a.printStatus=1 and (a.untreadStatus =0 or a.untreadStatus=3) and a.irid!=""
		// GROUP BY a.trainId';
		$sql = 'select sum(b.receivablesPrice) as receivablesPrice ,a.trainId,count(*) as count
 				from ' . $this->_table . ' as a left join CLD_invoiceReceivables as b on (a.iid=b.iid)
 				where a.trainId in (' . $itidSql . ') and a.status=2 and a.printStatus=1 and (a.untreadStatus =0 or a.untreadStatus=3) and a.irid!=""
 				GROUP BY a.trainId';
	
		$query = Doo::db ()->query ( $sql );
	
		return $result = $query->fetchAll ();
	}
	
	function sumOfInvoiceByItid($itidSql=0){
		$sql = 'select sum(a.invoicePrice) as invoicePrice ,a.trainId as trainId,a.iid
				from ' . $this->_table . ' as a left join  CLD_RIExtend  as b on (a.iid=b.iid)
				where (a.trainId in (' . $itidSql . ') and a.status=2 and a.printStatus=1 and  a.untreadStatus=3) or b.RIstatus=1
				GROUP BY a.trainId';
		$query = Doo::db ()->query ( $sql );
		return $result = $query->fetchAll ();
	}
	
	function getInvoiceByUntreadStatusPage($limit = 0, $con = "", $desc = 'desc') {
		if (empty ( $limit ) || empty ( $con ))
			return array ();
		
		$list = $this->find ( array (
				'where' => $con,
				'limit' => $limit,
				$desc => 'iid',
				'asArray' => TRUE 
		) );
		Doo::loadClass ( 'XDeode' );
		$XDeode = new XDeode ( 5 );
		Doo::loadModel ( 'invoiceReceivables' );
		$invoiceReceivables = new invoiceReceivables ();
		Doo::loadModel ( 'invoiceOperationLog' );
		$invoiceOperationLog = new invoiceOperationLog ();
		
		
		foreach ( $list as $key => $value ) {
			$list [$key] ['iidKey'] = $this->authcode ( $value ['iid'], '' );
			$list [$key] ['iidKeyK'] = $XDeode->encode ( $value ['iid'] );
			
			$list [$key] ['untreadCompany'] = '';
			$list [$key] ['untreadCom'] = '';
			if (! empty ( $value ['untreadCompany'] )) {
				$express = explode ( ":", $value ['untreadCompany'] );
				$list [$key] ['untreadCompany'] = $express [0];
				$list [$key] ['untreadCom'] = $express [1];
			}
			
			$list [$key] ['irList'] = $invoiceReceivables->getInvoiceReceivablesInIridString ( $value ['irid'] );
			$list [$key] ['operationLog'] = $invoiceOperationLog->getInvoiceOperationLogByIid( $value ['iid'], 'desc' );
			$list [$key] ['OperationLog'] = $invoiceOperationLog->getInvoiceOperationByStatus ( $value ['iid'], 6 );
			$list [$key] ['sumPrice'] = 0;
			if (! empty ( $list [$key] ['irList'] ))
				$list [$key] ['sumPrice'] = $list [$key] ['irList'] [0] ['sumPrice'];
			// $list [$key] ['operationLog'] = $invoiceOperationLog->getInvoiceOperationLogByIid ( $value ['iid'], 'desc' );
		}
		
		return $list;
	}
	
	/**
	 * 加密或解密指定字符串
	 *
	 * @param string $string 要加密或解密的字符串
	 * @param string $operation 当取值为'DECODE'时表示解密，否则为加密
	 * @param string $key 加解密的key
	 * @param $expiry 超时值
	 *
	 */
	function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
		$ckey_length = 4;
		if (! $key) {
			$key = $this->INVOICEKEY;
		}
		$key = md5 ( $key );
		$keya = md5 ( substr ( $key, 0, 16 ) );
		$keyb = md5 ( substr ( $key, 16, 16 ) );
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
		
		$cryptkey = $keya . md5 ( $keya . $keyc );
		$key_length = strlen ( $cryptkey );
		
		$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
		$string_length = strlen ( $string );
		
		$result = '';
		$box = range ( 0, 255 );
		
		$rndkey = array ();
		for($i = 0; $i <= 255; $i ++) {
			$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
		}
		
		for($j = $i = 0; $i < 256; $i ++) {
			$j = ($j + $box [$i] + $rndkey [$i]) % 256;
			$tmp = $box [$i];
			$box [$i] = $box [$j];
			$box [$j] = $tmp;
		}
		
		for($a = $j = $i = 0; $i < $string_length; $i ++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box [$a]) % 256;
			$tmp = $box [$a];
			$box [$a] = $box [$j];
			$box [$j] = $tmp;
			$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
		}
		
		if ($operation == 'DECODE') {
			if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
				return substr ( $result, 26 );
			} else {
				return '';
			}
		} else {
			return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
		}
	}
}

?>