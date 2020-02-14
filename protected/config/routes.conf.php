<?php
$route['get']['/mr/createMedia'] = array('MediaResourcesController', 'createMedia');
$route['post']['/mr/createMediaDo'] = array('MediaResourcesController', 'createMediaDo');



$route['post']['/pmr/mediaFiles'] = array('MediaResourcesController', 'mediaFiles');





//$route['get']['/mcm/video/category/:id'] = array('ApiController', 'getVideoCategory');


$route['get']['/'] = array('MediaResourcesController', 'index');

?>