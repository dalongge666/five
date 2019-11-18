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

<!-- js -->
<script type="text/javascript" src="/Public/home/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/Public/home/js/swiper.min.js"></script>
<script type="text/javascript" src="/Public/home/js/public.js"></script>

</head>
<body>	

<!--
Start Preloader加载
==================================== -->
<div id="loading-mask">
	<div class="loading-img">
		<img alt="预加载" src="/Public/home/images/preloader01.gif"  />
		<p>找工作，找合伙人，上人和职业...</p>
	</div>
</div>
<!--
End Preloader
==================================== -->

<!--头部-->
<header class="module-layer">
    <div class="module-layer-content">
    	<div class="module-layer-bg"></div>
    	<div class="search-box-cover"></div>
        <p class="layer-logo"><img src="/Public/home/images/logo.png"></p>
        <h1 class="layer-head-name">
        	<div class="pr search-box">
        		<img class="shop-search" src="/Public/home/images/icon_search_w.png"/>
        		<input id="shop-input" type="text" placeholder="请输入关键词搜索" value="" />
        	</div>
        </h1>
        <p class="layer-login"><img src="/Public/home/images/pin.png"><a href="../web_other/weizhi.html">贵阳</a></p>
    </div>
</header>
<script type="text/javascript" charset="utf-8">
	$(function() {    
		var n=0; 
		//监听滚动条事件，改变背景透明度  
	    $(window).scroll(function() {  	        
	        var top = $(document).scrollTop();
	        if ((top/150) >= 0.9) {
	        	n=0.9;
	        }else{
	        	n=(top/150);
	        }
	        $(".search-box-cover").css("opacity",n);

	        // 搜索框背景色和搜索图标
	        if (n>0.4) {
	        	 $(".search-box").css("background","#ffffff");
	        	 $(".shop-search").attr("src","/Public/home/images/icon_search.png")
	        }else{
	        	 $(".search-box").css("background","rgba(255,255,255,0)");
	        	 $(".shop-search").attr("src","/Public/home/images/icon_search_w.png")
	        }

	    });  
	});
</script>

