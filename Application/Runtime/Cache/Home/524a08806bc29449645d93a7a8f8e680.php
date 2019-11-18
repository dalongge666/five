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
	<style>
		div.validate-error{
			color: #f33e69;
			text-indent: 1em;
		}
	</style>
</head>
<body>
<div class="zy_login_box">
	<header class="zy_search_top_box">
		<div class="zy_title_top fix">
			<div class="one" href="javascript:" onclick="history.back();"><img src="/Public/home/images/back_jt.png"><span>返回</span></div>
			<h1>注册</h1>
			<div class="r">
		    	<a href="<?php echo U('Home/login/login');?>">账户登录</a>
		    </div>
		</div>
	</header>	

	<!-- 内容框 -->
	<div class="zy_module-content">
		<div class="login_box zhuce_box">
			<div class="zhuce_con">
				<div class="zhuce_tel">
					<form action="" method="post">
						<div class="login_style"><span class="cur">找工作</span><span>找人才</span></div>
						<div class="form_line">
							<label><a><img src="/Public/home/images/zy_icon_user.png"></a><input type="text" value="<?php echo ($data["username"]); ?>" name="username" placeholder="请输入用户名"></label>
						</div>
						<div class="validate-error"><?php echo ($errors["username"]); ?></div>
						<div class="form_line">
							<label><a><img src="/Public/home/images/zy_icon_mm.png"></a><input type="password" value="<?php echo ($data["password"]); ?>" name="password" placeholder="请输入密码"></label>
						</div>
						<div class="validate-error"><?php echo ($errors["password"]); ?></div>
						<div class="form_line">
							<label><a><img src="/Public/home/images/zy_icon_iphone.png"></a><input type="text" value="<?php echo ($data["mobile"]); ?>" name="mobile" placeholder="请输入手机号"></label>
						</div>
						<div class="validate-error"><?php echo ($errors["mobile"]); ?></div>
						<div class="form_line yzm">
							<label><a><img src="/Public/home/images/zy_icon_yzm.png"></a><input type="text" name="captcha" placeholder="请输入验证码"></label><!--
						 --><span id="yzmBtn">获取手机验证码</span>
							<div class="validate-error"><?php echo ($errors["captcha"]); ?></div>
						</div>

						<h2>
							<label><input type="checkbox" name="">我已看过并接受<a href="../web_other/about.html">《用户协议》</a></label>
						</h2>
						<button class="zy_login_btn">立即注册</button>
					</form>
				</div>
			</div>			
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
	});

	$('#yzmBtn').click(function () {
		//获取短信验证码
		function getMsg(){
			console.log(123);
			var mobile=$('input[name="mobile"]').val();
			var mobileReg = /^1[34578][0-9]{9}$/;
			if(mobileReg.test(mobile)){

				$.post('<?php echo U("sendMsg");?>', {mobile:mobile,_token:'<?php echo token();?>'}, function(msg) {
					// console.log(msg);
					if(msg === '提交成功'){
						RemainTime();
					}else{
						layer.tips( msg,'#yzmBtn',{tips:[3,'#FF7113']} );
					}
				})
			}else{
				layer.tips('请输入正确的手机号码','#tel', {
					tips:[3,'#bb0000']
				});
			}
		}
	});

	//短信倒计时
	var iTime = 30; //倒计时时间
	var Account; //定时器
	function RemainTime(){
		document.getElementById('yzmBtn').disabled = true; //倒计时开始后不能再点击获取验证码
		var iSecond,sSecond = "" , sTime = "";
		if (iTime >= 0){
			iSecond = parseInt(iTime%60);
			iMinute = parseInt(iTime/60);
			if (iSecond >= 0){
				if(iMinute>0){
					sSecond = iMinute + "分" + iSecond + "秒后重新获取";
				}else{
					sSecond = iSecond + " 秒后重新获取";
				}
			}
			sTime=sSecond;
			if(iTime === 0){
				clearTimeout(Account);
				sTime = '重新获取验证码';
				iTime = 30;
				document.getElementById('yzmBtn').disabled = false;
			}else{
				Account = setTimeout("RemainTime()",1000);
				iTime = iTime-1;
			}
		}else{
			sTime = '没有倒计时';
		}
		document.getElementById('yzmBtn').innerHTML = sTime;
	}
</script>
</html>