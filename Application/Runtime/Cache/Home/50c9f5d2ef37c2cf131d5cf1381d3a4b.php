<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="招聘" http-equiv="keywords">
<meta name="description" content="招聘,培训">
<meta name="format-detection" content="telephone=no"><!-- 禁止IPHONE识别手机号码 -->
<meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1">
<meta name="renderer" content="webkit" />

<title>js代码（www.jsdaima.com）- IT资源下载平台</title>
<!-- css -->
<link rel="stylesheet" type="text/css" href="/Public/home/css/index.css">
<link rel="stylesheet" type="text/css" href="/Public/home/css/swiper.min.css">

<!-- public_css -->
<link rel="stylesheet" type="text/css" href="/Public/home/css/public/public_lib.css">

<!-- zy_public_css -->
<link rel="stylesheet" type="text/css" href="/Public/home/css/zy_public.css">
<!-- 入驻 新闻 登录css -->
<link rel="stylesheet" type="text/css" href="/Public/home/css/news_login_apply.css">

<!-- js -->
<script type="text/javascript" src="/Public/home/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/Public/home/js/swiper.min.js"></script>
<script type="text/javascript" src="/Public/home/js/public.js"></script>

</head>
<body>
<div class="zy_login_box">
	<header class="zy_search_top_box">
		<div class="zy_title_top fix">
			<div class="one" href="javascript:" onclick="history.back();"><img src="/Public/home/images/back_jt.png"><span>返回</span></div>
			<h1>登录</h1>
			<div class="r">
		    	<a href="<?php echo U('Home/login/register');?>">免费注册</a>
		    </div>
		</div>
	</header>	

	<!-- 内容框 -->
	<div class="zy_module-content">
		<div class="login_box">
			<div class="logo"><img src="/Public/home/images/common_img/logo02.png"></div>
			<form>
				<div class="login_style"><span class="cur">找工作</span><span>找人才</span></div>

				<div class="form_line">
					<label><a><img src="/Public/home/images/zy_icon_user.png"></a><input type="text" name="" placeholder="请输入手机号"></label>
				</div>
				<div class="form_line">
					<label><a><img src="/Public/home/images/zy_icon_mm.png"></a><input type="password" name="" placeholder="请输入密码"></label>
				</div>
				<button class="zy_login_btn">登 录</button>
				<h2>
					<label><input type="checkbox" name="">自动登录</label>
					<a href="findPwd.html">忘记密码？<span class="ge04">点此找回</span></a>
				</h2>
			</form>
		</div>		
	</div>
</div>

</body>
<script type="text/javascript">
	$(function(){
		$(".login_style span").mousedown(function(){
			$(this).addClass("cur");
			$(this).siblings().removeClass("cur");
		})
	})
</script>
</html>