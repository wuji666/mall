<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
	tbody tr td{
		position: relative;
	}
	tbody tr  .icow-weibiaoti--{
		visibility: hidden;
		display: inline-block;
		color: #fff;
		height:18px;
		width:18px;
		background: #e0e0e0;
		text-align: center;
		line-height: 18px;
		vertical-align: middle;
	}
	tbody tr:hover .icow-weibiaoti--{
		visibility: visible;
	}
	tbody tr  .icow-weibiaoti--.hidden{
		visibility: hidden !important;
	}
	.full .icow-weibiaoti--{
		margin-left:10px;
	}
	.full>span{
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		vertical-align: middle;
		align-items: center;
	}
	tbody tr .label{
		margin: 5px 0;
	}
	.goods_attribute a{
		cursor: pointer;
	}
	.newgoodsflag{
		width: 22px;height: 16px;
		background-color: #ff0000;
		color: #fff;
		text-align: center;
		position: absolute;
		bottom: 70px;
		left: 57px;
		font-size: 12px;
	}
	.modal-dialog {
		min-width: 720px !important;
		position: absolute;
		left: 0;
		right: 0;
		top: 50%;
	}
	.catetag{
		overflow:hidden;

		text-overflow:ellipsis;

		display:-webkit-box;

		-webkit-box-orient:vertical;

		-webkit-line-clamp:2;
	}
</style>
<div class="page-header">
	当前位置：<span class="text-primary">进货管理</span>
