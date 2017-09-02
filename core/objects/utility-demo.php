<?php

    
    function sanitize($data)
    {
        return mysqli_real_escape_string($data);
        
    }
    function output_Errors($errors){
        $error = '';
        foreach($errors as $error){
            $error = '<p style="padding: 0.833em 0.833em 0.833em 3em; 
            margin-bottom: 0.833em;
            background: #fde8e4 url(\'./images/icons/message-boxes/error.png\') no-repeat 0.833em center;
            border: 1px solid #e6bbb3;
            color: #cf4425;">'. $error .'</p>';
        }
        return $error;
    }
    
    function output_infoMessage($message){
        //$message = '';
        //foreach($messages as $message){
            $message = '<p style="padding: 0.833em 0.833em 0.833em 3em; 
            margin-bottom: 0.833em;
            background: #e5f5f9 url(\'./images/icons/message-boxes/information.png\') no-repeat 0.833em center;
            border: 1px solid #cae0e5;
            color: #5a9bab;">'. $message .'</p>';
        //}
        return $message;
    }
    function output_errorMessage($message){
        //$message = '';
        //foreach($messages as $message){
            $message = '<p style="padding: 0.833em 0.833em 0.833em 3em; 
            margin-bottom: 0.833em;
            background: #fde8e4 url(\'./images/icons/message-boxes/error.png\') no-repeat 0.833em center;
            border: 1px solid #e6bbb3;
            color: #cf4425;">'. $message .'</p>';
        //}
        return $message;
    }
    function createThumbnail($path,$save,$width,$height)
    {
        $info = getimagesize($path);
        $size = array($info[0],$info[1]);
        
        if($info['mime']=='image/png'){
            $src = imagecreatefrompng($path);
            
        }else if($info['mime']=='image/jpeg'){
            $src = imagecreatefromjpeg($path);
        }else if($info['mime']=='image/gif'){
            $src = imagecreatefromgif($path);
            
        }else{
            return false;
        }
        
        $thumb = imagecreatetruecolor($width, $height);
        $src_aspect = $size[0] / $size[1];
        $thumb_aspect = $width / $height;
        
        if($src_aspect < $thumb_aspect){
            // narrow
            $scale = $width / $size[0];
            $new_size = array($width,$width / $src_aspect);
            $src_pos = array(0,($size[1] * $scale - $height) / $scale / 2);
            
        }else if($src_aspect > $thumb_aspect){
            // wider
            $scale = $height / $size[1];
            $new_size = array($height * $src_aspect,$height);
            $src_pos =array(($size[0] * $scale - $width) / $scale / 2,0);
        }else{
            // same shape
            $new_size = array($width,$height);
            $src_pos = array(0,0);
        }
        
        $new_size[0] = max($new_size[0],1);
        $new_size[1] = max($new_size[1],1);
        
        imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
        if($save===false){
            return imagepng($thumb);
        }else{
            return imagepng($thumb,$save);
        }
                
    }
?>
