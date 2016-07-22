<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit">
<meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1"/>
<title>首页</title>

<link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>/addons/index/css/c.css" />   
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/ueditor/third-party/highcharts/highcharts.js"></script>
 
<script type="text/javascript">
	function hiddenall()
{
	 document.getElementById('container').style.display='none';
	   /* document.getElementById('container2').style.display='none';
	   document.getElementById('container3').style.display='none';*/
	
}
$(function () {
    $('#container').highcharts({
    	 credits: {
          enabled:false
				},
        chart: {
            type: 'column'
        },
        title: {
            text: '本周订单统计'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{point.y}￥</b>'
        },
        series: [{
            name: 'Population',  
             color: 'rgba(126,86,134,.9)',
            data: [
        		<?php  $index=0?>
            	<?php  if(is_array($chartdata1)) { foreach($chartdata1 as $item) { ?>
                ['<?php  echo $item['dates'];?>', <?php  echo $item['counts'];?>],	
          <?php  $index++?>
                	<?php  } } ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
    /*
    
      $('#container2').highcharts({
    	 credits: {
          enabled:false
				},
        chart: {
            type: 'column'
        },
        title: {
            text: '本月订单统计'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{point.y}￥</b>'
        },
        series: [{
            name: 'Population',  
             color: 'rgba(126,86,134,.9)',
            data: [
        		<?php  $index=0?>
            	<?php  if(is_array($chartdata2)) { foreach($chartdata2 as $item) { ?>
                ['<?php  echo $item['dates'];?>', <?php  echo $item['counts'];?>],	
          <?php  $index++?>
                	<?php  } } ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
    
    
    
      $('#container3').highcharts({
    	 credits: {
          enabled:false
				},
        chart: {
            type: 'column'
        },
        title: {
            text: '本年订单统计'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{point.y}￥</b>'
        },
        series: [{
            name: 'Population',  
             color: 'rgba(126,86,134,.9)',
            data: [
        		<?php  $index=0?>
            	<?php  if(is_array($chartdata3)) { foreach($chartdata3 as $item) { ?>
                ['<?php  echo $item['dates'];?>', <?php  echo $item['counts'];?>],	
          <?php  $index++?>
                	<?php  } } ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });*/
	  hiddenall();
	  document.getElementById('container').style.display='block';
});

		</script>
</head>
 <body>
<div class="main-wrap">
			

	<div class="workbench">
		<!--begin map-->
	
		<!--end map-->
		<!--begin main-->
		<div class="main-t clearfix">
			<div class="work-bench-r">
		        <div class="pending-order">
		            <dl>
		               <dt><span class="title">待处理事务</span></dt>
		                <dd><a href="<?php  echo create_url('site',  array('name' => 'member','do'=>'outchargegold'))?>">余额提现申请：<?php echo $needoutchargegold ?>条</a></dd>
		                <dd><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -3))?>">本月新评论：<?php echo $monthgoodscomment ?>条</a></dd>
		               <dd><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -2))?>">本月新增会员：<?php echo $monthmember ?>名</a></dd>
		          
		            </dl>
		        </div>
		        <div class="latest-notice">
		        <dl>
		               <dt><span class="title">待处理订单</span></dt>
		                <dd><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => 1))?>">待发货：<?php echo $needsend_count ?>笔</a>￥<?php echo $needsend__price ?></dd>
		                <dd><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => 2))?>">待收货：<?php echo $needget_count ?>笔</a>￥<?php echo $needget__price ?></dd>
		               
		               
		                <dd><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -3))?>">换货单：<?php echo $returnofgoods_count ?>笔</a>￥<?php echo $returnofgoods_price ?></dd>
		                <dd><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -4))?>">退货单：<?php echo $noneedgoods_count ?>笔</a>￥<?php echo $noneedgoods_price ?></dd>
		               
		               <dd><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -2))?>">退款单：<?php echo $returnofmoney_count ?>笔</a>￥<?php echo $returnofmoney_price ?></dd>
		               
		            </dl>
		        </div>
		    </div>
		    <div class="work-bench-l">
		        <!--begin 今日简报-->
		        <div class="today-presentation">
		            <dl>
		                <dt>
		                    <span class="totay-1">今日简报</span>
		                    <span class="totay-2">订单</span>
		                    <span class="totay-3">订单金额</span>
		                    <span class="totay-4">退货单</span>
		                    <span class="totay-5">退货金额</span>
		                </dt>
		                <dd>
		                    <span class="totay-1">今日</span>
		                    <span class="totay-2"><?php echo $todayordercount ?>笔</span>
		                    <span class="totay-3">￥<?php echo $todayorderprice ?></span>
		                    <span class="totay-4"><?php echo $todayordercount_re ?>笔</span>
		                    <span class="totay-5">￥<?php echo $todayorderprice_re ?></span>
		                </dd>
		                <dd>
		                    <span class="totay-1">本月</span>
		                    <span class="totay-2"><?php echo $monthordercount ?>笔</span>
		                    <span class="totay-3">￥<?php echo $monthorderprice ?></span>
		                    <span class="totay-4"><?php echo $monthordercount_re ?>笔</span>
		                    <span class="totay-5">￥<?php echo $monthorderprice_re ?></span>
		                </dd>
		                <dd>
		                    <span class="totay-1">本年</span>
		                    <span class="totay-2"><?php echo $yearordercount ?>笔</span>
		                    <span class="totay-3">￥<?php echo $yearorderprice ?></span>
		                    <span class="totay-4"><?php echo $yearordercount_re ?>笔</span>
		                    <span class="totay-5">￥<?php echo $yearorderprice_re ?></span>
		                </dd>
		            </dl>
		        </div>
		        <!--end 今日简报-->
		
		        <!--begin 业务简报-->
		        <div class="business-presentation">
		        	<dl>
		                <dt class="briefreporttab"><span class="title">业务简报</span>
		               <!-- 	<span class="briefreporttab-radios">
		                		
			                	<input type="radio" name="dateSegment" value="4" onclick="if(this.checked){hiddenall();document.getElementById('container').style.display='block';}" checked/>周
			                	<input type="radio" name="dateSegment" value="4"  onclick="if(this.checked){hiddenall();document.getElementById('container2').style.display='block';}" />月
			                	<input type="radio" name="dateSegment" value="6"  onclick="if(this.checked){hiddenall();document.getElementById('container3').style.display='block';}" />年
		                	</span>-->
			           
						</dt>
	                </dl>
	                <div class="order-unit">订货金额（元）</div>
	                <div id="container" style="width:98%;height:230px; margin: 0 auto"></div>
	               <!--   <div id="container2" style="width:98%;height:230px; margin: 0 auto"></div>
	               <div id="container3" style="width:98%;height:230px; margin: 0 auto"></div>-->
		        </div>
		        <!--end 业务简报-->
		
		    </div>
		</div>

     <?php  include page('footer');?>
     </body>
</html>