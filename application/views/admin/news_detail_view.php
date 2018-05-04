<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i> <span
							class="caption-subject font-blue-madison bold uppercase">最新消息資料</span>
					</div>
				</div>
				<div class="portlet-body form">

					<form id="data-form" class="form-horizontal"
						enctype="multipart/form-data" role="form" method="post">
						<input type="hidden" name="n_id"
							value="<?=(isset($news['n_id']))? $news['n_id'] : 0?>" />
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">標題：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="標題" class="form-control" name="n_title" value="<?=(isset($news["n_title"])? $news["n_title"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">內容：</div>
									<div class="col-md-10">
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-icon right">
													<textarea name="n_content"
														class="form-control todo-taskbody-taskdesc" rows="8"
														placeholder="內容"><?=(isset($news["n_content"])? $news["n_content"] : "") ?></textarea>
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
		                                        <input type="radio" name="n_status" id="n_status1" value="1" <?=(isset($news['n_status']) && $news['n_status'] == '1')? 'checked' : 'checked'?>> 啟用 </label>
		                                    <label class="radio-inline">
		                                        <input type="radio" name="n_status" id="n_status2" value="2" <?=(isset($news['n_status']) && $news['n_status'] == '2')? 'checked' : ''?>> 停用 </label>
		                                </div>
		                            </div>
	                            </div>
                            </div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">上架日期：</div>
									<div class="col-md-10">
										<div class="input-icon right">											
											<input name="n_post" class="form-control form-control-inline date-picker" type="text" value="<?=(isset($news["n_post"])? substr($news["n_post"], 0, 10) : "") ?>">											
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回最新消息列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">儲存修改</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>