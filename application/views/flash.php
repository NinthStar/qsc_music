<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title> Music </title>
		<link rel="stylesheet" href="css/template.css" />
		<link rel="stylesheet" href="js/jPlayer/skin.css" />
		<script type="text/javascript" src="js/jQuery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/jPlayer/jQuery.jPlayer.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$("#jquery_jplayer_1").jPlayer({
					ready    : function () {
						$(this).jPlayer("setMedia", {
							m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
							oga: "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
						});
					},
					swfPath  : "/js",
					supplied : "m4a, oga"
				});
			});
		</script>
	</head>
	<body>
		<div id="jquery_jplayer_1" class="jp-jplayer"></div>
		<div id="jp_container_1" class="jp-audio">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1"></a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1"></a></li>
						<li><a href="javascript:;" class="jp-stop" tabindex="1"></a></li>
						<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
						<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
						<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume"></a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
					<div class="jp-time-holder">
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>
	</body>
</html>
