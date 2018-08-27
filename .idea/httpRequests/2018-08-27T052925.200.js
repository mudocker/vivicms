/*
 * jPlayer Plugin for jQuery JavaScript Library
 * http://www.jplayer.org
 *
 * Copyright (c) 2009 - 2014 Happyworm Ltd
 * Licensed under the MIT license.
 * http://opensource.org/licenses/MIT
 *
 * Author: Mark J Panaghiston
 * Version: 2.6.0
 * Date: 2nd April 2014
 */

(function (b, f) {
    "function" === typeof define && define.amd ? define(["jquery"], f) : b.jQuery ? f(b.jQuery) : f(b.Zepto)
})(this, function (b, f) {
    b.fn.jPlayer = function (a) {
        var c = "string" === typeof a, d = Array.prototype.slice.call(arguments, 1), e = this;
        a = !c && d.length ? b.extend.apply(null, [!0, a].concat(d)) : a;
        if (c && "_" === a.charAt(0)) return e;
        c ? this.each(function () {
            var c = b(this).data("jPlayer"), h = c && b.isFunction(c[a]) ? c[a].apply(c, d) : c;
            if (h !== c && h !== f) return e = h, !1
        }) : this.each(function () {
            var c = b(this).data("jPlayer");
            c ? c.option(a ||
                {}) : b(this).data("jPlayer", new b.jPlayer(a, this))
        });
        return e
    };
    b.jPlayer = function (a, c) {
        if (arguments.length) {
            this.element = b(c);
            this.options = b.extend(!0, {}, this.options, a);
            var d = this;
            this.element.bind("remove.jPlayer", function () {
                d.destroy()
            });
            this._init()
        }
    };
    "function" !== typeof b.fn.stop && (b.fn.stop = function () {
    });
    b.jPlayer.emulateMethods = "load play pause";
    b.jPlayer.emulateStatus = "src readyState networkState currentTime duration paused ended playbackRate";
    b.jPlayer.emulateOptions = "muted volume";
    b.jPlayer.reservedEvent =
        "ready flashreset resize repeat error warning";
    b.jPlayer.event = {};
    b.each("ready setmedia flashreset resize repeat click error warning loadstart progress suspend abort emptied stalled play pause loadedmetadata loadeddata waiting playing canplay canplaythrough seeking seeked timeupdate ended ratechange durationchange volumechange".split(" "), function () {
        b.jPlayer.event[this] = "jPlayer_" + this
    });
    b.jPlayer.htmlEvent = "loadstart abort emptied stalled loadedmetadata loadeddata canplay canplaythrough".split(" ");
    b.jPlayer.pause = function () {
        b.each(b.jPlayer.prototype.instances, function (a, c) {
            c.data("jPlayer").status.srcSet && c.jPlayer("pause")
        })
    };
    b.jPlayer.timeFormat = {
        showHour: !1,
        showMin: !0,
        showSec: !0,
        padHour: !1,
        padMin: !0,
        padSec: !0,
        sepHour: ":",
        sepMin: ":",
        sepSec: ""
    };
    var l = function () {
        this.init()
    };
    l.prototype = {
        init: function () {
            this.options = {timeFormat: b.jPlayer.timeFormat}
        }, time: function (a) {
            var c = new Date(1E3 * (a && "number" === typeof a ? a : 0)), b = c.getUTCHours();
            a = this.options.timeFormat.showHour ? c.getUTCMinutes() : c.getUTCMinutes() +
                60 * b;
            c = this.options.timeFormat.showMin ? c.getUTCSeconds() : c.getUTCSeconds() + 60 * a;
            b = this.options.timeFormat.padHour && 10 > b ? "0" + b : b;
            a = this.options.timeFormat.padMin && 10 > a ? "0" + a : a;
            c = this.options.timeFormat.padSec && 10 > c ? "0" + c : c;
            b = "" + (this.options.timeFormat.showHour ? b + this.options.timeFormat.sepHour : "");
            b += this.options.timeFormat.showMin ? a + this.options.timeFormat.sepMin : "";
            return b += this.options.timeFormat.showSec ? c + this.options.timeFormat.sepSec : ""
        }
    };
    var n = new l;
    b.jPlayer.convertTime = function (a) {
        return n.time(a)
    };
    b.jPlayer.uaBrowser = function (a) {
        a = a.toLowerCase();
        var c = /(opera)(?:.*version)?[ \/]([\w.]+)/, b = /(msie) ([\w.]+)/, e = /(mozilla)(?:.*? rv:([\w.]+))?/;
        a = /(webkit)[ \/]([\w.]+)/.exec(a) || c.exec(a) || b.exec(a) || 0 > a.indexOf("compatible") && e.exec(a) || [];
        return {browser: a[1] || "", version: a[2] || "0"}
    };
    b.jPlayer.uaPlatform = function (a) {
        var c = a.toLowerCase(), b = /(android)/, e = /(mobile)/;
        a = /(ipad|iphone|ipod|android|blackberry|playbook|windows ce|webos)/.exec(c) || [];
        c = /(ipad|playbook)/.exec(c) || !e.exec(c) && b.exec(c) ||
            [];
        a[1] && (a[1] = a[1].replace(/\s/g, "_"));
        return {platform: a[1] || "", tablet: c[1] || ""}
    };
    b.jPlayer.browser = {};
    b.jPlayer.platform = {};
    var k = b.jPlayer.uaBrowser(navigator.userAgent);
    k.browser && (b.jPlayer.browser[k.browser] = !0, b.jPlayer.browser.version = k.version);
    k = b.jPlayer.uaPlatform(navigator.userAgent);
    k.platform && (b.jPlayer.platform[k.platform] = !0, b.jPlayer.platform.mobile = !k.tablet, b.jPlayer.platform.tablet = !!k.tablet);
    b.jPlayer.getDocMode = function () {
        var a;
        b.jPlayer.browser.msie && (document.documentMode ?
            a = document.documentMode : (a = 5, document.compatMode && "CSS1Compat" === document.compatMode && (a = 7)));
        return a
    };
    b.jPlayer.browser.documentMode = b.jPlayer.getDocMode();
    b.jPlayer.nativeFeatures = {
        init: function () {
            var a = document, c = a.createElement("video"), b = {
                w3c: "fullscreenEnabled fullscreenElement requestFullscreen exitFullscreen fullscreenchange fullscreenerror".split(" "),
                moz: "mozFullScreenEnabled mozFullScreenElement mozRequestFullScreen mozCancelFullScreen mozfullscreenchange mozfullscreenerror".split(" "),
                webkit: " webkitCurrentFullScreenElement webkitRequestFullScreen webkitCancelFullScreen webkitfullscreenchange ".split(" "),
                webkitVideo: "webkitSupportsFullscreen webkitDisplayingFullscreen webkitEnterFullscreen webkitExitFullscreen  ".split(" ")
            }, e = ["w3c", "moz", "webkit", "webkitVideo"], g, h;
            this.fullscreen = c = {
                support: {
                    w3c: !!a[b.w3c[0]],
                    moz: !!a[b.moz[0]],
                    webkit: "function" === typeof a[b.webkit[3]],
                    webkitVideo: "function" === typeof c[b.webkitVideo[2]]
                }, used: {}
            };
            g = 0;
            for (h = e.length; g < h; g++) {
                var f = e[g];
                if (c.support[f]) {
                    c.spec =
                        f;
                    c.used[f] = !0;
                    break
                }
            }
            if (c.spec) {
                var m = b[c.spec];
                c.api = {
                    fullscreenEnabled: !0, fullscreenElement: function (c) {
                        c = c ? c : a;
                        return c[m[1]]
                    }, requestFullscreen: function (a) {
                        return a[m[2]]()
                    }, exitFullscreen: function (c) {
                        c = c ? c : a;
                        return c[m[3]]()
                    }
                };
                c.event = {fullscreenchange: m[4], fullscreenerror: m[5]}
            } else c.api = {
                fullscreenEnabled: !1, fullscreenElement: function () {
                    return null
                }, requestFullscreen: function () {
                }, exitFullscreen: function () {
                }
            }, c.event = {}
        }
    };
    b.jPlayer.nativeFeatures.init();
    b.jPlayer.focus = null;
    b.jPlayer.keyIgnoreElementNames =
        "INPUT TEXTAREA";
    var p = function (a) {
        var c = b.jPlayer.focus, d;
        c && (b.each(b.jPlayer.keyIgnoreElementNames.split(/\s+/g), function (c, b) {
            if (a.target.nodeName.toUpperCase() === b.toUpperCase()) return d = !0, !1
        }), d || b.each(c.options.keyBindings, function (d, g) {
            if (g && a.which === g.key && b.isFunction(g.fn)) return a.preventDefault(), g.fn(c), !1
        }))
    };
    b.jPlayer.keys = function (a) {
        b(document.documentElement).unbind("keydown.jPlayer");
        a && b(document.documentElement).bind("keydown.jPlayer", p)
    };
    b.jPlayer.keys(!0);
    b.jPlayer.prototype =
        {
            count: 0,
            version: {script: "2.6.0", needFlash: "2.6.0", flash: "unknown"},
            options: {
                swfPath: "js",
                solution: "html, flash",
                supplied: "mp3",
                preload: "metadata",
                volume: 0.8,
                muted: !1,
                remainingDuration: !1,
                toggleDuration: !1,
                playbackRate: 1,
                defaultPlaybackRate: 1,
                minPlaybackRate: 0.5,
                maxPlaybackRate: 4,
                wmode: "opaque",
                backgroundColor: "#000000",
                cssSelectorAncestor: "#jp_container_1",
                cssSelector: {
                    videoPlay: ".jp-video-play",
                    play: ".jp-play",
                    pause: ".jp-pause",
                    stop: ".jp-stop",
                    seekBar: ".jp-seek-bar",
                    playBar: ".jp-play-bar",
                    mute: ".jp-mute",
                    unmute: ".jp-unmute",
                    volumeBar: ".jp-volume-bar",
                    volumeBarValue: ".jp-volume-bar-value",
                    volumeMax: ".jp-volume-max",
                    playbackRateBar: ".jp-playback-rate-bar",
                    playbackRateBarValue: ".jp-playback-rate-bar-value",
                    currentTime: ".jp-current-time",
                    duration: ".jp-duration",
                    title: ".jp-title",
                    fullScreen: ".jp-full-screen",
                    restoreScreen: ".jp-restore-screen",
                    repeat: ".jp-repeat",
                    repeatOff: ".jp-repeat-off",
                    gui: ".jp-gui",
                    noSolution: ".jp-no-solution"
                },
                smoothPlayBar: !1,
                fullScreen: !1,
                fullWindow: !1,
                autohide: {
                    restored: !1, full: !0,
                    fadeIn: 200, fadeOut: 600, hold: 1E3
                },
                loop: !1,
                repeat: function (a) {
                    a.jPlayer.options.loop ? b(this).unbind(".jPlayerRepeat").bind(b.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function () {
                        b(this).jPlayer("play")
                    }) : b(this).unbind(".jPlayerRepeat")
                },
                nativeVideoControls: {},
                noFullWindow: {
                    msie: /msie [0-6]\./,
                    ipad: /ipad.*?os [0-4]\./,
                    iphone: /iphone/,
                    ipod: /ipod/,
                    android_pad: /android [0-3]\.(?!.*?mobile)/,
                    android_phone: /android.*?mobile/,
                    blackberry: /blackberry/,
                    windows_ce: /windows ce/,
                    iemobile: /iemobile/,
                    webos: /webos/
                },
                noVolume: {
                    ipad: /ipad/,
                    iphone: /iphone/,
                    ipod: /ipod/,
                    android_pad: /android(?!.*?mobile)/,
                    android_phone: /android.*?mobile/,
                    blackberry: /blackberry/,
                    windows_ce: /windows ce/,
                    iemobile: /iemobile/,
                    webos: /webos/,
                    playbook: /playbook/
                },
                timeFormat: {},
                keyEnabled: !1,
                audioFullScreen: !1,
                keyBindings: {
                    play: {
                        key: 32, fn: function (a) {
                            a.status.paused ? a.play() : a.pause()
                        }
                    }, fullScreen: {
                        key: 13, fn: function (a) {
                            (a.status.video || a.options.audioFullScreen) && a._setOption("fullScreen", !a.options.fullScreen)
                        }
                    }, muted: {
                        key: 8, fn: function (a) {
                            a._muted(!a.options.muted)
                        }
                    },
                    volumeUp: {
                        key: 38, fn: function (a) {
                            a.volume(a.options.volume + 0.1)
                        }
                    }, volumeDown: {
                        key: 40, fn: function (a) {
                            a.volume(a.options.volume - 0.1)
                        }
                    }
                },
                verticalVolume: !1,
                verticalPlaybackRate: !1,
                globalVolume: !1,
                idPrefix: "jp",
                noConflict: "jQuery",
                emulateHtml: !1,
                consoleAlerts: !0,
                errorAlerts: !1,
                warningAlerts: !1
            },
            optionsAudio: {
                size: {width: "0px", height: "0px", cssClass: ""},
                sizeFull: {width: "0px", height: "0px", cssClass: ""}
            },
            optionsVideo: {
                size: {width: "480px", height: "270px", cssClass: "jp-video-270p"}, sizeFull: {
                    width: "100%", height: "100%",
                    cssClass: "jp-video-full"
                }
            },
            instances: {},
            status: {
                src: "",
                media: {},
                paused: !0,
                format: {},
                formatType: "",
                waitForPlay: !0,
                waitForLoad: !0,
                srcSet: !1,
                video: !1,
                seekPercent: 0,
                currentPercentRelative: 0,
                currentPercentAbsolute: 0,
                currentTime: 0,
                duration: 0,
                remaining: 0,
                videoWidth: 0,
                videoHeight: 0,
                readyState: 0,
                networkState: 0,
                playbackRate: 1,
                ended: 0
            },
            internal: {ready: !1},
            solution: {html: !0, flash: !0},
            format: {
                mp3: {codec: 'audio/mpeg; codecs="mp3"', flashCanPlay: !0, media: "audio"},
                m4a: {
                    codec: 'audio/mp4; codecs="mp4a.40.2"', flashCanPlay: !0,
                    media: "audio"
                },
                m3u8a: {codec: 'application/vnd.apple.mpegurl; codecs="mp4a.40.2"', flashCanPlay: !1, media: "audio"},
                m3ua: {codec: "audio/mpegurl", flashCanPlay: !1, media: "audio"},
                oga: {codec: 'audio/ogg; codecs="vorbis, opus"', flashCanPlay: !1, media: "audio"},
                flac: {codec: "audio/x-flac", flashCanPlay: !1, media: "audio"},
                wav: {codec: 'audio/wav; codecs="1"', flashCanPlay: !1, media: "audio"},
                webma: {codec: 'audio/webm; codecs="vorbis"', flashCanPlay: !1, media: "audio"},
                fla: {codec: "audio/x-flv", flashCanPlay: !0, media: "audio"},
                rtmpa: {codec: 'audio/rtmp; codecs="rtmp"', flashCanPlay: !0, media: "audio"},
                m4v: {codec: 'video/mp4; codecs="avc1.42E01E, mp4a.40.2"', flashCanPlay: !0, media: "video"},
                m3u8v: {
                    codec: 'application/vnd.apple.mpegurl; codecs="avc1.42E01E, mp4a.40.2"',
                    flashCanPlay: !1,
                    media: "video"
                },
                m3uv: {codec: "audio/mpegurl", flashCanPlay: !1, media: "video"},
                ogv: {codec: 'video/ogg; codecs="theora, vorbis"', flashCanPlay: !1, media: "video"},
                webmv: {codec: 'video/webm; codecs="vorbis, vp8"', flashCanPlay: !1, media: "video"},
                flv: {
                    codec: "video/x-flv",
                    flashCanPlay: !0, media: "video"
                },
                rtmpv: {codec: 'video/rtmp; codecs="rtmp"', flashCanPlay: !0, media: "video"}
            },
            _init: function () {
                var a = this;
                this.element.empty();
                this.status = b.extend({}, this.status);
                this.internal = b.extend({}, this.internal);
                this.options.timeFormat = b.extend({}, b.jPlayer.timeFormat, this.options.timeFormat);
                this.internal.cmdsIgnored = b.jPlayer.platform.ipad || b.jPlayer.platform.iphone || b.jPlayer.platform.ipod;
                this.internal.domNode = this.element.get(0);
                this.options.keyEnabled && !b.jPlayer.focus && (b.jPlayer.focus =
                    this);
                this.androidFix = {setMedia: !1, play: !1, pause: !1, time: NaN};
                b.jPlayer.platform.android && (this.options.preload = "auto" !== this.options.preload ? "metadata" : "auto");
                this.formats = [];
                this.solutions = [];
                this.require = {};
                this.htmlElement = {};
                this.html = {};
                this.html.audio = {};
                this.html.video = {};
                this.flash = {};
                this.css = {};
                this.css.cs = {};
                this.css.jq = {};
                this.ancestorJq = [];
                this.options.volume = this._limitValue(this.options.volume, 0, 1);
                b.each(this.options.supplied.toLowerCase().split(","), function (c, d) {
                    var e = d.replace(/^\s+|\s+$/g,
                        "");
                    if (a.format[e]) {
                        var f = !1;
                        b.each(a.formats, function (a, c) {
                            if (e === c) return f = !0, !1
                        });
                        f || a.formats.push(e)
                    }
                });
                b.each(this.options.solution.toLowerCase().split(","), function (c, d) {
                    var e = d.replace(/^\s+|\s+$/g, "");
                    if (a.solution[e]) {
                        var f = !1;
                        b.each(a.solutions, function (a, c) {
                            if (e === c) return f = !0, !1
                        });
                        f || a.solutions.push(e)
                    }
                });
                this.internal.instance = "jp_" + this.count;
                this.instances[this.internal.instance] = this.element;
                this.element.attr("id") || this.element.attr("id", this.options.idPrefix + "_jplayer_" + this.count);
                this.internal.self = b.extend({}, {id: this.element.attr("id"), jq: this.element});
                this.internal.audio = b.extend({}, {id: this.options.idPrefix + "_audio_" + this.count, jq: f});
                this.internal.video = b.extend({}, {id: this.options.idPrefix + "_video_" + this.count, jq: f});
                this.internal.flash = b.extend({}, {
                    id: this.options.idPrefix + "_flash_" + this.count,
                    jq: f,
                    swf: this.options.swfPath + (".swf" !== this.options.swfPath.toLowerCase().slice(-4) ? (this.options.swfPath && "/" !== this.options.swfPath.slice(-1) ? "/" : "") + "Jplayer.swf" : "")
                });
                this.internal.poster = b.extend({}, {id: this.options.idPrefix + "_poster_" + this.count, jq: f});
                b.each(b.jPlayer.event, function (c, b) {
                    a.options[c] !== f && (a.element.bind(b + ".jPlayer", a.options[c]), a.options[c] = f)
                });
                this.require.audio = !1;
                this.require.video = !1;
                b.each(this.formats, function (c, b) {
                    a.require[a.format[b].media] = !0
                });
                this.options = this.require.video ? b.extend(!0, {}, this.optionsVideo, this.options) : b.extend(!0, {}, this.optionsAudio, this.options);
                this._setSize();
                this.status.nativeVideoControls = this._uaBlocklist(this.options.nativeVideoControls);
                this.status.noFullWindow = this._uaBlocklist(this.options.noFullWindow);
                this.status.noVolume = this._uaBlocklist(this.options.noVolume);
                b.jPlayer.nativeFeatures.fullscreen.api.fullscreenEnabled && this._fullscreenAddEventListeners();
                this._restrictNativeVideoControls();
                this.htmlElement.poster = document.createElement("img");
                this.htmlElement.poster.id = this.internal.poster.id;
                this.htmlElement.poster.onload = function () {
                    a.status.video && !a.status.waitForPlay || a.internal.poster.jq.show()
                };
                this.element.append(this.htmlElement.poster);
                this.internal.poster.jq = b("#" + this.internal.poster.id);
                this.internal.poster.jq.css({width: this.status.width, height: this.status.height});
                this.internal.poster.jq.hide();
                this.internal.poster.jq.bind("click.jPlayer", function () {
                    a._trigger(b.jPlayer.event.click)
                });
                this.html.audio.available = !1;
                this.require.audio && (this.htmlElement.audio = document.createElement("audio"), this.htmlElement.audio.id = this.internal.audio.id, this.html.audio.available = !!this.htmlElement.audio.canPlayType && this._testCanPlayType(this.htmlElement.audio));
                this.html.video.available = !1;
                this.require.video && (this.htmlElement.video = document.createElement("video"), this.htmlElement.video.id = this.internal.video.id, this.html.video.available = !!this.htmlElement.video.canPlayType && this._testCanPlayType(this.htmlElement.video));
                this.flash.available = this._checkForFlash(10.1);
                this.html.canPlay = {};
                this.flash.canPlay = {};
                b.each(this.formats, function (c, b) {
                    a.html.canPlay[b] = a.html[a.format[b].media].available && "" !== a.htmlElement[a.format[b].media].canPlayType(a.format[b].codec);
                    a.flash.canPlay[b] = a.format[b].flashCanPlay && a.flash.available
                });
                this.html.desired = !1;
                this.flash.desired = !1;
                b.each(this.solutions, function (c, d) {
                    if (0 === c) a[d].desired = !0; else {
                        var e = !1, f = !1;
                        b.each(a.formats, function (c, b) {
                            a[a.solutions[0]].canPlay[b] && ("video" === a.format[b].media ? f = !0 : e = !0)
                        });
                        a[d].desired = a.require.audio && !e || a.require.video && !f
                    }
                });
                this.html.support = {};
                this.flash.support = {};
                b.each(this.formats, function (c, b) {
                    a.html.support[b] = a.html.canPlay[b] && a.html.desired;
                    a.flash.support[b] = a.flash.canPlay[b] &&
                        a.flash.desired
                });
                this.html.used = !1;
                this.flash.used = !1;
                b.each(this.solutions, function (c, d) {
                    b.each(a.formats, function (c, b) {
                        if (a[d].support[b]) return a[d].used = !0, !1
                    })
                });
                this._resetActive();
                this._resetGate();
                this._cssSelectorAncestor(this.options.cssSelectorAncestor);
                this.html.used || this.flash.used ? this.css.jq.noSolution.length && this.css.jq.noSolution.hide() : (this._error({
                    type: b.jPlayer.error.NO_SOLUTION,
                    context: "{solution:'" + this.options.solution + "', supplied:'" + this.options.supplied + "'}",
                    message: b.jPlayer.errorMsg.NO_SOLUTION,
                    hint: b.jPlayer.errorHint.NO_SOLUTION
                }), this.css.jq.noSolution.length && this.css.jq.noSolution.show());
                if (this.flash.used) {
                    var c,
                        d = "jQuery=" + encodeURI(this.options.noConflict) + "&id=" + encodeURI(this.internal.self.id) + "&vol=" + this.options.volume + "&muted=" + this.options.muted;
                    if (b.jPlayer.browser.msie && (9 > Number(b.jPlayer.browser.version) || 9 > b.jPlayer.browser.documentMode)) {
                        d = ['<param name="movie" value="' + this.internal.flash.swf + '" />', '<param name="FlashVars" value="' + d + '" />', '<param name="allowScriptAccess" value="always" />',
                            '<param name="bgcolor" value="' + this.options.backgroundColor + '" />', '<param name="wmode" value="' + this.options.wmode + '" />'];
                        c = document.createElement('<object id="' + this.internal.flash.id + '" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="0" height="0" tabindex="-1"></object>');
                        for (var e = 0; e < d.length; e++) c.appendChild(document.createElement(d[e]))
                    } else e = function (a, c, b) {
                        var d = document.createElement("param");
                        d.setAttribute("name", c);
                        d.setAttribute("value", b);
                        a.appendChild(d)
                    }, c = document.createElement("object"),
                        c.setAttribute("id", this.internal.flash.id), c.setAttribute("name", this.internal.flash.id), c.setAttribute("data", this.internal.flash.swf), c.setAttribute("type", "application/x-shockwave-flash"), c.setAttribute("width", "1"), c.setAttribute("height", "1"), c.setAttribute("tabindex", "-1"), e(c, "flashvars", d), e(c, "allowscriptaccess", "always"), e(c, "bgcolor", this.options.backgroundColor), e(c, "wmode", this.options.wmode);
                    this.element.append(c);
                    this.internal.flash.jq = b(c)
                }
                this.status.playbackRateEnabled = this.html.used &&
                !this.flash.used ? this._testPlaybackRate("audio") : !1;
                this._updatePlaybackRate();
                this.html.used && (this.html.audio.available && (this._addHtmlEventListeners(this.htmlElement.audio, this.html.audio), this.element.append(this.htmlElement.audio), this.internal.audio.jq = b("#" + this.internal.audio.id)), this.html.video.available && (this._addHtmlEventListeners(this.htmlElement.video, this.html.video), this.element.append(this.htmlElement.video), this.internal.video.jq = b("#" + this.internal.video.id), this.status.nativeVideoControls ?
                    this.internal.video.jq.css({
                        width: this.status.width,
                        height: this.status.height
                    }) : this.internal.video.jq.css({
                        width: "0px",
                        height: "0px"
                    }), this.internal.video.jq.bind("click.jPlayer", function () {
                    a._trigger(b.jPlayer.event.click)
                })));
                this.options.emulateHtml && this._emulateHtmlBridge();
                this.html.used && !this.flash.used && setTimeout(function () {
                    a.internal.ready = !0;
                    a.version.flash = "n/a";
                    a._trigger(b.jPlayer.event.repeat);
                    a._trigger(b.jPlayer.event.ready)
                }, 100);
                this._updateNativeVideoControls();
                this.css.jq.videoPlay.length &&
                this.css.jq.videoPlay.hide();
                b.jPlayer.prototype.count++
            },
            destroy: function () {
                this.clearMedia();
                this._removeUiClass();
                this.css.jq.currentTime.length && this.css.jq.currentTime.text("");
                this.css.jq.duration.length && this.css.jq.duration.text("");
                b.each(this.css.jq, function (a, c) {
                    c.length && c.unbind(".jPlayer")
                });
                this.internal.poster.jq.unbind(".jPlayer");
                this.internal.video.jq && this.internal.video.jq.unbind(".jPlayer");
                this._fullscreenRemoveEventListeners();
                this === b.jPlayer.focus && (b.jPlayer.focus = null);
                this.options.emulateHtml && this._destroyHtmlBridge();
                this.element.removeData("jPlayer");
                this.element.unbind(".jPlayer");
                this.element.empty();
                delete this.instances[this.internal.instance]
            },
            enable: function () {
            },
            disable: function () {
            },
            _testCanPlayType: function (a) {
                try {
                    return a.canPlayType(this.format.mp3.codec), !0
                } catch (c) {
                    return !1
                }
            },
            _testPlaybackRate: function (a) {
                a = document.createElement("string" === typeof a ? a : "audio");
                try {
                    return "playbackRate" in a ? (a.playbackRate = 0.5, 0.5 === a.playbackRate) : !1
                } catch (c) {
                    return !1
                }
            },
            _uaBlocklist: function (a) {
                var c = navigator.userAgent.toLowerCase(), d = !1;
                b.each(a, function (a, b) {
                    if (b && b.test(c)) return d = !0, !1
                });
                return d
            },
            _restrictNativeVideoControls: function () {
                this.require.audio && this.status.nativeVideoControls && (this.status.nativeVideoControls = !1, this.status.noFullWindow = !0)
            },
            _updateNativeVideoControls: function () {
                this.html.video.available && this.html.used && (this.htmlElement.video.controls = this.status.nativeVideoControls, this._updateAutohide(), this.status.nativeVideoControls && this.require.video ?
                    (this.internal.poster.jq.hide(), this.internal.video.jq.css({
                        width: this.status.width,
                        height: this.status.height
                    })) : this.status.waitForPlay && this.status.video && (this.internal.poster.jq.show(), this.internal.video.jq.css({
                    width: "0px",
                    height: "0px"
                })))
            },
            _addHtmlEventListeners: function (a, c) {
                var d = this;
                a.preload = this.options.preload;
                a.muted = this.options.muted;
                a.volume = this.options.volume;
                this.status.playbackRateEnabled && (a.defaultPlaybackRate = this.options.defaultPlaybackRate, a.playbackRate = this.options.playbackRate);
                a.addEventListener("progress", function () {
                    c.gate && (d.internal.cmdsIgnored && 0 < this.readyState && (d.internal.cmdsIgnored = !1), d.androidFix.setMedia = !1, d.androidFix.play && (d.androidFix.play = !1, d.play(d.androidFix.time)), d.androidFix.pause && (d.androidFix.pause = !1, d.pause(d.androidFix.time)), d._getHtmlStatus(a), d._updateInterface(), d._trigger(b.jPlayer.event.progress))
                }, !1);
                a.addEventListener("timeupdate", function () {
                        c.gate && (d._getHtmlStatus(a), d._updateInterface(), d._trigger(b.jPlayer.event.timeupdate))
                    },
                    !1);
                a.addEventListener("durationchange", function () {
                    c.gate && (d._getHtmlStatus(a), d._updateInterface(), d._trigger(b.jPlayer.event.durationchange))
                }, !1);
                a.addEventListener("play", function () {
                    c.gate && (d._updateButtons(!0), d._html_checkWaitForPlay(), d._trigger(b.jPlayer.event.play))
                }, !1);
                a.addEventListener("playing", function () {
                    c.gate && (d._updateButtons(!0), d._seeked(), d._trigger(b.jPlayer.event.playing))
                }, !1);
                a.addEventListener("pause", function () {
                        c.gate && (d._updateButtons(!1), d._trigger(b.jPlayer.event.pause))
                    },
                    !1);
                a.addEventListener("waiting", function () {
                    c.gate && (d._seeking(), d._trigger(b.jPlayer.event.waiting))
                }, !1);
                a.addEventListener("seeking", function () {
                    c.gate && (d._seeking(), d._trigger(b.jPlayer.event.seeking))
                }, !1);
                a.addEventListener("seeked", function () {
                    c.gate && (d._seeked(), d._trigger(b.jPlayer.event.seeked))
                }, !1);
                a.addEventListener("volumechange", function () {
                    c.gate && (d.options.volume = a.volume, d.options.muted = a.muted, d._updateMute(), d._updateVolume(), d._trigger(b.jPlayer.event.volumechange))
                }, !1);
                a.addEventListener("ratechange",
                    function () {
                        c.gate && (d.options.defaultPlaybackRate = a.defaultPlaybackRate, d.options.playbackRate = a.playbackRate, d._updatePlaybackRate(), d._trigger(b.jPlayer.event.ratechange))
                    }, !1);
                a.addEventListener("suspend", function () {
                    c.gate && (d._seeked(), d._trigger(b.jPlayer.event.suspend))
                }, !1);
                a.addEventListener("ended", function () {
                        c.gate && (b.jPlayer.browser.webkit || (d.htmlElement.media.currentTime = 0), d.htmlElement.media.pause(), d._updateButtons(!1), d._getHtmlStatus(a, !0), d._updateInterface(), d._trigger(b.jPlayer.event.ended))
                    },
                    !1);
                a.addEventListener("error", function () {
                    c.gate && (d._updateButtons(!1), d._seeked(), d.status.srcSet && (clearTimeout(d.internal.htmlDlyCmdId), d.status.waitForLoad = !0, d.status.waitForPlay = !0, d.status.video && !d.status.nativeVideoControls && d.internal.video.jq.css({
                        width: "0px",
                        height: "0px"
                    }), d._validString(d.status.media.poster) && !d.status.nativeVideoControls && d.internal.poster.jq.show(), d.css.jq.videoPlay.length && d.css.jq.videoPlay.show(), d._error({
                        type: b.jPlayer.error.URL, context: d.status.src, message: b.jPlayer.errorMsg.URL,
                        hint: b.jPlayer.errorHint.URL
                    })))
                }, !1);
                b.each(b.jPlayer.htmlEvent, function (e, g) {
                    a.addEventListener(this, function () {
                        c.gate && d._trigger(b.jPlayer.event[g])
                    }, !1)
                })
            },
            _getHtmlStatus: function (a, c) {
                var b = 0, e = 0, g = 0, f = 0;
                isFinite(a.duration) && (this.status.duration = a.duration);
                b = a.currentTime;
                e = 0 < this.status.duration ? 100 * b / this.status.duration : 0;
                "object" === typeof a.seekable && 0 < a.seekable.length ? (g = 0 < this.status.duration ? 100 * a.seekable.end(a.seekable.length - 1) / this.status.duration : 100, f = 0 < this.status.duration ?
                    100 * a.currentTime / a.seekable.end(a.seekable.length - 1) : 0) : (g = 100, f = e);
                c && (e = f = b = 0);
                this.status.seekPercent = g;
                this.status.currentPercentRelative = f;
                this.status.currentPercentAbsolute = e;
                this.status.currentTime = b;
                this.status.remaining = this.status.duration - this.status.currentTime;
                this.status.videoWidth = a.videoWidth;
                this.status.videoHeight = a.videoHeight;
                this.status.readyState = a.readyState;
                this.status.networkState = a.networkState;
                this.status.playbackRate = a.playbackRate;
                this.status.ended = a.ended
            },
            _resetStatus: function () {
                this.status =
                    b.extend({}, this.status, b.jPlayer.prototype.status)
            },
            _trigger: function (a, c, d) {
                a = b.Event(a);
                a.jPlayer = {};
                a.jPlayer.version = b.extend({}, this.version);
                a.jPlayer.options = b.extend(!0, {}, this.options);
                a.jPlayer.status = b.extend(!0, {}, this.status);
                a.jPlayer.html = b.extend(!0, {}, this.html);
                a.jPlayer.flash = b.extend(!0, {}, this.flash);
                c && (a.jPlayer.error = b.extend({}, c));
                d && (a.jPlayer.warning = b.extend({}, d));
                this.element.trigger(a)
            },
            jPlayerFlashEvent: function (a, c) {
                if (a === b.jPlayer.event.ready) if (!this.internal.ready) this.internal.ready =
                    !0, this.internal.flash.jq.css({
                    width: "0px",
                    height: "0px"
                }), this.version.flash = c.version, this.version.needFlash !== this.version.flash && this._error({
                    type: b.jPlayer.error.VERSION,
                    context: this.version.flash,
                    message: b.jPlayer.errorMsg.VERSION + this.version.flash,
                    hint: b.jPlayer.errorHint.VERSION
                }), this._trigger(b.jPlayer.event.repeat), this._trigger(a); else if (this.flash.gate) {
                    if (this.status.srcSet) {
                        var d = this.status.currentTime, e = this.status.paused;
                        this.setMedia(this.status.media);
                        this.volumeWorker(this.options.volume);
                        0 < d && (e ? this.pause(d) : this.play(d))
                    }
                    this._trigger(b.jPlayer.event.flashreset)
                }
                if (this.flash.gate) switch (a) {
                    case b.jPlayer.event.progress:
                        this._getFlashStatus(c);
                        this._updateInterface();
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.timeupdate:
                        this._getFlashStatus(c);
                        this._updateInterface();
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.play:
                        this._seeked();
                        this._updateButtons(!0);
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.pause:
                        this._updateButtons(!1);
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.ended:
                        this._updateButtons(!1);
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.click:
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.error:
                        this.status.waitForLoad = !0;
                        this.status.waitForPlay = !0;
                        this.status.video && this.internal.flash.jq.css({width: "0px", height: "0px"});
                        this._validString(this.status.media.poster) && this.internal.poster.jq.show();
                        this.css.jq.videoPlay.length && this.status.video && this.css.jq.videoPlay.show();
                        this.status.video ? this._flash_setVideo(this.status.media) : this._flash_setAudio(this.status.media);
                        this._updateButtons(!1);
                        this._error({
                            type: b.jPlayer.error.URL,
                            context: c.src,
                            message: b.jPlayer.errorMsg.URL,
                            hint: b.jPlayer.errorHint.URL
                        });
                        break;
                    case b.jPlayer.event.seeking:
                        this._seeking();
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.seeked:
                        this._seeked();
                        this._trigger(a);
                        break;
                    case b.jPlayer.event.ready:
                        break;
                    default:
                        this._trigger(a)
                }
                return !1
            },
            _getFlashStatus: function (a) {
                this.status.seekPercent = a.seekPercent;
                this.status.currentPercentRelative = a.currentPercentRelative;
                this.status.currentPercentAbsolute = a.currentPercentAbsolute;
                this.status.currentTime = a.currentTime;
                this.status.duration = a.duration;
                this.status.remaining = a.duration - a.currentTime;
                this.status.videoWidth = a.videoWidth;
                this.status.videoHeight = a.videoHeight;
                this.status.readyState = 4;
                this.status.networkState = 0;
                this.status.playbackRate = 1;
                this.status.ended = !1
            },
            _updateButtons: function (a) {
                a === f ? a = !this.status.paused : this.status.paused = !a;
                this.css.jq.play.length && this.css.jq.pause.length && (a ? (this.css.jq.play.hide(), this.css.jq.pause.show()) : (this.css.jq.play.show(), this.css.jq.pause.hide()));
                this.css.jq.restoreScreen.length && this.css.jq.fullScreen.length && (this.status.noFullWindow ? (this.css.jq.fullScreen.hide(), this.css.jq.restoreScreen.hide()) : this.options.fullWindow ? (this.css.jq.fullScreen.hide(), this.css.jq.restoreScreen.show()) : (this.css.jq.fullScreen.show(), this.css.jq.restoreScreen.hide()));
                this.css.jq.repeat.length && this.css.jq.repeatOff.length && (this.options.loop ? (this.css.jq.repeat.hide(), this.css.jq.repeatOff.show()) : (this.css.jq.repeat.show(), this.css.jq.repeatOff.hide()))
            },
            _updateInterface: function () {
                this.css.jq.seekBar.length && this.css.jq.seekBar.width(this.status.seekPercent + "%");
                this.css.jq.playBar.length && (this.options.smoothPlayBar ? this.css.jq.playBar.stop().animate({width: this.status.currentPercentAbsolute + "%"}, 250, "linear") : this.css.jq.playBar.width(this.status.currentPercentRelative + "%"));
                var a = "";
                this.css.jq.currentTime.length && (a = this._convertTime(this.status.currentTime), a !== this.css.jq.currentTime.text() && this.css.jq.currentTime.text(this._convertTime(this.status.currentTime)));
                var a = "", a = this.status.duration, c = this.status.remaining;
                this.css.jq.duration.length && ("string" === typeof this.status.media.duration ? a = this.status.media.duration : ("number" === typeof this.status.media.duration && (a = this.status.media.duration, c = a - this.status.currentTime), a = this.options.remainingDuration ? (0 < c ? "-" : "") + this._convertTime(c) : this._convertTime(a)), a !== this.css.jq.duration.text() && this.css.jq.duration.text(a))
            },
            _convertTime: l.prototype.time,
            _seeking: function () {
                this.css.jq.seekBar.length && this.css.jq.seekBar.addClass("jp-seeking-bg")
            },
            _seeked: function () {
                this.css.jq.seekBar.length && this.css.jq.seekBar.removeClass("jp-seeking-bg")
            },
            _resetGate: function () {
                this.html.audio.gate = !1;
                this.html.video.gate = !1;
                this.flash.gate = !1
            },
            _resetActive: function () {
                this.html.active = !1;
                this.flash.active = !1
            },
            _escapeHtml: function (a) {
                return a.split("&").join("&amp;").split("<").join("&lt;").split(">").join("&gt;").split('"').join("&quot;")
            },
            _qualifyURL: function (a) {
                var c = document.createElement("div");
                c.innerHTML = '<a href="' + this._escapeHtml(a) + '">x</a>';
                return c.firstChild.href
            },
            _absoluteMediaUrls: function (a) {
                var c = this;
                b.each(a, function (b, e) {
                    e && c.format[b] && (a[b] = c._qualifyURL(e))
                });
                return a
            },
            setMedia: function (a) {
                var c = this, d = !1, e = this.status.media.poster !== a.poster;
                this._resetMedia();
                this._resetGate();
                this._resetActive();
                this.androidFix.setMedia = !1;
                this.androidFix.play = !1;
                this.androidFix.pause = !1;
                a = this._absoluteMediaUrls(a);
                b.each(this.formats, function (e, f) {
                    var k = "video" === c.format[f].media;
                    b.each(c.solutions, function (e, g) {
                        if (c[g].support[f] && c._validString(a[f])) {
                            var l =
                                "html" === g;
                            k ? (l ? (c.html.video.gate = !0, c._html_setVideo(a), c.html.active = !0) : (c.flash.gate = !0, c._flash_setVideo(a), c.flash.active = !0), c.css.jq.videoPlay.length && c.css.jq.videoPlay.show(), c.status.video = !0) : (l ? (c.html.audio.gate = !0, c._html_setAudio(a), c.html.active = !0, b.jPlayer.platform.android && (c.androidFix.setMedia = !0)) : (c.flash.gate = !0, c._flash_setAudio(a), c.flash.active = !0), c.css.jq.videoPlay.length && c.css.jq.videoPlay.hide(), c.status.video = !1);
                            d = !0;
                            return !1
                        }
                    });
                    if (d) return !1
                });
                d ? (this.status.nativeVideoControls &&
                    this.html.video.gate || !this._validString(a.poster) || (e ? this.htmlElement.poster.src = a.poster : this.internal.poster.jq.show()), this.css.jq.title.length && "string" === typeof a.title && (this.css.jq.title.html(a.title), this.htmlElement.audio && this.htmlElement.audio.setAttribute("title", a.title), this.htmlElement.video && this.htmlElement.video.setAttribute("title", a.title)), this.status.srcSet = !0, this.status.media = b.extend({}, a), this._updateButtons(!1), this._updateInterface(), this._trigger(b.jPlayer.event.setmedia)) :
                    this._error({
                        type: b.jPlayer.error.NO_SUPPORT,
                        context: "{supplied:'" + this.options.supplied + "'}",
                        message: b.jPlayer.errorMsg.NO_SUPPORT,
                        hint: b.jPlayer.errorHint.NO_SUPPORT
                    })
            },
            _resetMedia: function () {
                this._resetStatus();
                this._updateButtons(!1);
                this._updateInterface();
                this._seeked();
                this.internal.poster.jq.hide();
                clearTimeout(this.internal.htmlDlyCmdId);
                this.html.active ? this._html_resetMedia() : this.flash.active && this._flash_resetMedia()
            },
            clearMedia: function () {
                this._resetMedia();
                this.html.active ? this._html_clearMedia() :
                    this.flash.active && this._flash_clearMedia();
                this._resetGate();
                this._resetActive()
            },
            load: function () {
                this.status.srcSet ? this.html.active ? this._html_load() : this.flash.active && this._flash_load() : this._urlNotSetError("load")
            },
            focus: function () {
                this.options.keyEnabled && (b.jPlayer.focus = this)
            },
            play: function (a) {
                a = "number" === typeof a ? a : NaN;
                this.status.srcSet ? (this.focus(), this.html.active ? this._html_play(a) : this.flash.active && this._flash_play(a)) : this._urlNotSetError("play")
            },
            videoPlay: function () {
                this.play()
            },
            pause: function (a) {
                a = "number" === typeof a ? a : NaN;
                this.status.srcSet ? this.html.active ? this._html_pause(a) : this.flash.active && this._flash_pause(a) : this._urlNotSetError("pause")
            },
            tellOthers: function (a, c) {
                var d = this, e = "function" === typeof c, g = Array.prototype.slice.call(arguments);
                "string" === typeof a && (e && g.splice(1, 1), b.each(this.instances, function () {
                    d.element !== this && (e && !c.call(this.data("jPlayer"), d) || this.jPlayer.apply(this, g))
                }))
            },
            pauseOthers: function (a) {
                this.tellOthers("pause", function () {
                        return this.status.srcSet
                    },
                    a)
            },
            stop: function () {
                this.status.srcSet ? this.html.active ? this._html_pause(0) : this.flash.active && this._flash_pause(0) : this._urlNotSetError("stop")
            },
            playHead: function (a) {
                a = this._limitValue(a, 0, 100);
                this.status.srcSet ? this.html.active ? this._html_playHead(a) : this.flash.active && this._flash_playHead(a) : this._urlNotSetError("playHead")
            },
            _muted: function (a) {
                this.mutedWorker(a);
                this.options.globalVolume && this.tellOthers("mutedWorker", function () {
                    return this.options.globalVolume
                }, a)
            },
            mutedWorker: function (a) {
                this.options.muted =
                    a;
                this.html.used && this._html_setProperty("muted", a);
                this.flash.used && this._flash_mute(a);
                this.html.video.gate || this.html.audio.gate || (this._updateMute(a), this._updateVolume(this.options.volume), this._trigger(b.jPlayer.event.volumechange))
            },
            mute: function (a) {
                a = a === f ? !0 : !!a;
                this._muted(a)
            },
            unmute: function (a) {
                a = a === f ? !0 : !!a;
                this._muted(!a)
            },
            _updateMute: function (a) {
                a === f && (a = this.options.muted);
                this.css.jq.mute.length && this.css.jq.unmute.length && (this.status.noVolume ? (this.css.jq.mute.hide(), this.css.jq.unmute.hide()) :
                    a ? (this.css.jq.mute.hide(), this.css.jq.unmute.show()) : (this.css.jq.mute.show(), this.css.jq.unmute.hide()))
            },
            volume: function (a) {
                this.volumeWorker(a);
                this.options.globalVolume && this.tellOthers("volumeWorker", function () {
                    return this.options.globalVolume
                }, a)
            },
            volumeWorker: function (a) {
                a = this._limitValue(a, 0, 1);
                this.options.volume = a;
                this.html.used && this._html_setProperty("volume", a);
                this.flash.used && this._flash_volume(a);
                this.html.video.gate || this.html.audio.gate || (this._updateVolume(a), this._trigger(b.jPlayer.event.volumechange))
            },
            volumeBar: function (a) {
                if (this.css.jq.volumeBar.length) {
                    var c = b(a.currentTarget), d = c.offset(), e = a.pageX - d.left, g = c.width();
                    a = c.height() - a.pageY + d.top;
                    c = c.height();
                    this.options.verticalVolume ? this.volume(a / c) : this.volume(e / g)
                }
                this.options.muted && this._muted(!1)
            },
            _updateVolume: function (a) {
                a === f && (a = this.options.volume);
                a = this.options.muted ? 0 : a;
                this.status.noVolume ? (this.css.jq.volumeBar.length && this.css.jq.volumeBar.hide(), this.css.jq.volumeBarValue.length && this.css.jq.volumeBarValue.hide(), this.css.jq.volumeMax.length &&
                this.css.jq.volumeMax.hide()) : (this.css.jq.volumeBar.length && this.css.jq.volumeBar.show(), this.css.jq.volumeBarValue.length && (this.css.jq.volumeBarValue.show(), this.css.jq.volumeBarValue[this.options.verticalVolume ? "height" : "width"](100 * a + "%")), this.css.jq.volumeMax.length && this.css.jq.volumeMax.show())
            },
            volumeMax: function () {
                this.volume(1);
                this.options.muted && this._muted(!1)
            },
            _cssSelectorAncestor: function (a) {
                var c = this;
                this.options.cssSelectorAncestor = a;
                this._removeUiClass();
                this.ancestorJq = a ? b(a) :
                    [];
                a && 1 !== this.ancestorJq.length && this._warning({
                    type: b.jPlayer.warning.CSS_SELECTOR_COUNT,
                    context: a,
                    message: b.jPlayer.warningMsg.CSS_SELECTOR_COUNT + this.ancestorJq.length + " found for cssSelectorAncestor.",
                    hint: b.jPlayer.warningHint.CSS_SELECTOR_COUNT
                });
                this._addUiClass();
                b.each(this.options.cssSelector, function (a, b) {
                    c._cssSelector(a, b)
                });
                this._updateInterface();
                this._updateButtons();
                this._updateAutohide();
                this._updateVolume();
                this._updateMute()
            },
            _cssSelector: function (a, c) {
                var d = this;
                "string" === typeof c ?
                    b.jPlayer.prototype.options.cssSelector[a] ? (this.css.jq[a] && this.css.jq[a].length && this.css.jq[a].unbind(".jPlayer"), this.options.cssSelector[a] = c, this.css.cs[a] = this.options.cssSelectorAncestor + " " + c, this.css.jq[a] = c ? b(this.css.cs[a]) : [], this.css.jq[a].length && this[a] && this.css.jq[a].bind("click.jPlayer", function (c) {
                        c.preventDefault();
                        d[a](c);
                        b(this).blur()
                    }), c && 1 !== this.css.jq[a].length && this._warning({
                        type: b.jPlayer.warning.CSS_SELECTOR_COUNT,
                        context: this.css.cs[a],
                        message: b.jPlayer.warningMsg.CSS_SELECTOR_COUNT +
                            this.css.jq[a].length + " found for " + a + " method.",
                        hint: b.jPlayer.warningHint.CSS_SELECTOR_COUNT
                    })) : this._warning({
                        type: b.jPlayer.warning.CSS_SELECTOR_METHOD,
                        context: a,
                        message: b.jPlayer.warningMsg.CSS_SELECTOR_METHOD,
                        hint: b.jPlayer.warningHint.CSS_SELECTOR_METHOD
                    }) : this._warning({
                        type: b.jPlayer.warning.CSS_SELECTOR_STRING,
                        context: c,
                        message: b.jPlayer.warningMsg.CSS_SELECTOR_STRING,
                        hint: b.jPlayer.warningHint.CSS_SELECTOR_STRING
                    })
            },
            duration: function (a) {
                this.options.toggleDuration && this._setOption("remainingDuration",
                    !this.options.remainingDuration)
            },
            seekBar: function (a) {
                if (this.css.jq.seekBar.length) {
                    var c = b(a.currentTarget), d = c.offset();
                    a = a.pageX - d.left;
                    c = c.width();
                    this.playHead(100 * a / c)
                }
            },
            playbackRate: function (a) {
                this._setOption("playbackRate", a)
            },
            playbackRateBar: function (a) {
                if (this.css.jq.playbackRateBar.length) {
                    var c = b(a.currentTarget), d = c.offset(), e = a.pageX - d.left, g = c.width();
                    a = c.height() - a.pageY + d.top;
                    c = c.height();
                    this.playbackRate((this.options.verticalPlaybackRate ? a / c : e / g) * (this.options.maxPlaybackRate -
                        this.options.minPlaybackRate) + this.options.minPlaybackRate)
                }
            },
            _updatePlaybackRate: function () {
                var a = (this.options.playbackRate - this.options.minPlaybackRate) / (this.options.maxPlaybackRate - this.options.minPlaybackRate);
                this.status.playbackRateEnabled ? (this.css.jq.playbackRateBar.length && this.css.jq.playbackRateBar.show(), this.css.jq.playbackRateBarValue.length && (this.css.jq.playbackRateBarValue.show(), this.css.jq.playbackRateBarValue[this.options.verticalPlaybackRate ? "height" : "width"](100 * a + "%"))) : (this.css.jq.playbackRateBar.length &&
                this.css.jq.playbackRateBar.hide(), this.css.jq.playbackRateBarValue.length && this.css.jq.playbackRateBarValue.hide())
            },
            repeat: function () {
                this._loop(!0)
            },
            repeatOff: function () {
                this._loop(!1)
            },
            _loop: function (a) {
                this.options.loop !== a && (this.options.loop = a, this._updateButtons(), this._trigger(b.jPlayer.event.repeat))
            },
            option: function (a, c) {
                var d = a;
                if (0 === arguments.length) return b.extend(!0, {}, this.options);
                if ("string" === typeof a) {
                    var e = a.split(".");
                    if (c === f) {
                        for (var d = b.extend(!0, {}, this.options), g = 0; g < e.length; g++) if (d[e[g]] !==
                            f) d = d[e[g]]; else return this._warning({
                            type: b.jPlayer.warning.OPTION_KEY,
                            context: a,
                            message: b.jPlayer.warningMsg.OPTION_KEY,
                            hint: b.jPlayer.warningHint.OPTION_KEY
                        }), f;
                        return d
                    }
                    for (var g = d = {}, h = 0; h < e.length; h++) h < e.length - 1 ? (g[e[h]] = {}, g = g[e[h]]) : g[e[h]] = c
                }
                this._setOptions(d);
                return this
            },
            _setOptions: function (a) {
                var c = this;
                b.each(a, function (a, b) {
                    c._setOption(a, b)
                });
                return this
            },
            _setOption: function (a, c) {
                var d = this;
                switch (a) {
                    case "volume":
                        this.volume(c);
                        break;
                    case "muted":
                        this._muted(c);
                        break;
                    case "globalVolume":
                        this.options[a] =
                            c;
                        break;
                    case "cssSelectorAncestor":
                        this._cssSelectorAncestor(c);
                        break;
                    case "cssSelector":
                        b.each(c, function (a, c) {
                            d._cssSelector(a, c)
                        });
                        break;
                    case "playbackRate":
                        this.options[a] = c = this._limitValue(c, this.options.minPlaybackRate, this.options.maxPlaybackRate);
                        this.html.used && this._html_setProperty("playbackRate", c);
                        this._updatePlaybackRate();
                        break;
                    case "defaultPlaybackRate":
                        this.options[a] = c = this._limitValue(c, this.options.minPlaybackRate, this.options.maxPlaybackRate);
                        this.html.used && this._html_setProperty("defaultPlaybackRate",
                            c);
                        this._updatePlaybackRate();
                        break;
                    case "minPlaybackRate":
                        this.options[a] = c = this._limitValue(c, 0.1, this.options.maxPlaybackRate - 0.1);
                        this._updatePlaybackRate();
                        break;
                    case "maxPlaybackRate":
                        this.options[a] = c = this._limitValue(c, this.options.minPlaybackRate + 0.1, 16);
                        this._updatePlaybackRate();
                        break;
                    case "fullScreen":
                        if (this.options[a] !== c) {
                            var e = b.jPlayer.nativeFeatures.fullscreen.used.webkitVideo;
                            if (!e || e && !this.status.waitForPlay) e || (this.options[a] = c), c ? this._requestFullscreen() : this._exitFullscreen(),
                            e || this._setOption("fullWindow", c)
                        }
                        break;
                    case "fullWindow":
                        this.options[a] !== c && (this._removeUiClass(), this.options[a] = c, this._refreshSize());
                        break;
                    case "size":
                        this.options.fullWindow || this.options[a].cssClass === c.cssClass || this._removeUiClass();
                        this.options[a] = b.extend({}, this.options[a], c);
                        this._refreshSize();
                        break;
                    case "sizeFull":
                        this.options.fullWindow && this.options[a].cssClass !== c.cssClass && this._removeUiClass();
                        this.options[a] = b.extend({}, this.options[a], c);
                        this._refreshSize();
                        break;
                    case "autohide":
                        this.options[a] =
                            b.extend({}, this.options[a], c);
                        this._updateAutohide();
                        break;
                    case "loop":
                        this._loop(c);
                        break;
                    case "remainingDuration":
                        this.options[a] = c;
                        this._updateInterface();
                        break;
                    case "toggleDuration":
                        this.options[a] = c;
                        break;
                    case "nativeVideoControls":
                        this.options[a] = b.extend({}, this.options[a], c);
                        this.status.nativeVideoControls = this._uaBlocklist(this.options.nativeVideoControls);
                        this._restrictNativeVideoControls();
                        this._updateNativeVideoControls();
                        break;
                    case "noFullWindow":
                        this.options[a] = b.extend({}, this.options[a],
                            c);
                        this.status.nativeVideoControls = this._uaBlocklist(this.options.nativeVideoControls);
                        this.status.noFullWindow = this._uaBlocklist(this.options.noFullWindow);
                        this._restrictNativeVideoControls();
                        this._updateButtons();
                        break;
                    case "noVolume":
                        this.options[a] = b.extend({}, this.options[a], c);
                        this.status.noVolume = this._uaBlocklist(this.options.noVolume);
                        this._updateVolume();
                        this._updateMute();
                        break;
                    case "emulateHtml":
                        this.options[a] !== c && ((this.options[a] = c) ? this._emulateHtmlBridge() : this._destroyHtmlBridge());
                        break;
                    case "timeFormat":
                        this.options[a] = b.extend({}, this.options[a], c);
                        break;
                    case "keyEnabled":
                        this.options[a] = c;
                        c || this !== b.jPlayer.focus || (b.jPlayer.focus = null);
                        break;
                    case "keyBindings":
                        this.options[a] = b.extend(!0, {}, this.options[a], c);
                        break;
                    case "audioFullScreen":
                        this.options[a] = c
                }
                return this
            },
            _refreshSize: function () {
                this._setSize();
                this._addUiClass();
                this._updateSize();
                this._updateButtons();
                this._updateAutohide();
                this._trigger(b.jPlayer.event.resize)
            },
            _setSize: function () {
                this.options.fullWindow ?
                    (this.status.width = this.options.sizeFull.width, this.status.height = this.options.sizeFull.height, this.status.cssClass = this.options.sizeFull.cssClass) : (this.status.width = this.options.size.width, this.status.height = this.options.size.height, this.status.cssClass = this.options.size.cssClass);
                this.element.css({width: this.status.width, height: this.status.height})
            },
            _addUiClass: function () {
                this.ancestorJq.length && this.ancestorJq.addClass(this.status.cssClass)
            },
            _removeUiClass: function () {
                this.ancestorJq.length && this.ancestorJq.removeClass(this.status.cssClass)
            },
            _updateSize: function () {
                this.internal.poster.jq.css({width: this.status.width, height: this.status.height});
                !this.status.waitForPlay && this.html.active && this.status.video || this.html.video.available && this.html.used && this.status.nativeVideoControls ? this.internal.video.jq.css({
                    width: this.status.width,
                    height: this.status.height
                }) : !this.status.waitForPlay && this.flash.active && this.status.video && this.internal.flash.jq.css({
                    width: this.status.width,
                    height: this.status.height
                })
            },
            _updateAutohide: function () {
                var a = this,
                    c = function () {
                        a.css.jq.gui.fadeIn(a.options.autohide.fadeIn, function () {
                            clearTimeout(a.internal.autohideId);
                            a.internal.autohideId = setTimeout(function () {
                                a.css.jq.gui.fadeOut(a.options.autohide.fadeOut)
                            }, a.options.autohide.hold)
                        })
                    };
                this.css.jq.gui.length && (this.css.jq.gui.stop(!0, !0), clearTimeout(this.internal.autohideId), this.element.unbind(".jPlayerAutohide"), this.css.jq.gui.unbind(".jPlayerAutohide"), this.status.nativeVideoControls ? this.css.jq.gui.hide() : this.options.fullWindow && this.options.autohide.full ||
                !this.options.fullWindow && this.options.autohide.restored ? (this.element.bind("mousemove.jPlayer.jPlayerAutohide", c), this.css.jq.gui.bind("mousemove.jPlayer.jPlayerAutohide", c), this.css.jq.gui.hide()) : this.css.jq.gui.show())
            },
            fullScreen: function () {
                this._setOption("fullScreen", !0)
            },
            restoreScreen: function () {
                this._setOption("fullScreen", !1)
            },
            _fullscreenAddEventListeners: function () {
                var a = this, c = b.jPlayer.nativeFeatures.fullscreen;
                c.api.fullscreenEnabled && c.event.fullscreenchange && ("function" !== typeof this.internal.fullscreenchangeHandler &&
                (this.internal.fullscreenchangeHandler = function () {
                    a._fullscreenchange()
                }), document.addEventListener(c.event.fullscreenchange, this.internal.fullscreenchangeHandler, !1))
            },
            _fullscreenRemoveEventListeners: function () {
                var a = b.jPlayer.nativeFeatures.fullscreen;
                this.internal.fullscreenchangeHandler && document.removeEventListener(a.event.fullscreenchange, this.internal.fullscreenchangeHandler, !1)
            },
            _fullscreenchange: function () {
                this.options.fullScreen && !b.jPlayer.nativeFeatures.fullscreen.api.fullscreenElement() &&
                this._setOption("fullScreen", !1)
            },
            _requestFullscreen: function () {
                var a = this.ancestorJq.length ? this.ancestorJq[0] : this.element[0],
                    c = b.jPlayer.nativeFeatures.fullscreen;
                c.used.webkitVideo && (a = this.htmlElement.video);
                c.api.fullscreenEnabled && c.api.requestFullscreen(a)
            },
            _exitFullscreen: function () {
                var a = b.jPlayer.nativeFeatures.fullscreen, c;
                a.used.webkitVideo && (c = this.htmlElement.video);
                a.api.fullscreenEnabled && a.api.exitFullscreen(c)
            },
            _html_initMedia: function (a) {
                var c = b(this.htmlElement.media).empty();
                b.each(a.track || [], function (a, b) {
                    var g = document.createElement("track");
                    g.setAttribute("kind", b.kind ? b.kind : "");
                    g.setAttribute("src", b.src ? b.src : "");
                    g.setAttribute("srclang", b.srclang ? b.srclang : "");
                    g.setAttribute("label", b.label ? b.label : "");
                    b.def && g.setAttribute("default", b.def);
                    c.append(g)
                });
                this.htmlElement.media.src = this.status.src;
                "none" !== this.options.preload && this._html_load();
                this._trigger(b.jPlayer.event.timeupdate)
            },
            _html_setFormat: function (a) {
                var c = this;
                b.each(this.formats, function (b, e) {
                    if (c.html.support[e] &&
                        a[e]) return c.status.src = a[e], c.status.format[e] = !0, c.status.formatType = e, !1
                })
            },
            _html_setAudio: function (a) {
                this._html_setFormat(a);
                this.htmlElement.media = this.htmlElement.audio;
                this._html_initMedia(a)
            },
            _html_setVideo: function (a) {
                this._html_setFormat(a);
                this.status.nativeVideoControls && (this.htmlElement.video.poster = this._validString(a.poster) ? a.poster : "");
                this.htmlElement.media = this.htmlElement.video;
                this._html_initMedia(a)
            },
            _html_resetMedia: function () {
                this.htmlElement.media && (this.htmlElement.media.id !==
                this.internal.video.id || this.status.nativeVideoControls || this.internal.video.jq.css({
                    width: "0px",
                    height: "0px"
                }), this.htmlElement.media.pause())
            },
            _html_clearMedia: function () {
                this.htmlElement.media && (this.htmlElement.media.src = "about:blank", this.htmlElement.media.load())
            },
            _html_load: function () {
                this.status.waitForLoad && (this.status.waitForLoad = !1, this.htmlElement.media.load());
                clearTimeout(this.internal.htmlDlyCmdId)
            },
            _html_play: function (a) {
                var b = this, d = this.htmlElement.media;
                this.androidFix.pause = !1;
                this._html_load();
                if (this.androidFix.setMedia) this.androidFix.play = !0, this.androidFix.time = a; else if (isNaN(a)) d.play(); else {
                    this.internal.cmdsIgnored && d.play();
                    try {
                        if (!d.seekable || "object" === typeof d.seekable && 0 < d.seekable.length) d.currentTime = a, d.play(); else throw 1;
                    } catch (e) {
                        this.internal.htmlDlyCmdId = setTimeout(function () {
                            b.play(a)
                        }, 250);
                        return
                    }
                }
                this._html_checkWaitForPlay()
            },
            _html_pause: function (a) {
                var b = this, d = this.htmlElement.media;
                this.androidFix.play = !1;
                0 < a ? this._html_load() : clearTimeout(this.internal.htmlDlyCmdId);
                d.pause();
                if (this.androidFix.setMedia) this.androidFix.pause = !0, this.androidFix.time = a; else if (!isNaN(a)) try {
                    if (!d.seekable || "object" === typeof d.seekable && 0 < d.seekable.length) d.currentTime = a; else throw 1;
                } catch (e) {
                    this.internal.htmlDlyCmdId = setTimeout(function () {
                        b.pause(a)
                    }, 250);
                    return
                }
                0 < a && this._html_checkWaitForPlay()
            },
            _html_playHead: function (a) {
                var b = this, d = this.htmlElement.media;
                this._html_load();
                try {
                    if ("object" === typeof d.seekable && 0 < d.seekable.length) d.currentTime = a * d.seekable.end(d.seekable.length -
                        1) / 100; else if (0 < d.duration && !isNaN(d.duration)) d.currentTime = a * d.duration / 100; else throw"e";
                } catch (e) {
                    this.internal.htmlDlyCmdId = setTimeout(function () {
                        b.playHead(a)
                    }, 250);
                    return
                }
                this.status.waitForLoad || this._html_checkWaitForPlay()
            },
            _html_checkWaitForPlay: function () {
                this.status.waitForPlay && (this.status.waitForPlay = !1, this.css.jq.videoPlay.length && this.css.jq.videoPlay.hide(), this.status.video && (this.internal.poster.jq.hide(), this.internal.video.jq.css({
                    width: this.status.width,
                    height: this.status.height
                })))
            },
            _html_setProperty: function (a, b) {
                this.html.audio.available && (this.htmlElement.audio[a] = b);
                this.html.video.available && (this.htmlElement.video[a] = b)
            },
            _flash_setAudio: function (a) {
                var c = this;
                try {
                    b.each(this.formats, function (b, d) {
                        if (c.flash.support[d] && a[d]) {
                            switch (d) {
                                case "m4a":
                                case "fla":
                                    c._getMovie().fl_setAudio_m4a(a[d]);
                                    break;
                                case "mp3":
                                    c._getMovie().fl_setAudio_mp3(a[d]);
                                    break;
                                case "rtmpa":
                                    c._getMovie().fl_setAudio_rtmp(a[d])
                            }
                            c.status.src = a[d];
                            c.status.format[d] = !0;
                            c.status.formatType = d;
                            return !1
                        }
                    }),
                    "auto" === this.options.preload && (this._flash_load(), this.status.waitForLoad = !1)
                } catch (d) {
                    this._flashError(d)
                }
            },
            _flash_setVideo: function (a) {
                var c = this;
                try {
                    b.each(this.formats, function (b, d) {
                        if (c.flash.support[d] && a[d]) {
                            switch (d) {
                                case "m4v":
                                case "flv":
                                    c._getMovie().fl_setVideo_m4v(a[d]);
                                    break;
                                case "rtmpv":
                                    c._getMovie().fl_setVideo_rtmp(a[d])
                            }
                            c.status.src = a[d];
                            c.status.format[d] = !0;
                            c.status.formatType = d;
                            return !1
                        }
                    }), "auto" === this.options.preload && (this._flash_load(), this.status.waitForLoad = !1)
                } catch (d) {
                    this._flashError(d)
                }
            },
            _flash_resetMedia: function () {
                this.internal.flash.jq.css({width: "0px", height: "0px"});
                this._flash_pause(NaN)
            },
            _flash_clearMedia: function () {
                try {
                    this._getMovie().fl_clearMedia()
                } catch (a) {
                    this._flashError(a)
                }
            },
            _flash_load: function () {
                try {
                    this._getMovie().fl_load()
                } catch (a) {
                    this._flashError(a)
                }
                this.status.waitForLoad = !1
            },
            _flash_play: function (a) {
                try {
                    this._getMovie().fl_play(a)
                } catch (b) {
                    this._flashError(b)
                }
                this.status.waitForLoad = !1;
                this._flash_checkWaitForPlay()
            },
            _flash_pause: function (a) {
                try {
                    this._getMovie().fl_pause(a)
                } catch (b) {
                    this._flashError(b)
                }
                0 <
                a && (this.status.waitForLoad = !1, this._flash_checkWaitForPlay())
            },
            _flash_playHead: function (a) {
                try {
                    this._getMovie().fl_play_head(a)
                } catch (b) {
                    this._flashError(b)
                }
                this.status.waitForLoad || this._flash_checkWaitForPlay()
            },
            _flash_checkWaitForPlay: function () {
                this.status.waitForPlay && (this.status.waitForPlay = !1, this.css.jq.videoPlay.length && this.css.jq.videoPlay.hide(), this.status.video && (this.internal.poster.jq.hide(), this.internal.flash.jq.css({
                    width: this.status.width,
                    height: this.status.height
                })))
            },
            _flash_volume: function (a) {
                try {
                    this._getMovie().fl_volume(a)
                } catch (b) {
                    this._flashError(b)
                }
            },
            _flash_mute: function (a) {
                try {
                    this._getMovie().fl_mute(a)
                } catch (b) {
                    this._flashError(b)
                }
            },
            _getMovie: function () {
                return document[this.internal.flash.id]
            },
            _getFlashPluginVersion: function () {
                var a = 0, b;
                if (window.ActiveXObject) try {
                    if (b = new ActiveXObject("ShockwaveFlash.ShockwaveFlash")) {
                        var d = b.GetVariable("$version");
                        d && (d = d.split(" ")[1].split(","), a = parseInt(d[0], 10) + "." + parseInt(d[1], 10))
                    }
                } catch (e) {
                } else navigator.plugins && 0 < navigator.mimeTypes.length && (b = navigator.plugins["Shockwave Flash"]) && (a = navigator.plugins["Shockwave Flash"].description.replace(/.*\s(\d+\.\d+).*/,
                    "$1"));
                return 1 * a
            },
            _checkForFlash: function (a) {
                var b = !1;
                this._getFlashPluginVersion() >= a && (b = !0);
                return b
            },
            _validString: function (a) {
                return a && "string" === typeof a
            },
            _limitValue: function (a, b, d) {
                return a < b ? b : a > d ? d : a
            },
            _urlNotSetError: function (a) {
                this._error({
                    type: b.jPlayer.error.URL_NOT_SET,
                    context: a,
                    message: b.jPlayer.errorMsg.URL_NOT_SET,
                    hint: b.jPlayer.errorHint.URL_NOT_SET
                })
            },
            _flashError: function (a) {
                var c;
                c = this.internal.ready ? "FLASH_DISABLED" : "FLASH";
                this._error({
                    type: b.jPlayer.error[c], context: this.internal.flash.swf,
                    message: b.jPlayer.errorMsg[c] + a.message, hint: b.jPlayer.errorHint[c]
                });
                this.internal.flash.jq.css({width: "1px", height: "1px"})
            },
            _error: function (a) {
                this._trigger(b.jPlayer.event.error, a);
                this.options.errorAlerts && this._alert("Error!" + (a.message ? "\n" + a.message : "") + (a.hint ? "\n" + a.hint : "") + "\nContext: " + a.context)
            },
            _warning: function (a) {
                this._trigger(b.jPlayer.event.warning, f, a);
                this.options.warningAlerts && this._alert("Warning!" + (a.message ? "\n" + a.message : "") + (a.hint ? "\n" + a.hint : "") + "\nContext: " + a.context)
            },
            _alert: function (a) {
                a = "jPlayer " + this.version.script + " : id='" + this.internal.self.id + "' : " + a;
                this.options.consoleAlerts ? window.console && window.console.log && window.console.log(a) : alert(a)
            },
            _emulateHtmlBridge: function () {
                var a = this;
                b.each(b.jPlayer.emulateMethods.split(/\s+/g), function (b, d) {
                    a.internal.domNode[d] = function (b) {
                        a[d](b)
                    }
                });
                b.each(b.jPlayer.event, function (c, d) {
                    var e = !0;
                    b.each(b.jPlayer.reservedEvent.split(/\s+/g), function (a, b) {
                        if (b === c) return e = !1
                    });
                    e && a.element.bind(d + ".jPlayer.jPlayerHtml",
                        function () {
                            a._emulateHtmlUpdate();
                            var b = document.createEvent("Event");
                            b.initEvent(c, !1, !0);
                            a.internal.domNode.dispatchEvent(b)
                        })
                })
            },
            _emulateHtmlUpdate: function () {
                var a = this;
                b.each(b.jPlayer.emulateStatus.split(/\s+/g), function (b, d) {
                    a.internal.domNode[d] = a.status[d]
                });
                b.each(b.jPlayer.emulateOptions.split(/\s+/g), function (b, d) {
                    a.internal.domNode[d] = a.options[d]
                })
            },
            _destroyHtmlBridge: function () {
                var a = this;
                this.element.unbind(".jPlayerHtml");
                b.each((b.jPlayer.emulateMethods + " " + b.jPlayer.emulateStatus +
                    " " + b.jPlayer.emulateOptions).split(/\s+/g), function (b, d) {
                    delete a.internal.domNode[d]
                })
            }
        };
    b.jPlayer.error = {
        FLASH: "e_flash",
        FLASH_DISABLED: "e_flash_disabled",
        NO_SOLUTION: "e_no_solution",
        NO_SUPPORT: "e_no_support",
        URL: "e_url",
        URL_NOT_SET: "e_url_not_set",
        VERSION: "e_version"
    };
    b.jPlayer.errorMsg = {
        FLASH: "jPlayer's Flash fallback is not configured correctly, or a command was issued before the jPlayer Ready event. Details: ",
        FLASH_DISABLED: "jPlayer's Flash fallback has been disabled by the browser due to the CSS rules you have used. Details: ",
        NO_SOLUTION: "No solution can be found by jPlayer in this browser. Neither HTML nor Flash can be used.",
        NO_SUPPORT: "It is not possible to play any media format provided in setMedia() on this browser using your current options.",
        URL: "Media URL could not be loaded.",
        URL_NOT_SET: "Attempt to issue media playback commands, while no media url is set.",
        VERSION: "jPlayer " + b.jPlayer.prototype.version.script + " needs Jplayer.swf version " + b.jPlayer.prototype.version.needFlash + " but found "
    };
    b.jPlayer.errorHint =
        {
            FLASH: "Check your swfPath option and that Jplayer.swf is there.",
            FLASH_DISABLED: "Check that you have not display:none; the jPlayer entity or any ancestor.",
            NO_SOLUTION: "Review the jPlayer options: support and supplied.",
            NO_SUPPORT: "Video or audio formats defined in the supplied option are missing.",
            URL: "Check media URL is valid.",
            URL_NOT_SET: "Use setMedia() to set the media URL.",
            VERSION: "Update jPlayer files."
        };
    b.jPlayer.warning = {
        CSS_SELECTOR_COUNT: "e_css_selector_count", CSS_SELECTOR_METHOD: "e_css_selector_method",
        CSS_SELECTOR_STRING: "e_css_selector_string", OPTION_KEY: "e_option_key"
    };
    b.jPlayer.warningMsg = {
        CSS_SELECTOR_COUNT: "The number of css selectors found did not equal one: ",
        CSS_SELECTOR_METHOD: "The methodName given in jPlayer('cssSelector') is not a valid jPlayer method.",
        CSS_SELECTOR_STRING: "The methodCssSelector given in jPlayer('cssSelector') is not a String or is empty.",
        OPTION_KEY: "The option requested in jPlayer('option') is undefined."
    };
    b.jPlayer.warningHint = {
        CSS_SELECTOR_COUNT: "Check your css selector and the ancestor.",
        CSS_SELECTOR_METHOD: "Check your method name.",
        CSS_SELECTOR_STRING: "Check your css selector is a string.",
        OPTION_KEY: "Check your option name."
    }
});