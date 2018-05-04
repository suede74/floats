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
						<input type="hidden" name="s_id" value="<?=(isset($store['s_id']))? $store['s_id'] : 0?>" />
						<div class="form-body">														
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">商店名稱：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="商店名稱" class="form-control" name="s_name" value="<?=(isset($store["s_name"])? $store["s_name"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">商店說明：</div>
									<div class="col-md-10">
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-icon right">
													<textarea name="s_description"
														class="form-control todo-taskbody-taskdesc" rows="8"
														placeholder="商店說明"><?=(isset($store["s_description"])? $store["s_description"] : "") ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group ">
                                <label class="control-label col-md-2">商店照：</label>
                                <div class="col-md-10">                                  
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        	<?php if (isset($store['s_cover']) && $store['s_cover']) { ?>
                                                <img src="/public/upload/store/<?=$store['s_cover']?>" alt="" />
                                           	<?php } ?>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">選擇圖片</span><span class="fileinput-exists">更換圖片</span>
                                            <input type="file" name="s_cover"></span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移除圖片</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">地圖：</div>
									<div class="col-md-10">
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-icon right">
													<textarea name="s_map"
														class="form-control todo-taskbody-taskdesc" rows="8"
														placeholder="嵌入碼"><?=(isset($store["s_map"])? $store["s_map"] : "") ?></textarea>
												</div>
											</div>
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
		                                        <input type="radio" name="s_status" id="s_status1" value="1" <?=(isset($store['s_status']) && $store['s_status'] == '1')? 'checked' : 'checked'?>> 啟用 </label>
		                                    <label class="radio-inline">
		                                        <input type="radio" name="s_status" id="s_status2" value="2" <?=(isset($store['s_status']) && $store['s_status'] == '2')? 'checked' : ''?>> 停用 </label>
		                                </div>
		                            </div>
	                            </div>
                            </div>
							
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回商店列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">儲存修改</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>