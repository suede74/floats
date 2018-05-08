<style>
.bootstrap-tagsinput .label {
	padding: 1px 6px;
}
</style>

<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i> <span
							class="caption-subject font-blue-madison bold uppercase">集合資料</span>
					</div>
				</div>
				<div class="portlet-body form">

					<form id="data-form" class="form-horizontal"
						enctype="multipart/form-data" role="form" method="post">
						<input type="hidden" name="cm_id" value="<?=(isset($cm_id))? $cm_id : 0?>" />
						<input type="hidden" name="c_id" value="<?=(isset($collection['c_id']))? $collection['c_id'] : 0?>" />
						<div class="form-body">														
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">集合名稱：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="集合名稱" class="form-control" name="c_title" value="<?=(isset($collection["c_title"])? $collection["c_title"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group ">
                                <label class="control-label col-md-2">集合照：</label>
                                <div class="col-md-10">                                  
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        	<?php if (isset($collection['c_image']) && $collection['c_image']) { ?>
                                                <img src="/public/upload/collection/<?=$collection['c_image']?>" alt="" />
                                           	<?php } ?>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">選擇圖片</span><span class="fileinput-exists">更換圖片</span>
                                            <input type="file" name="c_image"></span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移除圖片</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
									
							<div class="form-group">
								<div class="col-md-12">
	                                <label class="control-label col-md-2">狀態：</label>
	                                <div class="col-md-10">
		                                <div class="radio-list">
		                                    <label class="radio-inline">
		                                        <input type="radio" name="c_status" id="c_status1" value="1" <?=(isset($collection['c_status']) && $collection['c_status'] == '1')? 'checked' : 'checked'?>> 啟用 </label>
		                                    <label class="radio-inline">
		                                        <input type="radio" name="c_status" id="c_status2" value="2" <?=(isset($collection['c_status']) && $collection['c_status'] == '2')? 'checked' : ''?>> 停用 </label>
		                                </div>
		                            </div>
	                            </div>
                            </div>

                            <div class="form-group">
								<div class="col-md-12">
									<label class="col-md-2 control-label">查詢商品：</label>
	                                <div class="col-md-10">
	                                	<div class="input-icon right">
											<select class="form-control" name="pm">
												<option value="">請選擇</option>
											</select>
										</div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
								<div class="col-md-12">
									<label class="col-md-2 control-label">商品：</label>
	                                <div class="col-md-10">
	                                	<div class="input-icon right">
	                                		<input class="" type="text" name="pm_ids" value="" id="pm_ids">
	                                	</div>
	                                </div>
	                            </div>
	                        </div>

							<!-- <div class="form-group">
								<div class="col-md-12">
	                                <label class="col-md-2 control-label">商品：</label>
	                                <div class="col-md-10">
	                                	<div class="icheck-inline">
	                                	<?php if (!empty($products)): ?>
	                                    	<?php 
	                                    		foreach ($products as $key=>$product): 
	                                    			$checked = '';
	                                    			if (!empty($relaction) && in_array($product['pm_id'], $relaction)):
	                                    				$checked = 'checked';
	                                    			endif;
	                                    	?>
                                            <label>
                                                <input type="checkbox" name="pm_id[]" class="icheck" value="<?=$product['pm_id']?>" <?=$checked?>> <?=$product['pm_name_tw']?> </label>
                                            <?php endforeach; ?>
	                                    <?php endif; ?>                                        
                                        </div>
	                                </div>
	                            </div>
                            </div> -->
							
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回集合列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">儲存修改</button>
						</div>
					</form>

					<div style="display:none;" id="select_pm"><?= isset($relaction_data)? json_encode($relaction_data) : '' ?></div>
				</div>
			</div>
		</div>
	</div>
</div>