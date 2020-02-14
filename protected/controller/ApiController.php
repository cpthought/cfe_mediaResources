<?php

class ApiController extends DooController {

	function __construct() {
        Doo::loadClass ( 'global.func' );
	}

	function index(){}

    function getVideoRecommend(){

        //$sidKey = $this->get_args ( 'sidKey' ) ? $this->get_args ( 'sidKey' ) : "";

        Doo::loadModel ( 'videoLibrary' );
        $videoLibrary = new videoLibrary ();

        $list=$videoLibrary->getRecommend();

        echo json_encode(array('status'=>1,'list'=>$list));
    }

    function getVideoCategory(){

        //$sidKey = $this->get_args ( 'sidKey' ) ? $this->get_args ( 'sidKey' ) : "";

        Doo::loadModel ( 'videoLibrary' );
        $videoLibrary = new videoLibrary ();

        echo '推荐视频列表';
    }
    

}
?>