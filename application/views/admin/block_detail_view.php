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
						<input type="hidden" name="ib_id" value="<?=(isset($block['ib_id']))? $block['ib_id'] : 0?>" />
						<div class="form-body">														
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">區塊名稱：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="區塊名稱" class="form-control" name="ib_title" value="<?=(isset($block["ib_title"])? $block["ib_title"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">區塊連結：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="區塊連結" class="form-control" name="ib_link" value="<?=(isset($block["ib_link"])? $block["ib_link"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group ">
                                <label class="control-label col-md-2">商店照：</label>
                                <div class="col-md-10">                                  
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        	<?php if (isset($block['ib_cover']) && $block['ib_cover']) { ?>
                                                <img src="/public/upload/block/<?=$block['ib_cover']?>" alt="" />
                                           	<?php } ?>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">選擇圖片</span><span class="fileinput-exists">更換圖片</span>
                                            <input type="file" name="ib_cover"></span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移除圖片</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">連結類型：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<select class="form-control" name="ib_target">
												<option value="">請選擇</option>
												<?php if (!empty($link_types)): ?>
													<?php foreach ($link_types as $value=>$name): ?>
														<option value="<?=$value?>" <?=(isset($block["ib_target"]) && $block["ib_target"] == $value)? 'selected' : ''?>><?=$name?></option>
													<?php endforeach; ?>
												<?php endif;?>											
											</select>
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
		                                        <input type="radio" name="ib_status" id="ib_status1" value="1" <?=(isset($block['ib_status']) && $block['ib_status'] == '1')? 'checked' : 'checked'?>> 啟用 </label>
		                                    <label class="radio-inline">
		                                        <input type="radio" name="ib_status" id="ib_status2" value="2" <?=(isset($block['ib_status']) && $block['ib_status'] == '2')? 'checked' : ''?>> 停用 </label>
		                                </div>
		                            </div>
	                            </div>
                            </div>
							
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回首頁區塊列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">儲存修改</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>