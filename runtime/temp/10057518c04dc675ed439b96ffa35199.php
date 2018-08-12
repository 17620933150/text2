<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"E:\phpStudy\PHPTutorial\WWW\local.shop.com\public/../application/admin\view\type\add.html";i:1533216554;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>无标题文档</title>
    <link href="<?php echo config('admin_static'); ?>/css/style.css" rel="stylesheet" type="text/css"/>
    <script language="JavaScript" src="<?php echo config('admin_static'); ?>/js/jquery.js"></script>
    <style>
        .active {
            border-bottom: solid 3px #66c9f3;
        }

        .box th, .box td {
            border: 1px solid #ccc;
        }

        .box b {
            color: blue;
        }

        li {
            list-style: none;
        }

        .box .ul_f {
            float: left;
        }

        .box .son {
            padding-left: 10px;
        }
    </style>

</head>

<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">表单</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle">
        <span class="active">基本信息</span>
    </div>
    <form action="" method="post">
        <ul class="forminfo">
            <li>
                <label>类型名称</label>
                <input name="type_name" placeholder="请输入类型名称" type="text" class="dfinput"/><i></i>
            </li>
            <li>
                <label>类型描述</label>
                <input name="mark" placeholder="请输入商品类型描述" type="text" class="dfinput"/><i></i>
            </li>

        </ul>
        <li>
            <label>&nbsp;&nbsp;</label>
            <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存"/>
        </li>
    </form>
</div>
</body>
<script>
    //全选和全不选
    function all_select(ele) {
        //ele 是当前元素的DOM对象 
        console.log(ele.checked); //获取当前input元素的选中状态值 true-选中   false-未选中
        $(ele).parent().next().find('input').prop('checked', ele.checked)
    }


    //把父级默认选中
    function up_select(ele, parent) {
        // 参数parent => 1  或   3,4   ==>  [3,4]
        var ids = parent.split(',');
        //console.log(ids); // [3,4]
        $.each(ids, function (k, v) {
            //获取value=k的input标签选中
            $("input[value='" + v + "']").prop('checked', true);
        });
        //当二级和三级都没有选中的时候，一级取消选中
        //思路：
        //1.找到当前元素二级和三级共同的祖先td,
        //2.在获取到下面所有选中的input的个数，如果为0，说明都没有选中
        var all_checked = $(ele).parents('td').find('input:checked');
        if (all_checked.length == 0) {
            //则把一级全选权限取消选中
            $(ele).parents('tr').children('th').find("input").prop('checked', false);
        }
    }
</script>

</html>
