<script src="<?php echo  WEB_SITE_GLOBAL  ?>js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="<?php echo  WEB_SITE_GLOBAL  ?>js/swfuplad2/swfupload.js"></script>
<script type="text/javascript" src="<?php echo  WEB_SITE_GLOBAL  ?>js/swfuplad2/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo  WEB_SITE_GLOBAL  ?>js/swfuplad2/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo  WEB_SITE_GLOBAL  ?>js/swfuplad2/handlers.js"></script>

<script type="text/javascript">

    var swfu;

    window.onload = function() {
        var settings = {
            flash_url : "<?php echo  WEB_SITE_GLOBAL  ?>js/swfuplad2/swfupload.swf",
            upload_url: "/pmr/mediaFiles",	// Relative to the SWF file


            file_types : "*.mp4",
            file_types_description : "*.mp4",
            file_upload_limit : 8,
            file_queue_limit : 1,
            custom_settings : {
                progressTarget : "fsUploadProgress",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "<?php echo  WEB_SITE_GLOBAL  ?>images/btn-normal1.jpg",	// Relative to the Flash file

            button_width: "200",
            button_height: "40",
            button_placeholder_id: "spanButtonPlaceHolder",

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete	// Queue plugin event
        };

        swfu = new SWFUpload(settings);
    };
</script>



<form action="/mr/createMediaDo" enctype="multipart/form-data" method="post"  class="nice-validator n-default" >
    <input type="hidden" id="enclosurName" name="mediaName" value="">

    <table class="table table-bordered table-condensed">
    <tbody>

    <tr>
        <th class="taC" width="150">上传教材</th>
        <td>
            <div class="controls">
                <span id="spanButtonPlaceHolder"></span>
                <input id="btnCancel" type="button" value="取消所有上传" style="display:none"  onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />

                <span class="fieldset flash" id="fsUploadProgress"></span>
                <span id="divStatus">0 个文件已上传</span>
            </div>

        </td>
    </tr>

    <tr>
        <th class="taC" width="150">教材名称</th>
        <td>
            <input type="text" name="name" value="">
        </td>
    </tr>

    <tr>
        <th class="taC" width="150">分类（）</th>
        <td>
            <input type="text" name="category" value="">
        </td>
    </tr>

    <tr>
        <th class="taC" width="150">封面</th>
        <td>
            <input type="file" name="cover" >
        </td>
    </tr>

    <tr>
        <th class="taC" width="150">简介</th>
        <td>
            <input type="text" name="introduction" value="">
        </td>
    </tr>









    </tbody>
</table>





    <div class="modal hide fade" id="confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>确认信息无误</h3>
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <div class="modal-footer">
                    <input type="submit" class="button" value="无误，提交申请">

                </div>
            </div>
        </div>
    </div>


</form>