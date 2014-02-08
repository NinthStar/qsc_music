$(document).ready(function () {
	$("div[input-group=styleId]").css({"left" : "493px",
	                                   "top"  : "144px"});
	
	resetForm();
	
	$("#refresh-captcha" ).bind("click", refreshCaptcha);
	$("input.select"     ).bind("click", selectOnselect);
	$("div.option"       ).bind("click", optionOnselect);
	$("#register"        ).bind("click", register);
	$("#submission"      ).bind("click", submission);
	$("input[type=reset]").bind("click", resetForm);
});

function refreshCaptcha() {
	$.get("index.php/user/get_captcha", function (data, status) {
		if (status === "success") {
			$("#captcha-img").html("");
			$("#captcha-img").append(data);
		}
	}, "HTML");
}

function selectOnselect() {
	var input = $(this).attr("input-group");
	
	$("div.option[input-group=" + input + "]").css("display", "inline-block");
}
function optionOnselect() {
	var value = $(this).attr("value"),
		input = $(this).attr("input-group");
	
	$("#" + input).val(value);
	$("input[input-group=" + input + "]").val($(this).html());
	$("div.option.activated").attr("class", "option");
	$(this).attr("class", "option activated");
	
	$("div.option").css("display", "none");
}

function register(evt) {
	evt.preventDefault();
	if ($("input[name=userName]" ).val() === "" ||
		$("input[name=password]" ).val() === "" ||
		$("input[name=password2]").val() === "" ||
		$("input[name=tel1]"     ).val() === "" ||
		$("input[name=schoolId]" ).val() === "" ||
		$("input[name=captcha]"  ).val() === ""
	) {
		$("#error-info").html("请填写带<red>*</red>的项目");
		return false;
	} else {
		$.post("index.php/user/register",
			{
				"userName"     : $("input[name=userName]"    ).val(),
				"nickName"     : $("input[name=nickName]"    ).val(),
				"password"     : $("input[name=password]"    ).val(),
				"selfIntro"    : $("input[name=selfIntro]"   ).val(),
				"tel1"         : $("input[name=tel1]"        ).val(),
				"tel2"         : $("input[name=tel2]"        ).val(),
				"schoolId"     : $("input[name=schoolId]"    ).val(),
				"emailAddress" : $("input[name=emailAddress]").val(),
				"qq"           : $("input[name=qq]"          ).val(),
				"wechat"       : $("input[name=wechat]"      ).val(),
				"ifOpen"       : $("input[name=ifOpen]"      ).val(),
				"captcha"      : $("input[name=captcha]"     ).val()
			},
			function (data, status) {
				if (status === "success") {
					switch (data.ifSuccess) {
					case 1:
						break;
					case 0:
						$("#error-info").html(data.error);
						break;
					case -1:
						$("#error-info").html("用户已注册！");
						break;
					case -2:
						$("#error-info").html("您已经登录！");
						break;
					case -3:
						$("#error-info").html("验证码不正确！");
						break;
					default:
						break;
					}
				} else {
					$("#error-info").html("服务器异常，请稍后再试。");
				}
			}
		, "JSON");
	}
}
function submission(evt) {
	evt.preventDefault();
	if ($("input[name=musicName]" ).val() === "" ||
		$("input[name=styleId]" ).val() === 0 ||
		$("input[name=file]").val() === undefined
	) {
		$("#error-info").html("请填写带<red>*</red>的项目");
		return false;
	} else {
		
	}
}

function resetForm() {
	refreshCaptcha();
	$("#error-info").html("");
	$("div.option").css("display", "none");
}
