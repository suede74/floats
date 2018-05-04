<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i> <span
							class="caption-subject font-blue-madison bold uppercase">輪播資料</span>
					</div>
				</div>
				<div class="portlet-body form">

					<form id="data-form" class="form-horizontal"
						enctype="multipart/form-data" role="form" method="post">
						<input type="hidden" name="is_id" value="<?=(isset($slide['is_id']))? $slide['is_id'] : 0?>" />
						<div class="form-body">														
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">輪播名稱：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="輪播名稱" class="form-control" name="is_title" value="<?=(isset($slide["is_title"])? $slide["is_title"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">輪播連結：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="區塊連結" class="form-control" name="is_link" value="<?=(isset($slide["is_link"])? $slide["is_link"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group ">
                                <label class="control-label col-md-2">輪播圖：</label>
                                <div class="col-md-10">                                  
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        	<?php if (isset($slide['is_image']) && $slide['is_image']) { ?>
                                                <img src="/public/upload/slide/<?=$slide['is_image']?>" alt="" />
                                           	<?php } ?>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">選擇圖片</span><span class="fileinput-exists">更換圖片</span>
                                            <input type="file" name="is_image"></span>
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
		                                        <input type="radio" name="is_status" id="is_status1" value="1" <?=(isset($slide['is_status']) && $slide['is_status'] == '1')? 'checked' : 'checked'?>> 啟用 </label>
		                                    <label class="radio-inline">
		                                        <input type="radio" name="is_status" id="is_status2" value="2" <?=(isset($slide['is_status']) && $slide['is_status'] == '2')? 'checked' : ''?>> 停用 </label>
		                                </div>
		                            </div>
	                            </div>
                            </div>
							
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回首頁輪播列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">儲存修改</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>