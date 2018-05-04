<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i> <span
							class="caption-subject font-blue-madison bold uppercase">系統變數資料</span>
					</div>
				</div>
				<div class="portlet-body form">

					<form id="data-form" class="form-horizontal"
						enctype="multipart/form-data" role="form" method="post">
						<input type="hidden" name="sv_id"
							value="<?=(isset($variable['sv_id']))? $variable['sv_id'] : 0?>" />
						<div class="form-body">
							<!-- <div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">語系：</div>
									<div class="col-md-10">
										
									</div>
								</div>
							</div> -->
														
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">變數說明：</div>
									<div class="col-md-10">
										<p class="form-control-static"><?=(isset($variable['sv_name']))? $variable['sv_name'] : ''?></p>
									</div>
								</div>
							</div>

							<?php if (isset($variable['sv_type']) && $variable['sv_type'] == 'image') { ?>
								<div class="form-group ">
	                                <label class="control-label col-md-2">圖片：</label>
	                                <div class="col-md-10">                                  
	                                    <div class="fileinput fileinput-new" data-provides="fileinput">
	                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
	                                        	<?php if (isset($variable['sv_value']) && $variable['sv_value']) { ?>
	                                                <img src="/public/upload/sv/<?=$variable['sv_value']?>" alt="" />
	                                           	<?php } ?>
	                                        </div>
	                                        <div>
	                                            <span class="btn btn-default btn-file"><span class="fileinput-new">選擇圖片</span><span class="fileinput-exists">更換圖片</span>
	                                            <input type="file" name="sv_value"></span>
	                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移除圖片</a>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        <?php } else { ?>
								<div class="form-group">
									<div class="col-md-12">
										<div class="control-label col-md-2">值：</div>
										<div class="col-md-10">
											<div class="input-icon right">
												<input type="text" placeholder="值" class="form-control" name="sv_value" value="<?=(isset($variable["sv_value"])? $variable["sv_value"] : "") ?>" />
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回系統變數列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">儲存修改</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>