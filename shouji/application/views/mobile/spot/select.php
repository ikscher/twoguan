<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if !empty($row['seotitle'])}{$row['seotitle']}{else}{$row['spotname']}{/if}-{$webname}</title>
 {php echo Common::getScript('jquery-min.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }


</head>

<body>
    {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:history.go(-1);">返回</a>
    <a class="city_tit" href="javascript:;">景点门票预订</a>
  </div>
  <form method="post" action="{$cmsurl}order/create"  id="bookfrm" onsubmit="return check();">
  <input type="hidden" name="id" id="id" value="{$row['id']}">
  <input type="hidden" id="ordertype" name="ordertype" value="5" />
  <input type="hidden" id="suitid" name="suitid" value="{intval($suit[0]['id'])}" />
  <div class="m-main">
	
  	<div class="xz-top-box">
    	<div class="pic"><img class="fl" src="{$row['litpic']}" alt="" width="90" height="64" /></div>
    	<div class="txt">
        <p>{$row['spotname']}</p>
        <span>&yen;{$row['doorprice']} </span>
      </div>
    </div>
    
    <div class="big_box">

      <div class="price-tc">
        <h3>门票类型</h3>
        <ul>
          {loop $suit $key $v1}
            <li {if $key==0}class="cur fangxing"{else}class="fangxing"{/if} dateid="{$v1['id']}" price="{intval($v1['ourprice'])}">{$v1['title']} &yen;{intval($v1['ourprice'])}</li>
          {/loop}
        </ul>
      </div>

      <div class="order-m">
      	<h3>预定产品数</h3>
        <ul>
        	<li>
          	<label>产品数量：</label>
            <span>
            	<span class="order-btn minus minus-active"></span>
              <input type="text" id="dingnum" min="1" max="100" class="order-txt-n" name="dingnum" value="1" />
            	<span class="order-btn plus plus-active"></span>
            </span>
            <span class="order-jg"></span>
          </li>
          <li><label>联系人：</label><input type="text" name="linkman" id="linkman" class="order-lx" placeholder="请填写联系人" value="{$user['truename']}" /></li>
          <li><label>联系电话：</label><input type="text" name="linktel" id="linktel" class="order-lx" placeholder="手机号码或固定电话" value="{$user['mobile']}" />可通过此手机号查询订单(必填)</li>
        </ul>
      </div>
      
    </div>

  </div>
  
 {template 'public/foot'}
  <div class="opy"></div>
  <div class="bom_fix_box">
  	<span>总额：<em id="totalprice">&yen;{intval($suit[0]['ourprice'])}</em></span>
  	<a class="booking" href="javascript:;">提交订单</a>
    <input type="hidden" id="price"  value="{intval($suit[0]['ourprice'])}"/>
  </div>

</body>
<script language="JavaScript">
    var price = $("#price").val();
    $(function(){
        $(".minus").click(function(){
            var num = parseInt($("#dingnum").val())-1;
            num = num<=0 ? 1 : num;
            $("#dingnum").val(num);
            var totalprice = num * price;
            $("#totalprice").html('&yen;'+totalprice);
        })
        $(".plus").click(function(){
            var num = parseInt($("#dingnum").val())+1;

            $("#dingnum").val(num);
            var totalprice = num * price;
            $("#totalprice").html('&yen;'+totalprice);
        })
        //提交表单
        $(".booking").click(function(){
            $("#bookfrm").submit();
        })




    })
    function check()
    {
        var linkman = $("#linkman").val();
        var linktel = $("#linktel").val();
        if($("#price").val()==0){
          alert('该产品不能预订');
            return false;
        }
        if(linkman==''){
            alert('请填写联系人');
            return false;
        }
        if(linktel == ''){
            alert('请填写联系方式');
            return false;
        }
        return true;

    }
    
    //门票切换
    $('.fangxing').click(function(){
      $('.fangxing').removeClass('cur');
      $(this).addClass('cur');
      var roomid=$(this).attr('dateid');
      var price=$(this).attr('price');
      $('#suitid').val(roomid);
      $('#price').val(price);
      var num = $("#dingnum").val();
      var totalprice = parseInt(num) * parseInt(price);
      $('#totalprice').html('&yen;'+totalprice);
    });
</script>
</html>