<div class="module-content">
	<!--banner图-->
    <div class="swiper-container banner">
		<ul class="swiper-wrapper">
			<li class="swiper-slide">
				<img src="/Public/home/images/banner01.jpg">
			</li>
			<li class="swiper-slide">
				<img src="/Public/home/images/banner01.jpg">
			</li>
		</ul>
		<div class="swiper-pagination sp01"></div>
		<script>
		    var swiper = new Swiper('.banner', {
		        pagination: '.sp01',
		        paginationClickable: true,
		        autoplay:"3000",
		        loop:"ture",
		        speed:500,
		        autoplayDisableOnInteraction : false,
		    });
	    </script>
    </div>

    <!-- 图标导航icon -->
    <div class="swiper-container nav_iconbox">
	   	<div class="swiper-wrapper">
	   		<!-- 每个ul有8个li，不能多于8个 -->
			<ul class="swiper-slide"> 
		    	<li>
		    		<a href="work.html">
		    			<img src="/Public/home/images/person_img/icon01.png">
		    			<span>找工作</span>
		    		</a>
		    	</li>
		    	<li>
		    		<a href="partner.html">
		    			<img src="/Public/home/images/icon02.png">
		    			<span>合伙创业</span>
		    		</a>
		    	</li>
		    	<li>
		    		<a href="train.html">
		    			<img src="/Public/home/images/person_img/icon03.png">
		    			<span>提升培训</span>
		    		</a>
		    	</li>
		    </ul>
		</div>
		<script>
		    var swiper = new Swiper('.nav_iconbox', {
		        speed:500,
		        autoplayDisableOnInteraction : false,
		    });
	    </script>
    </div>

    <!-- 公告信息 -->
    <div class="news_sj_dxs_box bgwh mb6">
    	<div class="scrollnews">
    		<span><img src="/Public/home/images/news_tit.png"></span>
    		<ul>
    			<li><a href="../web_other/news_xq.html">人和职业免费技能培训专业火热报名中！</a></li>
    			<li><a href="../web_other/news_xq.html">认真学习十九大精神，争取贯彻落实习总书记讲话</a></li>
				<li><a href="../web_other/news_xq.html">杨校长在2019春季开学典礼上致辞</a></li>
    		</ul>
    		<span class="r"><a href="../web_other/newslist.html">更多></a></span>
    		<script type="text/javascript">

                $(document).ready(function(){
                	var timer;
                    //滚动文字
                    function runtxt(){
                        $(".scrollnews ul").animate({marginTop:"-.4rem"},300,
                            function(){
                                $(".scrollnews ul li:last").after($(".scrollnews ul li:first"))
                                $(".scrollnews ul").css("margin-top",0)
                            }
                        )
                    }   
                    $(".scrollnews ul li a").mouseenter(
                        function(){
                            clearInterval(timer)
                        }
                    )
                    $(".scrollnews ul li a").mouseleave(
                        function(){
                            timer=setInterval(runtxt,4000)
                        }
                    )
                    timer=setInterval(runtxt,4000);
                })
            </script>
    	</div>
    </div>
	
	<!-- 推荐培训 -->
    <div class="tuij_box bgwh mb6">
    	<div class="title">
    		<h2><img src="/Public/home/images/person_img/icon_tjpx.png" /><span>推荐培训</span></h2>
    		<a href="train.html">查看更多></a>
    	</div>
    	<ul>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic01.jpg" /></i>
    				<dl class="l">
    					<dt>公共营养师</dt>
    					<dd class="ge04">理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">299</span></dd>
    				</dl>
    				<span class="ge04 abs">优惠</span>
    			</a>
    		</li>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic04.jpg" /></i>
    				<dl class="l">
    					<dt>插花师</dt>
    					<dd class="ge04">理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">99</span></dd>
    				</dl>
    				<span class="ge04 abs">免费</span>
    			</a>
    		</li>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic05.jpg" /></i>
    				<dl class="l">
    					<dt>环境产业水治理</dt>
    					<dd class="ge04">视频学习+理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">29</span></dd>
    				</dl>
    				<span class="ge04 abs">优惠</span>
    			</a>
    		</li>
    	</ul>
    </div>

    <!-- 推荐培训 -->
    <div class="tuij_gz bgwh mb6">
    	<div class="title">
    		<h2><img src="/Public/home/images/person_img/icon_tjgz.png" /><span>推荐工作</span></h2>
    		<a class="change"><img src="/Public/home/images/refresh.png" />换一批</a>
    	</div>
    	<ul>
    		<li>
    			<a href="work_xq.html">
    				<div class="job_tit fix">
    					<h2 class="l pct80">招聘食堂高级营养师</h2>
    					<span class="r">20小时前</span>
    				</div>
    				<div class="job_money">
    					<span>待遇：<em class="gr n">面议</em></span>
    				</div>
    				<div class="job_fuli fix">
    					<p class="l pct70">
    						<em>包吃住</em><em>餐补</em><em>加班补助</em>
    					</p>
    					<span class="r">浏览次数：235</span>
    				</div>
    			</a>
    		</li>
    		<li>
    			<a href="work_xq.html">
    				<div class="job_tit fix">
    					<h2 class="l pct80">高薪招聘贵阳南明育婴师</h2>
    					<span class="r">昨天</span>
    				</div>
    				<div class="job_money">
    					<span>待遇：<em class="gr n">5000~8000元</em></span>
    				</div>
    				<div class="job_fuli fix">
    					<p class="l pct70">
    						<em>包吃住</em><em>餐补</em>
    					</p>
    					<span class="r">浏览次数：125</span>
    				</div>
    			</a>
    		</li>
    		<li>
    			<a href="work_xq.html">
    				<div class="job_tit fix">
    					<h2 class="l pct80">建筑工人</h2>
    					<span class="r">03-25</span>
    				</div>
    				<div class="job_money">
    					<span>待遇：<em class="gr n">面议</em></span>
    				</div>
    				<div class="job_fuli fix">
    					<p class="l pct70">
    						<em>包吃住</em><em>餐补</em><em>加班补助</em>
    					</p>
    					<span class="r">浏览次数：35</span>
    				</div>
    			</a>
    		</li>
    		<li>
    			<a href="work_xq.html">
    				<div class="job_tit fix">
    					<h2 class="l pct80">观山湖高新区招聘大数据呼叫员</h2>
    					<span class="r">03-25</span>
    				</div>
    				<div class="job_money">
    					<span>待遇：<em class="gr n">3000~5000元</em></span>
    				</div>
    				<div class="job_fuli fix">
    					<p class="l pct70">
    						<em>五险</em><em>餐补</em><em>加班补助</em>
    					</p>
    					<span class="r">浏览次数：35</span>
    				</div>
    			</a>
    		</li>
    		<li>
    			<a href="work_xq.html">
    				<div class="job_tit fix">
    					<h2 class="l pct80">招聘安保人员</h2>
    					<span class="r">03-25</span>
    				</div>
    				<div class="job_money">
    					<span>待遇：<em class="gr n">2000~4000元</em></span>
    				</div>
    				<div class="job_fuli fix">
    					<p class="l pct70">
    						<em>餐补</em><em>加班补助</em>
    					</p>
    					<span class="r">浏览次数：49</span>
    				</div>
    			</a>
    		</li>
    	</ul>
    </div>

    <!-- 热门职位 -->
    <div class="hot_work bgwh mb6">
    	<div class="title hot_tit">
    		<h2><span>热门职位</span></h2>
    		<a href="work.html">查看更多></a>
    	</div>
    	<ul>
    		<li><a href="work.html">公共营养师</a></li>
    		<li><a href="work.html">育婴师</a></li>
    		<li><a href="work.html">养老护理师</a></li>
    		<li><a href="work.html">茶艺师</a></li>
    		<li><a href="work.html">插花师</a></li>
    		<li><a href="work.html">园林绿化工程师</a></li>
    		<li><a href="work.html">建筑工人</a></li>
    		<li><a href="work.html">高级早教师</a></li>
    		<li><a href="work.html">装饰设计师</a></li>
    		<li><a href="work.html">导购员</a></li>
    		<li><a href="work.html">促销员</a></li>
    		<li><a href="work.html">电子商务师</a></li>
    	</ul>
    </div>

    <!-- 广告 -->
    <div class="swiper-container ad_picbox">
		<ul class="swiper-wrapper">
			<li class="swiper-slide">
				<a href="#"><img src="/Public/home/images/company_img/adpic01.png"></a>
			</li>
			<li class="swiper-slide">
				<a href="#"><img src="/Public/home/images/person_img/adpic02.jpg"></a>
			</li>
		</ul>
		<script>
		    var swiper = new Swiper('.ad_picbox', {
		        autoplay:"4000",
		        effect:"fade",
		        loop:"ture",
		        speed:700,
		        autoplayDisableOnInteraction : false,
		    });
	    </script>
    </div>

    <!-- 热门培训 -->
    <div class="tuij_box bgwh mb6">
    	<div class="title">
    		<h2><img src="/Public/home/images/person_img/icon_hot.png" /><span>热门培训</span></h2>
    	</div>
    	<ul>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic01.jpg" /></i>
    				<dl class="l">
    					<dt>公共营养师</dt>
    					<dd class="ge04">理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">291</span></dd>
    				</dl>
    				<span class="ge04 abs">优惠</span>
    			</a>
    		</li>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic02.jpg" /></i>
    				<dl class="l">
    					<dt>养老护理师</dt>
    					<dd class="ge04">理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">99</span></dd>
    				</dl>
    				<span class="ge04 abs">免费</span>
    			</a>
    		</li>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic03.jpg" /></i>
    				<dl class="l">
    					<dt>育婴师</dt>
    					<dd class="ge04">理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">27</span></dd>
    				</dl>
    				<span class="ge04 abs">免费</span>
    			</a>
    		</li>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic04.jpg" /></i>
    				<dl class="l">
    					<dt>插花师</dt>
    					<dd class="ge04">理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">89</span></dd>
    				</dl>
    				<span class="ge04 abs">优惠</span>
    			</a>
    		</li>
    		<li>
    			<a href="train_xq.html">
    				<i class="l"><img src="/Public/home/images/pic05.jpg" /></i>
    				<dl class="l">
    					<dt>环境产业水治理</dt>
    					<dd class="ge04">视频学习+理论与操作</dd>
    					<dd class="g6">报名人数：<span class="gr">29</span></dd>
    				</dl>
    				<span class="ge04 abs">免费</span>
    			</a>
    		</li>
    	</ul>
    </div>
	
	<!-- 返回顶部 -->
	<div class="go_top">
		<a class="btn_top"></a>
	</div>
	
	<!-- 底部 -->
	<div class="footer_box">
		<div class="footer">
			<h2>
				<a href="../web_login/login.html">登录</a><!-- 
			 --><a href="../web_login/register.html">注册</a><!-- 
			 --><a href="../web_ruzhu/apply_index.html">同行入驻</a>
			</h2>
			<h3>
				<span><a href="../web_other/about.html">关于我们</a></span>
				<span><a href="../web_other/about.html">求职指南</a></span>
				<span><a href="../web_other/about.html">联系我们</a></span>
				<span><a href="../web_other/about.html">免责声明</a></span>
			</h3>
			<div class="txt">
				<p>&copy; 2019 XX公司&nbsp;&nbsp;ICP备XXXXXXXX号<br/>技术支持：<a href="http://www.jsdaima.com/" title="js代码" target="_blank">js代码（www.jsdaima.com）</a></p>
			</div>
		</div>
	</div>

	<!-- 底部导航 -->
	<div class="foot_menu">
		<ul>
			<li class="cur">
				<a href="../web_person/index.html">
					<i><img src="/Public/home/images/menu_icon01_r.png"></i>
					<span>首页</span>
				</a>
			</li>
			<li>
				<a href="../web_person/work.html">
					<i><img src="/Public/home/images/person_img/menu_icon02_01.png"></i>
					<span>工作</span>
				</a>
			</li>
			<li class="info">
				<a href="../web_person/msg.html">
					<i><img src="/Public/home/images/menu_icon03.png"></i>
					<span>消息</span>
					<em></em>
				</a>
			</li>
			<li>
				<a href="../web_person/user.html">
					<i><img src="/Public/home/images/menu_icon04.png"></i>
					<span>我的</span>
				</a>
			</li>
		</ul>
	</div>
	
