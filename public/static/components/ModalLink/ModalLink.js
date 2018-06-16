//	ModalLink
function ModalLink (elem) {
	this.elem = elem;
	this.elem.modalLink = this;
	this.modalType = elem.data("modal");
	this.youtubeId = elem.data("youtube-id");
	this.neteaseId = elem.data("netease-id");
	this.contentFlex = elem.data("content-flex");
	this.init();
}

Object.assign(ModalLink, {
	html: {},
	activeModal: null,
	buildModal: function (modalType, modalLinkElem) {
		var name = modalLinkElem.data("modal-name");
		var youtubeId = modalLinkElem.data("youtube-id");
		var neteaseId = modalLinkElem.data("netease-id");
		var contentFlex = modalLinkElem.data("content-flex");

		var url = modalLinkElem.attr("href");

		var modal = document.createElement("div");
		modal.classList.add("Modal");

		var modalBackdrop = document.createElement("div");
		modalBackdrop.classList.add("Modal-backdrop");
		modalBackdrop.addEventListener("click", ModalLink.closeModal);

		var modalDialog = document.createElement("div");
		modalDialog.classList.add("Modal-dialog");
		modalDialog.addEventListener("click", ModalLink.closeModal);

		var modalClose = document.createElement("div");
		modalClose.classList.add("Modal-close");
		modalClose.addEventListener("click", ModalLink.closeModal);

		var modalCloseIcon = document.createElement("div");
		modalCloseIcon.classList.add("Icon");
		modalCloseIcon.classList.add("Icon--closeGold");
		modalCloseIcon.classList.add("Modal-closeIcon");

		var modalContent = document.createElement("div");
		modalContent.classList.add("Modal-content");

		if (contentFlex) {
			modalContent.classList.add("Modal-content-flex");
		}

		modalContent.addEventListener("click", ModalLink.closeModal);

		var content;
		if (modalType == "video") {
			if (youtubeId) {
				content = ModalLink.buildYouTubePlayer(youtubeId);
			} else {
				var topicId = modalLinkElem.data("netease-topic-id");
				var sid = modalLinkElem.data("netease-sid");
				var coverPicUrl = modalLinkElem.data("netease-coverpic");
				var fallbackText = modalLinkElem.data("netease-fallback-text");
				var fallbackLinkLabel = modalLinkElem.data("netease-fallback-link-label");
				var fallbackLinkUrl = modalLinkElem.data("netease-fallback-link-url");
				content = ModalLink.buildNetEasePlayer(neteaseId, topicId, sid, coverPicUrl, fallbackText, fallbackLinkLabel, fallbackLinkUrl);
			}
		} else if (modalType == "image") {
			content = ModalLink.buildImage(url);
		} else if (modalType == "comic") {
			var comicUrl = modalLinkElem.data("comic-url");
			content = ModalLink.buildComicViewer(comicUrl);

			modalDialog.classList.add("Modal-dialog--comic");
		} else if (modalType == "html") {
			var isInline = name || url[0] == "#";
			if (isInline) {
				name = name || url.slice(1);
				function find (name) {
					return document.querySelector("[data-modal-name=\"" + name + "\"]")
					    || document.getElementById(name);
				}
				content = ModalLink.html[name];
				if (!content) {
					content = ModalLink.html[name] = find(name);
				}
			} else {
				content = AjaxContent.createElement({ url: url });
			}
		}

		if (content) {
			modalContent.appendChild(content);
		}

		modalClose.appendChild(modalCloseIcon);
		modalDialog.appendChild(modalContent);
		modalDialog.appendChild(modalClose);
		modal.appendChild(modalBackdrop);
		modal.appendChild(modalDialog);

		ModalLink.pauseVideos();
		document.body.appendChild(modal);
		ModalLink.activeModal = modal;
	},
	buildComicViewer: function (comicUrl) {
		var comicViewer = document.createElement("iframe");
		comicViewer.classList.add("Modal-comic");
		comicViewer.attr("src", comicUrl + "/modal");
		comicViewer.attr("frameborder", "0");
		comicViewer.attr("allowfullscreen", true);
		return comicViewer;
	},
	buildYouTubePlayer: function (videoId) {
		var youtubePlayer = document.createElement("iframe");
		youtubePlayer.classList.add("Modal-video");
		youtubePlayer.attr("src", "//www.youtube.com/embed/" + videoId + "?autoplay=1");
		youtubePlayer.attr("frameborder", "0");
		youtubePlayer.attr("allowfullscreen", true);
		return youtubePlayer;
	},
	buildNetEasePlayer: function (videoId, topicId, sid, coverPicUrl, fallbackText, fallbackLinkLabel, fallbackLinkUrl) {
		var neteasePlayer = document.createElement("object");
		neteasePlayer.classList.add("Modal-video");
		neteasePlayer.attr("width", "100%");
		neteasePlayer.attr("height", "100%");
		neteasePlayer.attr("data", "https://nos.163.com/wow/1/swf/NetEaseFlvPlayerV3.swf");
		neteasePlayer.attr("type", "application/x-shockwave-flash");

		// Net Ease player wants an object tag instead of an iframe so here we set up params
		var neteaseParam1 = document.createElement("param");
		var neteaseParam2 = document.createElement("param");
		var neteaseParam3 = document.createElement("param");
		var neteaseParam4 = document.createElement("param");

		function queryStringBuilder (videoId, topicId, sid, coverPicUrl) {
			var queryString = [
				"topicid=" + topicId,
				"vid=" + videoId,
				"sid=" + sid,
				"coverpic=" + coverPicUrl,
				"autoplay=" + "true"
			].join('&');
			return queryString;
		}

		neteaseParam1.attr("value", "true");
		neteaseParam1.attr("name", "allowFullScreen");

		neteaseParam2.attr("value", "always");
		neteaseParam2.attr("name", "allowscriptaccess");

		neteaseParam3.attr("value", "https://nos.163.com/wow/1/swf/NetEaseFlvPlayerV3.swf");
		neteaseParam3.attr("allownetworking", "all");
		neteaseParam3.attr("name", "movie");

		neteaseParam4.attr("value", queryStringBuilder(videoId, topicId, sid, coverPicUrl));
		neteaseParam4.attr("name", "flashvars");

		// Bind netease Params to netease player
		neteasePlayer.appendChild(neteaseParam1);
		neteasePlayer.appendChild(neteaseParam2);
		neteasePlayer.appendChild(neteaseParam3);
		neteasePlayer.appendChild(neteaseParam4);

		//	Fallback messaging for users that don't have the Flash Player installed.
		var fallbackContent = ModalLink.buildNetEaseFallback(fallbackText, fallbackLinkLabel, fallbackLinkUrl);
		if (fallbackContent) {
			neteasePlayer.appendChild(fallbackContent);
		}

		return neteasePlayer;
	},
	buildNetEaseFallback: function (fallbackText, fallbackLinkLabel, fallbackLinkUrl) {
		if (!fallbackText) {
			return false;
		}

		var neteaseFallback = document.createElement("div");
		neteaseFallback.classList.add("Modal-videoFallback");

		var neteaseFallbackMessage = document.createElement("p");
		var neteaseFallbackText = document.createTextNode(fallbackText);
		neteaseFallbackMessage.classList.add("Modal-videoFallbackMessage");
		neteaseFallbackMessage.appendChild(neteaseFallbackText);

		if (fallbackLinkLabel && fallbackLinkUrl) {
			var neteaseFallbackLink = document.createElement("a");
			var neteaseFallbackLinkText = document.createTextNode(fallbackLinkLabel);
			neteaseFallbackLink.attr("href", fallbackLinkUrl);
			neteaseFallbackLink.classList.add("Modal-videoFallbackLink");
			neteaseFallbackLink.appendChild(neteaseFallbackLinkText);
			neteaseFallbackMessage.appendChild(neteaseFallbackLink);
		}

		neteaseFallback.appendChild(neteaseFallbackMessage);
		return neteaseFallback;
	},
	buildImage: function (url) {
		var image = document.createElement("img");
		image.classList.add("Modal-image");
		image.attr("src", url);
		return image;
	},
	buildHTML: function (content) {
		var modal = document.createElement("div");
		modal.classList.add("Modal-html");
		if (content) {
			content.style.display = "block";
			content.classList.remove("hide");
			modal.appendChild(content);
		}
		return modal;
	},
	closeModal: function (event) {
		if (this != event.target) {
			return;
		}
		if (ModalLink.activeModal) {
			ModalLink.resumeVideos();
			document.body.removeChild(ModalLink.activeModal);
			ModalLink.activeModal = null;
		}
	},
	pauseVideos: function () {
		if (!ModalLink.videos) {
			ModalLink.videos = [];
		}
		document.querySelectorAll("video").map(function (video) {
			if (!video.paused) {
				video.pause();
				ModalLink.videos.push(video);
			}
		});
	},
	resumeVideos: function () {
		if (ModalLink.videos) {
			ModalLink.videos.map(function (video) {
				video.play();
			})
			ModalLink.videos = null;
		}
	},
	create: function (elem) {
		return new ModalLink(elem);
	},
	init: function () {
		document.querySelectorAlways(".ModalLink", ModalLink.create);
		document.addEventListener("keydown", ModalLink.keydown.bind(this));
	},
	stop: function (event) {
		event.preventDefault();
		event.stopPropagation();
	},
	keydown: function (event) {
		switch (event.keyCode || event.which) {
			case 27: //Esc
				ModalLink.closeModal(event);
				break;
		}
	}
});

ModalLink.prototype = {
	init: function () {
		if (this.elem.classList.contains("lightbox")) {
			this.modalType = "image";
		}
		if (this.modalType == "comic" || this.modalType == "image" || this.modalType == "html" || this.modalType == "video" && (this.youtubeId || this.neteaseId ) && supports.video) {
			this.elem.addEventListener("click", this.onclick.bind(this));
		}
	},
	onclick: function (event) {
		if (media.matches["media-wide"] || this.modalType == "html") {
			this.buildModal();
			ModalLink.stop(event);
		}
	},
	buildModal: function () {
		ModalLink.buildModal(this.modalType, this.elem);
	}
};

ModalLink.init();

module.exports = ModalLink;



// WEBPACK FOOTER //
// ./static/components/ModalLink/ModalLink.js