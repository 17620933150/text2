<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"E:\phpStudy\PHPTutorial\WWW\local.shop.com\public/../application/admin\view\index\left.html";i:1533212725;}*/ ?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('admin_static'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="<?php echo config('admin_static'); ?>/js/jquery.js"></script>
    <script type="text/javascript">
    $(function() {
        //导航切换
        $(".menuson li").click(function() {
            $(".menuson li.active").removeClass("active")
            $(this).addClass("active");
        });

        $('.title').click(function() {
            var $ul = $(this).next('ul');
            $('dd').find('ul').slideUp();
            if ($ul.is(':visible')) {
                $(this).next('ul').slideUp();
            } else {
                $(this).next('ul').slideDown();
            }
        });
    })
    </script>
</head>

<body style="background:#f0f9fd;">
    <div class="lefttop"><span></span>※ 控制面板 ※</div>
    <dl class="leftmenu">
        <?php
            $auths = session('auths');
            $children = session('children');
        ?>
        <!--循环1级菜单-->
        <?php foreach($children[1] as $one): ?>
        <dd>
            <div class="title">
                <span><img src="<?php echo config('admin_static'); ?>/images/leftico01.png" /></span><?php echo $auths[$one]['auth_name']; ?>
            </div>
            <ul class="menuson">
                <!--循环二级菜单-->
                <?php foreach($children[$one] as $two): ?>
                <li>
                    <cite></cite><a href="<?php echo url('/'.$auths[$two]['auth_c'].'/'.$auths[$two]['auth_a']); ?>" target="rightFrame"><?php echo $auths[$two]['auth_name']; ?></a><i></i></li>
                <?php endforeach; ?>
            </ul>
        </dd>
        <?php endforeach; ?>
    </dl>
</body>

</html>