</div>
<div class="page-content">
	<div class="fixed-header">
		<div style="width:25px;"></div>
		<div style="width:80px;text-align:center;">排序</div>
		<div style="width:80px;">商品</div>
		<div class="flex1">&nbsp;</div>
		<div style="width: 100px;">价格</div>
		<div style="width: 80px;">库存</div>
		<div style="width: 80px;">销量</div>
		<?php  if($goodsfrom!='cycle') { ?>
		<div  style="width:80px;" >状态</div>
		<?php  } ?>
		<div class="flex1">属性</div>
		<div style="width: 120px;">操作</div>
	</div>
	<form action="<?php  echo webUrl('purchase/goodList')?>" method="get" class="form-horizontal form-search" role="form">
		<input type="hidden" name="c" value="site" />
		<input type="hidden" name="a" value="entry" />
		<input type="hidden" name="m" value="ewei_shopv2" />
		<input type="hidden" name="do" value="web" />
		<input type="hidden" name="r"  value="purchase.goodList" />
		<div class="page-toolbar">
			<div class="input-group col-sm-6 pull-right">
				<span class="input-group-select">
					<select name="attribute" class='form-control select2' style="width:200px;" data-placeholder="商品属性">
						<option value="" <?php  if(empty($_GPC['attribute'])) { ?>selected<?php  } ?>>商品属性</option>
						<option value="new" <?php  if($_GPC['attribute']=='new') { ?>selected<?php  } ?>>新品</option>
						<option value="hot" <?php  if($_GPC['attribute']=='hot') { ?>selected<?php  } ?> >热卖</option>
						<option value="recommand" <?php  if($_GPC['attribute']=='recommand') { ?>selected<?php  } ?> >推荐</option>
						<option value="discount" <?php  if($_GPC['attribute']== 'discount') { ?>selected<?php  } ?> >促销</option>
						<option value="sendfree" <?php  if($_GPC['attribute']== 'sendfree') { ?>selected<?php  } ?> >包邮</option>
						<option value="time" <?php  if($_GPC['attribute'] == 'time') { ?>selected<?php  } ?> >限时卖</option>
						<option value="nodiscount" <?php  if($_GPC['attribute'] == 'nodiscount') { ?>selected<?php  } ?> >不参与折扣</option>
					</select>
				</span>
				<span class="input-group-select">
					<select name="cate" class='form-control select2' style="width:200px;" data-placeholder="商品分类">
						<option value="" <?php  if(empty($_GPC['cate'])) { ?>selected<?php  } ?> >商品分类</option>
						<?php  if(is_array($category)) { foreach($category as $c) { ?>
						<option value="<?php  echo $c['id'];?>" <?php  if($_GPC['cate']==$c['id']) { ?>selected<?php  } ?> ><?php  echo $c['name'];?></option>
						<?php  } } ?>
					</select>
				</span>
				<input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="ID/名称/编号/条码<?php  if($merch_plugin) { ?>/商户名称<?php  } ?>">
				<span class="input-group-btn">
					<button class="btn btn-primary" type="submit"> 搜索</button>
				</span>
			</div>
		</div>
	</form>
	<form method="post" action="<?php  echo webUrl('purchase/post')?>">
	<?php  if(count($list)>0 && cv('purchase.main')) { ?>
		<div class="input-group col-sm-6" style="margin-bottom: 10px;">
		<span class="input-group-select">
			<select id="store" name="shop_id" class='form-control select2' style="width:200px;" data-placeholder="选择门店">
				<?php  if(is_array($store_list)) { foreach($store_list as $v) { ?>
				<option value="<?php  echo $v['id'];?>"><?php  echo $v['storename'];?></option>
				<?php  } } ?>
			</select>
		</span>
		</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-responsive">
				<thead class="navbar-inner">
				<tr>
					<th style="width:25px;"></th>
					<th style="width:80px;">商品</th>
					<th style="width:80px;">名称</th>
					<th style="width: 100px;">价格</th>
					<th style="width: 80px;">库存</th>
					<th style="width:300px;" >属性</th>
					<th>进货数量</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td>
						<input type='checkbox' name="good_id[]"  value="<?php  echo $item['id'];?>"/>
					</td>
					<td>
						<a href="javascript:;">
							<img src="<?php  echo tomedia($item['thumb'])?>" style="width:72px;height:72px;padding:1px;border:1px solid #efefef;margin: 7px 0" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
						</a>
					</td>
					<td class='full' >
						<span>
							<span style="display: block;width: 100%;">
								<?php  echo $item['title'];?>
								<span class="catetag">
									<?php  if(is_array($item['allcates'])) { foreach($item['allcates'] as $index => $item1) { ?>
										<?php  if($category[$item['allcates'][$index]]['level'] ==1) { ?>
											<span class="text-danger">[<?php  echo $category[$item['allcates'][$index]]['name'];?>]</span>
											<?php  } else if($category[$item['allcates'][$index]]['level'] ==2) { ?>
											<span class="text-info">[<?php  echo $category[$item['allcates'][$index]]['name'];?>]</span>
											<?php  } else if($category[$item['allcates'][$index]]['level'] ==3 && intval($shopset['catlevel']==3)) { ?>
											<span class="text-info">[<?php  echo $category[$item['allcates'][$index]]['name'];?>]</span>
											<?php  } ?>
									<?php  } } ?>
								</span>
							</span>
						</span>
					</td>
					<td>&yen;
						<?php  echo $item['marketprice'];?>
					</td>
					<td>
						<?php  echo $item['total'];?>
					</td>
					<td  class="goods_attribute">
						<a class='<?php  if($item['isnew']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'>新品</a>
						<a class='<?php  if($item['ishot']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'>热卖</a>
						<a class='<?php  if($item['isrecommand']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'>推荐</a>
						<a class='<?php  if($item['isdiscount']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'>促销</a>
						<a class='{if $item['issendfree>包邮</a>
						<a class='<?php  if($item['istime']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'>限时卖</a>
						<a class='<?php  if($item['isnodiscount']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'>不参与折扣</a>
					</td>
					<td><input type="text" name="" placeholder="不得大于总库存" style="border: 1px solid #ccc;"></td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php  } else { ?>
	<div class="panel panel-default">
		<div class="panel-body empty-data">暂时没有任何商品!</div>
	</div>
	<?php  } ?>
<div class="form-group">
	<label class="col-sm-2 control-label"></label>
	<div class="col-sm-9 subtitle">
		<input type="submit" value="保存商品" class="btn btn-primary"/>
		<a class="btn btn-default" href="<?php  echo webUrl('purchase')?>">返回列表</a>
	</div>
</div>
</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<script>
	$(function () {
		var box = $('input[type=checkbox]');
		box.each(function () {
			$(this).click(function () {
				if ($(this).is(':checked') === true) {
					var val = $(this).val();
					$(this).parent().siblings().last().children().attr('name', 'stock[' + val +']');
				}
			})
		});
	})
</script>