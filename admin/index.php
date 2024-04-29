<?php 
include('head.php');
?>
<link rel="stylesheet" href="./js/bootstrap.min.css">
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="./js/colorpicker.js"></script>
<script type="text/javascript" src="https://www.layuicdn.com/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="./js/config.js" type="text/javascript" charset="utf-8"></script>
</head>
<?php
error_reporting(0);
include('../data.php');
include('../config.php');//json数据
$token = $_COOKIE["admin_token"];
$session = md5($conf['admin_user'].md5($conf['admin_pwd']));
if($session !== $token){
echo '<script language="javascript">window.location.href=\'login.php\';</script>';
  }
?>
<body>
<?php include('daohang.php')?>
<div class="container">
<div class="row">
<!--网站信息修改-->
<div class="panel panel-primary form-group">
  <div class="panel-heading">
    <h3 class="panel-title">网站信息修改</h3>
  </div>
  <div class="panel-body"> 
  <form name="leleconfig" id="leleconfig">
  <input type="hidden">
    <!--全局信息修改 分类一-->
        <div class="form-group">
          <div class="form-group"><label>弹幕播放器开关</label></div>
          <label class="checkbox-inline">
              <input type="radio" value="on" name="lele[danmuon]" <?php $t=$lele['danmuon'];  if ($t=="on") { echo "checked";} ?> > 开启弹幕</span></label>
             <label class="checkbox-inline"><input type="radio" value="off" style=" margin-left:20px;" name="lele[danmuon]" <?php $t=$lele['danmuon'];  if ($t=="off") { echo "checked";} ?> > 关闭弹幕</span></label>
        </div>
        <div class="form-group">
          <label>主题颜色<small>（进度条、按钮颜色等）</small></label>
          <div class="form-group"> <div class="input-group"><div class="input-group-addon">请选择颜色</div><input id="color-picker"  type="text" class="form-control" name="lele[color]"  placeholder="颜色代码 例如：#00a1d6"></div></div>
        </div>
        <div class="form-group">
          <label>播放器LOGO<small>（播放器右上角的logo，建议透明logo效果最佳）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[logo]" class="form-control textarea animate-box" rows="1" placeholder="图片地址 例如：/leleys/logo.png" ><?php echo $lele['logo']?></textarea>
        </div>
        <div class="form-group">
          <label>加载等待时间<small>（跳转等待时间,输入"0"或 空 则不开启等待时间）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[waittime]" class="form-control textarea animate-box" rows="1" placeholder="单位/秒 loading页等待时间" ><?php echo $lele['waittime']?></textarea>
        </div>
        <div class="form-group">
          <label>弹幕发送间隔<small>（每秒只能发送一次弹幕）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[sendtime]" class="form-control textarea animate-box" rows="1" placeholder="单位/秒 指的是间隔几秒才能发送新弹幕" ><?php echo $lele['sendtime']?></textarea>
        </div>
        <div class="form-group">
          <label>弹幕礼仪文字<small>（弹幕输入框显示文字，建议四字之内）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[dmliyi]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边文字提示" ><?php echo $lele['dmliyi']?></textarea>
        </div>
         <div class="form-group">
          <label>弹幕礼仪链接<small>（点击弹幕礼仪文字跳转链接）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[dmrule]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边按钮链接" ><?php echo $lele['dmrule']?></textarea>
        </div>
        <div class="form-group">
          <label>鼠标右键文字<small>（建议六字之内）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[yjtest]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边文字提示" ><?php echo $lele['yjtest']?></textarea>
        </div>
         <div class="form-group">
          <label>右键文字链接<small>（点击右键文字跳转）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[yjrule]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边按钮链接" ><?php echo $lele['yjrule']?></textarea>
        </div>
         <div class="form-group">
          <label>弹幕关键字禁用<small>（屏蔽弹幕敏感字发送）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[pbgjz]" class="form-control textarea animate-box" rows="3" placeholder="暂时只支持单字匹配，后续会优化" ><?php echo $lele['pbgjz']?></textarea>
        </div>
        <div class="form-group">
          <label>暂停广告开关</label>
          <label class="checkbox-inline">
              <input type="radio" value="on" name="lele[ads][pause][state]" <?php $t=$lele['ads']['pause']['state'];  if ($t=="on") { echo "checked";} ?> > 开启广告</span></label>
             <label class="checkbox-inline"><input type="radio" value="off" style=" margin-left:20px;" name="lele[ads][pause][state]" <?php $t=$lele['ads']['pause']['state'];  if ($t=="off") { echo "checked";} ?> > 关闭广告</span></label>
        </div>
        <div class="form-group">
          <label>播放器背景图<small>（在加载视频时候出现的图片，视频加载后会被覆盖~）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[ads][pause][bjt]" class="form-control textarea animate-box" rows="1" placeholder="背景图链接" ><?php echo $lele['ads']['pause']['bjt']?></textarea>
        </div>
        <div class="form-group">
          <label>播放暂停图片<small>（暂停视频时显示的广告图片）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[ads][pause][pic]" class="form-control textarea animate-box" rows="1" placeholder="暂停图片链接" ><?php echo $lele['ads']['pause']['pic']?></textarea>
        </div>
        <div class="form-group">
          <label>图片跳转链接<small>（暂停视频时点击广告图片跳转链接）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[ads][pause][link]" class="form-control textarea animate-box" rows="1" placeholder="图片链接地址"><?php echo $lele['ads']['pause']['link']?></textarea>
        </div>
        <div class="form-group">
          <label>自动播放开关</label>
          <label class="checkbox-inline">
              <input type="radio" value="true" name="lele[autoplay]" <?php $t=$lele['autoplay'];  if ($t=="true") { echo "checked";} ?> > 开启自动播放</span></label>
             <label class="checkbox-inline"><input type="radio" value="false" style=" margin-left:20px;" name="lele[autoplay]" <?php $t=$lele['autoplay'];  if ($t=="false") { echo "checked";} ?> > 关闭自动播放</span></label>
        </div>
        <div class="form-group">
          <label>哔哩哔哩弹幕<small>（获取方法：随便点击一个哔哩哔哩视频链接查看源代码搜索"aid="，获取aid值即可）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[bilibili]" class="form-control textarea animate-box" rows="1" placeholder="请输入aid值 为空则不启用"><?php echo $lele['bilibili'];?></textarea>
        </div>
        <div class="form-group">
          <label>跑马灯遮挡层<small>（用于遮挡播放器顶部跑马灯广告专用默认为0%,需要遮挡多大自行输入，支持精确到小数点）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[pmdzd]" class="form-control textarea animate-box" rows="1" placeholder="请输入遮挡层大小，例如：9%或者9.1%"><?php echo $lele['pmdzd'];?></textarea>
        </div>
        <div class="form-group">
          <label>自定义跑马灯<small>（用于播放器任意位置进行文字跑马灯，有一定能力者可以自定义跑马灯代码）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[pmdzdy]" class="form-control textarea animate-box" rows="3" placeholder="请输入跑马灯代码~"><?php echo $lele['pmdzdy'];?></textarea>
        </div>
        <div class="form-group">
          <label>解析接口选择<small>（优先选择解析的json接口,失败调用备用接口，接口修改根目录config.php添加或修改json）</small></label>
          <select class="form-control textarea animate-box" aria-label="Default select example" type="text" name="lele[json]">
          <?php
          $i = 1;
          while($i<=count($parsing)){if($lele["json"] == $i){echo '<option value="'.$i.'" selected>'.$parsing[$i-1]["title"].'</option>';}else{echo '<option value="'.$i.'" >'.$parsing[$i-1]["title"].'</option>';}$i++;}
          ?>
        </select>
        </div>
        <button type="button" onclick="Save()" class="btn btn-primary btn-block" >确定修改</button><br/>
        <button type="reset" onclick="Reduction()" class="btn btn-primary btn-block" >还原默认</button>
      </form>
    </div>
    <script>
	new Colorpicker({
	    el: "color-picker",
	    color: "<?php echo $lele['color']?>",
	    change: function(elem, hex) {
			document.getElementById("color-picker").value=hex;
	    }
	})
</script>
    <?php include_once('author.php')?>
</body>
</html>