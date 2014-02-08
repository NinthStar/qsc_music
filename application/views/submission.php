<link rel="stylesheet" href="/css/form.css"></link>
<div id="form-background">
	<form class="style-center" name="submission" method="POST">
		<h2>提交我的音乐</h2>
		<p>标注<red>*</red>项为必填项</p>
		
		<hr/>
		<h3>音乐信息</h3>
		<div class="form-element">
			<label>歌/曲名<red>*</red></label>
			<input type="text" name="musicName"/>
		</div>
		<div class="form-element">
			<label>风格<red>*</red></label>
			<input class="select" input-group="styleId" readonly value="请选择风格"/>
			<input id="styleId" type="hidden" value="0"/>
			<div class="select" input="styleId">
				<div>
					<div class="option activated" input-group="styleId" value="0">请选择风格</div>
					<div class="option" input-group="styleId" value="1">流行</div>
				</div>
				<div>
					<div class="option" input-group="styleId" value="2">摇滚</div>
					<div class="option" input-group="styleId" value="3">民谣</div>
				</div>
				<div>
					<div class="option" input-group="styleId" value="4">电子</div>
					<div class="option" input-group="styleId" value="5">节奏布鲁斯</div>
				</div>
				<div>
					<div class="option" input-group="styleId" value="6">爵士</div>
					<div class="option" input-group="styleId" value="7">说唱</div>
				</div>
				<div>
					<div class="option" input-group="styleId" value="8">金属</div>
					<div class="option" input-group="styleId" value="9">古典</div>
				</div>
				<div>
					<div class="option" input-group="styleId" value="10">轻音乐</div>
					<div class="option" input-group="styleId" value="11">雷鬼</div>
				</div>
				<div>
					<div class="option" input-group="styleId" value="12">拉丁</div>
					<div class="option" input-group="styleId" value="13">乡村</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="form-element">
			<label>音乐文件<red>*</red></label>
			<input type="file" />
		</div>
		<br/>
		<div class="form-element">
			<label>创作故事</label>
			<textarea name="description" maxlength="300" placeholder="创作故事不得大于300字"></textarea>
		</div>
		<br/>
		<div class="form-element">
			<label>表演<red>*</red></label>
			<input type="radio" name="ifPerformance" checked value="1" />能够自行表演
			<input type="radio" name="ifPerformance" value="0" />另找乐团表演
		</div>
		
		<hr/>
		<input id="submission" class="style-left" type="submit" value="提交" />
		<div id="error-info"></div>
		<input class="style-right" type="reset"  value="重置" />
		<div class="style-clear"></div>
	</form>
</div>
<script type="text/javascript" src="/js/form.js"></script>
