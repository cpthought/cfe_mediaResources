<?php

class MediaResourcesController extends DooController {

	function __construct() {
        Doo::loadClass ( 'global.func' );
	}

	function index(){}

    function createMedia(){

        $this->render ( "/mediaResources/createMedia" );
    }

    function createMediaDo(){
        $name = get_args ( 'name' ) ? get_args ( 'name' ) : "";
        $category = get_args ( 'category' ) ? get_args ( 'category' ) : "";
        $introduction = get_args ( 'introduction' ) ? get_args ( 'introduction' ) : "";
        $mediaName = get_args ( 'mediaName' ) ? get_args ( 'mediaName' ) : "";

        Doo::loadModel ( 'videoLibrary' );
        $videoLibrary = new videoLibrary ();


        $save_path = DOO::conf ()->SITE_PATH . "mediaFile/";
        $webSite = WEB_SITE . '/mediaFile/';


        $cover='';
        $file_name = $mediaName . '.' . _GetFileEXT ( $_FILES ["cover"] ['name'] );

        if (! empty ( $_FILES ["cover"] ["size"] )) {
            if (! @move_uploaded_file ( $_FILES ["cover"] ["tmp_name"], $save_path . $file_name ))
                die("文件无法保存");
            else {
                $cover = $webSite . $file_name;
            }
        }


        $item = array (
            'name' => $name,
            'category' => $category,
            'cover' => $cover,
            'introduction' => $introduction,
            'url'=>$webSite.$mediaName.'.mp4'
        );
        $videoLibrary->addVideo ( $item );

        return '/mr/createMedia';
    }

    //上传视频
    function mediaFiles(){

        $POST_MAX_SIZE = ini_get ( 'post_max_size' );
        $unit = strtoupper ( substr ( $POST_MAX_SIZE, - 1 ) );
        $multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

        if (( int ) $_SERVER ['CONTENT_LENGTH'] > $multiplier * ( int ) $POST_MAX_SIZE && $POST_MAX_SIZE) {
            header ( "HTTP/1.1 500 Internal Server Error" );
            echo "POST exceeded maximum allowed size.";
            exit ( 0 );
        }

        // Settings
        $save_path = DOO::conf ()->SITE_PATH . "mediaFile/"; // The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)
        $upload_name = "Filedata";
        $max_file_size_in_bytes = 2147483647; // 2GB in bytes
        $extension_whitelist = array (
            "doc",
            "txt",
            "jpg",
            "gif",
            "png"
        ); // Allowed file extensions
        $valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-'; // Characters allowed in the file name (in a Regular Expression format)

        // Other variables
        $MAX_FILENAME_LENGTH = 260;
        $file_name = "";
        $file_extension = "";
        $uploadErrors = array (
            0 => "文件上传成功",
            1 => "上传的文件超过了 php.ini 文件中的 upload_max_filesize directive 里的设置",
            2 => "上传的文件超过了 HTML form 文件中的 MAX_FILE_SIZE directive 里的设置",
            3 => "上传的文件仅为部分文件",
            4 => "没有文件上传",
            6 => "缺少临时文件夹"
        );

        $nk = time ();
        $file_name = $nk ; //. '.' . _GetFileEXT ( $_FILES [$upload_name] ['name'] )

        if (! @move_uploaded_file ( $_FILES [$upload_name] ["tmp_name"], $save_path . $file_name )) {
            echo "文件无法保存.";
            exit ( 0 );
        }

        // Return output to the browser (only supported by SWFUpload for Flash Player 9)

        echo json_encode ( array (
            'filename' => $file_name,
            'id' => $nk
        ) );
        exit ( 0 );
    }

    /**
     * 获取get或者POST值
     * @param string $name 属性名称
     * @return fixed 值
     */
    function get_args($name) {
        if (isset ( $_GET [$name] )) {
            if (is_array ( $_GET [$name] ))
                return $_GET [$name];
            else
                return addslashes ( $_GET [$name] );
        } elseif (isset ( $_POST [$name] )) {
            if (is_array ( $_POST [$name] ))
                return $_POST [$name];
            else
                return addslashes ( $_POST [$name] );
        } else
            return false;
    }

}
?>