// Spinner
function NeteaseVideoPlayer (elem) {
	this.elem = elem;
	this.elem.neteaseVideoPlayer = this;
	this.url = this.elem.data("url");
	this.topicid = this.elem.data("topicid");
	this.sid = this.elem.data("sid");
	this.vid = this.elem.data("vid");
	this.thumb = this.elem.data("thumb");
	this.autoplay = this.elem.data("autoplay") !== "false";
	this.init();
}

Object.assign(NeteaseVideoPlayer, {
	init: function () {
		document.querySelectorAlways(".NeteaseVideoPlayer", NeteaseVideoPlayer.create);
	},
	create: function (elem) {
		return new NeteaseVideoPlayer(elem);
	},
	createElement: function (options) {
		var elem = document.createElement("div");
		elem.classList.add("NeteaseVideoPlayer");
		elem.data("url", options.url);
		elem.data("topicid", options.topicid);
		elem.data("vid", options.vid);
		elem.data("sid", options.sid);
		elem.data("thumb", options.thumb);
		elem.data("autoplay", options.autoplay);
		return elem;
	},
	createPlayerElement: function (options) {
		var elem = document.createElement("object");
		elem.classList.add("NeteaseVideoPlayer-player");
		elem.attr("width", "100%");
		elem.attr("height", "100%");
		elem.attr("data", "https://nos.163.com/wow/1/swf/NetEaseFlvPlayerV3.swf");
		elem.attr("type", "application/x-shockwave-flash");
		elem.attr("bgcolor", "#000000");

		function buildQueryString () {
			var autoplay = (options.autoplay != undefined) ? options.autoplay : true;
			var queryString = [
				"topicid=" + options.topicid,
				"vid=" + options.vid,
				"sid=" + options.sid,
				"autoplay=" + autoplay
			];
			if (options.thumb) { queryString.push("coverpic=" + encodeURIComponent(options.thumb)); }
			return queryString.join("&");
		}

		var backgroundColor = document.createElement("param");
		backgroundColor.attr("name", "bgcolor");
		backgroundColor.attr("value", "000000");

		var allowFullScreenParam = document.createElement("param");
		allowFullScreenParam.attr("name", "AllowFullScreen");
		allowFullScreenParam.attr("value", "true");

		var allowScriptAccessParam = document.createElement("param");
		allowScriptAccessParam.attr("name", "AllowScriptAccess");
		allowScriptAccessParam.attr("value", "always");

		var allowNetworkingParam = document.createElement("param");
		allowNetworkingParam.attr("name", "allowNetworking");
		allowNetworkingParam.attr("value", "all");

		var nameParam = document.createElement("param");
		nameParam.attr("name", "movie");
		nameParam.attr("value", "https://nos.163.com/wow/1/swf/NetEaseFlvPlayerV3.swf");

		var flashVarsParam = document.createElement("param");
		flashVarsParam.attr("name", "flashvars");
		flashVarsParam.attr("value", buildQueryString());

		elem.appendChild(backgroundColor);
		elem.appendChild(allowFullScreenParam);
		elem.appendChild(allowScriptAccessParam);
		elem.appendChild(allowNetworkingParam);
		elem.appendChild(nameParam);
		elem.appendChild(flashVarsParam);

		return elem;
	},
	parseUrl: function (url) {
		//                                                                   __1_
		// matches http://v.163.com/swf/video/NetEaseFlvPlayerV3.swf?topicid=0031&vid=VBRL45Q7S&sid=VAVEEQJ2H
		var topicid = /(?:(?:\?|&)topicid=)([-\w]+)/.exec(url);
		//                                                                            ____1____
		// matches http://v.163.com/swf/video/NetEaseFlvPlayerV3.swf?topicid=0031&vid=VBRL45Q7S&sid=VAVEEQJ2H
		var vid = /(?:(?:\?|&)vid=)([-\w]+)/.exec(url);
		//                                                                                          ____1____
		// matches http://v.163.com/swf/video/NetEaseFlvPlayerV3.swf?topicid=0031&vid=VBRL45Q7S&sid=VAVEEQJ2H
		var sid = /(?:(?:\?|&)sid=)([-\w]+)/.exec(url);
		//                                                                                                             __1_
		// matches http://v.163.com/swf/video/NetEaseFlvPlayerV3.swf?topicid=0031&vid=VBRL45Q7S&sid=VAVEEQJ2H&autoplay=true
		var autoplay = /(?:(?:\?|&)autoplay=)([-\w]+)/.exec(url);
		return {
			topicid: (topicid) ? topicid[1] : null,
			vid: (vid) ? vid[1] : null,
			sid: (sid) ? sid[1] : null,
			autoplay: (autoplay) ? autoplay[1] : null,
			thumb: this.thumb || null
		};
	}
});

NeteaseVideoPlayer.prototype = {
	init: function () {
		var parsedOptions = NeteaseVideoPlayer.parseUrl(this.url || "");
		this.topicid = parsedOptions.topicid || this.topicid;
		this.vid = parsedOptions.vid || this.vid;
		this.sid = parsedOptions.sid || this.sid;
		this.autoplay = parsedOptions.autoplay || this.autoplay;
		var playerElem = NeteaseVideoPlayer.createPlayerElement({
			topicid: this.topicid,
			vid: this.vid,
			sid: this.sid,
			autoplay: this.autoplay
		});
		this.playerElem = playerElem;
		this.elem.appendChild(playerElem);
	}
};

NeteaseVideoPlayer.init();

module.exports = NeteaseVideoPlayer;



// WEBPACK FOOTER //
// ./static/components/NeteaseVideoPlayer/NeteaseVideoPlayer.js