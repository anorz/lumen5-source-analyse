<?php
if(isset($_POST['codenumber'])){
    $platformid = $codenumber = $bigid = $codelen = 0;
    extract($_POST);
    $code_array = array_map(function()use($codelen,$platformid,$bigid){
        return [$platformid,substr(md5(mt_rand(1,9999).time()),0,$codelen),$bigid];
    },range(1,$codenumber));
    $handle = fopen('codekey.csv','w');
    fputcsv($handle,['platformid','cdkey','bagid']);
    foreach ($code_array as $line)
    {
        fputcsv($handle,$line);
    }
    fclose($handle);
//    unlink('code.csv')
    if(true){
        exit(json_encode(['status'=>'success','data'=>'codekey.csv']));
    }
    exit(json_encode(['status'=>'error']));
}else if (isset($_GET['csv'])){
    $filename=realpath("codekey.csv"); //文件名
    $date=date("Ymd-H:i:m");
    header( "Content-type:  application/octet-stream");
    header( "Accept-Ranges:  bytes");
    header( "Accept-Length: " .filesize($filename));
    header( "Content-Disposition:  attachment;  filename= codekey.csv");
    echo file_get_contents($filename);
    readfile($filename);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>超次元战纪兑换码</title>
    <meta charset="utf-8">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-top: 30px;">
    <form role="form">
        <div class="form-group">
            <label for="platformid">平台类型:</label>
            <select name="platformid" id="platformid" class="form-control">
                <option value="1">任性手游平台</option>
                <option value="2">果盘手游平台</option>
                <option value="3">UC手游平台</option>
            </select>
        </div>
        <div class="form-group">
            <label for="codenumber">兑换码数量:</label>
            <input type="number" class="form-control" id="codenumber" name="codenumber" placeholder="请输入生成的数量">
        </div>
        <div class="form-group">
            <label for="bigid">兑换码类型:</label>
            <input type="number" class="form-control" id="bigid" name="bigid" value="10001" placeholder="10001" >
        </div>
        <div class="form-group">
            <label for="codelen">兑换码长度:</label>
            <input type="number" class="form-control" id="codelen" name="codelen" value="16" placeholder="16" >
        </div>
        <div class="form-group">
            <button type="button" id="create" class="btn btn-primary form-control">生成</button>
        </div>
    </form>
</div>
<script>
    $("#create").on('click',function(){
        var platformid = $("#platformid").val();
        var codenumber = $("#codenumber").val();
        var bigid      = $("#bigid").val();
        var codelen    = $("#codelen").val();
        if(platformid<=0 || codenumber<=0 || bigid<=0 || codelen<=0){
            alert("参数不能为空")
            return false
        }
        $.ajax({
            url:"<?=$_SERVER['PHP_SELF']?>",
            type:"POST",
            data:{platformid:platformid,codenumber:codenumber,bigid:bigid,codelen:codelen},
            dataType:'json',
            success:function(result){
                if(result.status=='success')
                {
                    window.location.href = result.data
                }else{
                    alert("生成兑换码出错")
                }
            }
        })
    })
</script>

</body>
</html>

