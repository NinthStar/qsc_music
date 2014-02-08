<link rel="stylesheet" href="/qsc_music/css/form.css"></link>
<div id="form-background">
	<form class="style-center" name="register" method="POST">
		<h2>注册</h2>
		<p>标注<red>*</red>项为必填项</p>
		
		<hr/>
		<h3>个人信息</h3>
		<div class="form-element">
			<label>姓名<red>*</red></label>
			<input type="text" name="userName" />
		</div>
		<div class="form-element">
			<label>艺名</label>
			<input type="text" name="nickName" />
		</div>
		<br/>
		<div class="form-element">
			<label>密码<red>*</red></label>
			<input type="password" name="password" />
		</div>
		<div class="form-element">
			<label>重复密码<red>*</red></label>
			<input type="password" name="password2" />
		</div>
		<br/>
		<div class="form-element">
			<label>自我介绍</label>
			<textarea name="selfIntro" maxlength="100" placeholder="自我介绍不得超过100字"></textarea>
		</div>
		
		<hr/>
		<h3>联系方式</h3>
		<div class="form-element">
			<label>Tel 1<red>*</red></label>
			<input type="text" name="tel1"/>
		</div>
		<div class="form-element">
			<label>Tel 2</label>
			<input type="text" name="tel2" />
		</div>
		<br/>
		<div class="form-element">
			<label>学校<red>*</red></label>
			<input type="text" name="schoolId" />
		</div>
		<div class="form-element">
			<label>E-mail</label>
			<input type="text" name="emailAddress" />
		</div>
		<br/>
		<div class="form-element">
			<label>QQ</label>
			<input type="text" name="qq" />
		</div>
		<div class="form-element">
			<label>微信</label>
			<input type="text" name="wechat" />
		</div>
		<br/>
		<div class="form-element">
			<label>是否公开信息<red>*</red></label>
			<input type="radio" name="ifOpen" value="1">公开联系方式</input>
			<input type="radio" name="ifOpen" checked value="0">不公开联系方式</input>
		</div>
		
		<hr/>
		<div class="form-element">
			<label>验证码<red>*</red></label>
			<input class="style-left" type="text" name="captcha"></input>
			<div class="style-left" id="captcha-img"></div>
			<div class="style-left" id="refresh-captcha">看不清？</div>
			<div class="style-clear"></div>
		</div>
		
		<hr/>
		<input id="register" class="style-left" type="submit" value="提交" />
		<div id="error-info"></div>
		<input class="style-right" type="reset" value="重置" />
		<div class="style-clear"></div>
	</form>
</div>
<script type="text/javascript" src="js/form.js"></script>
