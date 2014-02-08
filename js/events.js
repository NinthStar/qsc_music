var player = null,
	audio = null,
	outerWidth = 640;

$(document).ready(function () {
	player = $("#player");
	$("#play-btn").bind("click", playBtn);
	$("#stop-btn").bind("click", stopBtn);
	$("#up-btn"  ).bind("click", upBtn  );
	$("#progress-outer").bind("click", progressBarOnclick);
	$("#progress-outer").width(outerWidth + 4 + "px");
});

function playBtn() {
	var audioURL = $("#audio-url").html();
	audio = $("#audio");
	if (!audio.get(0)) {
		audio = $(document.createElement("audio"));
		var source = $(document.createElement("source"));
		audio.attr("id", "audio");
		audio.attr("loop", "loop");
		source.attr("src", audioURL);
		source.attr("type", "audio/mpeg");
		audio.append(source);
		player.append(audio);
		audio.get(0).addEventListener("timeupdate", progressBarUpdate, true);
	}
	
	if (audio.get(0).paused) {
		audio.get(0).play();
		$(this).html("Pause");
	} else {
		audio.get(0).pause();
		$(this).html("Play");
	}
}
function stopBtn() {
	if (audio && audio.get(0)) {
		audio.remove();
		audio = null;
		$("#progress-inner").width(0);
		$("#play-btn").html("Play");
	}
}
function upBtn() {

}

function progressBarUpdate() {
	if (!audio || !audio.get(0)) {
		return false;
	}
	var currentTime = Math.round(audio.get(0).currentTime),
		totalTime   = Math.round(audio.get(0).duration),
		innerWidth  = Math.round(currentTime / totalTime * outerWidth);
	$("#progress-inner").width(innerWidth + "px");
}
function progressBarOnclick(evt) {
	if (!audio || !audio.get(0)) {
		return false;
	}
	var x = evt.pageX - document.getElementById("progress-outer").scrollLeft;
	audio.get(0).currentTime = Math.round((x - 4) / outerWidth * audio.duration);
	if (audio.get(0).paused) {
		audio.get(0).play();
	}
}