</div>

<!-- 搜索框 -->
<div class="search_bomb_box">
	<div class="search_top fix sy_search_top">
		<a><img src="/Public/home/images/back_jt.png"><span>返回</span></a>
		<div>
			<form>
                <select>
                    <option>工作</option>
                    <option>合伙</option>
                </select> 
			    <input type="text" name="" placeholder="请输入关键词搜索"><!-- 
			 --><button type="submit"><img src="/Public/home/images/icon_search.png"></button>
			</form>
		</div>
	</div>
	<div class="search_txt">
		<h2>大家都在搜</h2>
		<ul>
			<li><a href="work.html">公告营养师</a></li>
			<li><a href="work.html">园艺设计</a></li>
			<li><a href="work.html">建筑设计</a></li>
			<li><a href="work.html">育婴师</a></li>
			<li><a href="work.html">养护师</a></li>
			<li><a href="work.html">平面设计</a></li>
			<li><a href="work.html">web工程师</a></li>
			<li><a href="work.html">学前教育</a></li>
			<li><a href="work.html">环保工程师</a></li>
			<li><a href="work.html">母婴护理师</a></li>
			<li><a href="work.html">保育员</a></li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(".search-box").mousedown(
			function(){
				$(".search_bomb_box").show()
				$(".module-layer").hide()			
				$(".module-content").hide()
			}
		)
		$(".search_bomb_box .search_top>a").mousedown(
			function(){
				$(".search_bomb_box").hide()
				$(".module-layer").show()		
				$(".module-content").show()
			}
		)
	})
</script>


</body>
</html>