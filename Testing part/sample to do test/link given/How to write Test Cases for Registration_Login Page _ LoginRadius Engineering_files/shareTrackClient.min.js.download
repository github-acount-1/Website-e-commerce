!function(a){"use strict";function b(a,b){var c=(65535&a)+(65535&b),d=(a>>16)+(b>>16)+(c>>16);return d<<16|65535&c}function c(a,b){return a<<b|a>>>32-b}function d(a,d,e,f,g,h){return b(c(b(b(d,a),b(f,h)),g),e)}function e(a,b,c,e,f,g,h){return d(b&c|~b&e,a,b,f,g,h)}function f(a,b,c,e,f,g,h){return d(b&e|c&~e,a,b,f,g,h)}function g(a,b,c,e,f,g,h){return d(b^c^e,a,b,f,g,h)}function h(a,b,c,e,f,g,h){return d(c^(b|~e),a,b,f,g,h)}function i(a,c){a[c>>5]|=128<<c%32,a[(c+64>>>9<<4)+14]=c;var d,i,j,k,l,m=1732584193,n=-271733879,o=-1732584194,p=271733878;for(d=0;d<a.length;d+=16)i=m,j=n,k=o,l=p,m=e(m,n,o,p,a[d],7,-680876936),p=e(p,m,n,o,a[d+1],12,-389564586),o=e(o,p,m,n,a[d+2],17,606105819),n=e(n,o,p,m,a[d+3],22,-1044525330),m=e(m,n,o,p,a[d+4],7,-176418897),p=e(p,m,n,o,a[d+5],12,1200080426),o=e(o,p,m,n,a[d+6],17,-1473231341),n=e(n,o,p,m,a[d+7],22,-45705983),m=e(m,n,o,p,a[d+8],7,1770035416),p=e(p,m,n,o,a[d+9],12,-1958414417),o=e(o,p,m,n,a[d+10],17,-42063),n=e(n,o,p,m,a[d+11],22,-1990404162),m=e(m,n,o,p,a[d+12],7,1804603682),p=e(p,m,n,o,a[d+13],12,-40341101),o=e(o,p,m,n,a[d+14],17,-1502002290),n=e(n,o,p,m,a[d+15],22,1236535329),m=f(m,n,o,p,a[d+1],5,-165796510),p=f(p,m,n,o,a[d+6],9,-1069501632),o=f(o,p,m,n,a[d+11],14,643717713),n=f(n,o,p,m,a[d],20,-373897302),m=f(m,n,o,p,a[d+5],5,-701558691),p=f(p,m,n,o,a[d+10],9,38016083),o=f(o,p,m,n,a[d+15],14,-660478335),n=f(n,o,p,m,a[d+4],20,-405537848),m=f(m,n,o,p,a[d+9],5,568446438),p=f(p,m,n,o,a[d+14],9,-1019803690),o=f(o,p,m,n,a[d+3],14,-187363961),n=f(n,o,p,m,a[d+8],20,1163531501),m=f(m,n,o,p,a[d+13],5,-1444681467),p=f(p,m,n,o,a[d+2],9,-51403784),o=f(o,p,m,n,a[d+7],14,1735328473),n=f(n,o,p,m,a[d+12],20,-1926607734),m=g(m,n,o,p,a[d+5],4,-378558),p=g(p,m,n,o,a[d+8],11,-2022574463),o=g(o,p,m,n,a[d+11],16,1839030562),n=g(n,o,p,m,a[d+14],23,-35309556),m=g(m,n,o,p,a[d+1],4,-1530992060),p=g(p,m,n,o,a[d+4],11,1272893353),o=g(o,p,m,n,a[d+7],16,-155497632),n=g(n,o,p,m,a[d+10],23,-1094730640),m=g(m,n,o,p,a[d+13],4,681279174),p=g(p,m,n,o,a[d],11,-358537222),o=g(o,p,m,n,a[d+3],16,-722521979),n=g(n,o,p,m,a[d+6],23,76029189),m=g(m,n,o,p,a[d+9],4,-640364487),p=g(p,m,n,o,a[d+12],11,-421815835),o=g(o,p,m,n,a[d+15],16,530742520),n=g(n,o,p,m,a[d+2],23,-995338651),m=h(m,n,o,p,a[d],6,-198630844),p=h(p,m,n,o,a[d+7],10,1126891415),o=h(o,p,m,n,a[d+14],15,-1416354905),n=h(n,o,p,m,a[d+5],21,-57434055),m=h(m,n,o,p,a[d+12],6,1700485571),p=h(p,m,n,o,a[d+3],10,-1894986606),o=h(o,p,m,n,a[d+10],15,-1051523),n=h(n,o,p,m,a[d+1],21,-2054922799),m=h(m,n,o,p,a[d+8],6,1873313359),p=h(p,m,n,o,a[d+15],10,-30611744),o=h(o,p,m,n,a[d+6],15,-1560198380),n=h(n,o,p,m,a[d+13],21,1309151649),m=h(m,n,o,p,a[d+4],6,-145523070),p=h(p,m,n,o,a[d+11],10,-1120210379),o=h(o,p,m,n,a[d+2],15,718787259),n=h(n,o,p,m,a[d+9],21,-343485551),m=b(m,i),n=b(n,j),o=b(o,k),p=b(p,l);return[m,n,o,p]}function j(a){var b,c="";for(b=0;b<32*a.length;b+=8)c+=String.fromCharCode(a[b>>5]>>>b%32&255);return c}function k(a){var b,c=[];for(c[(a.length>>2)-1]=void 0,b=0;b<c.length;b+=1)c[b]=0;for(b=0;b<8*a.length;b+=8)c[b>>5]|=(255&a.charCodeAt(b/8))<<b%32;return c}function l(a){return j(i(k(a),8*a.length))}function m(a,b){var c,d,e=k(a),f=[],g=[];for(f[15]=g[15]=void 0,e.length>16&&(e=i(e,8*a.length)),c=0;16>c;c+=1)f[c]=909522486^e[c],g[c]=1549556828^e[c];return d=i(f.concat(k(b)),512+8*b.length),j(i(g.concat(d),640))}function n(a){var b,c,d="0123456789abcdef",e="";for(c=0;c<a.length;c+=1)b=a.charCodeAt(c),e+=d.charAt(b>>>4&15)+d.charAt(15&b);return e}function o(a){return unescape(encodeURIComponent(a))}function p(a){return l(o(a))}function q(a){return n(p(a))}function r(a,b){return m(o(a),o(b))}function s(a,b){return n(r(a,b))}function t(a,b,c){return b?c?r(b,a):s(b,a):c?p(a):q(a)}a.md5=t}(this);

var aas = (function() {
    var documentCookies = {
        getItem: function(sKey) {
            if (!sKey) {
                return null;
            }
            return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
        },
        setItem: function(sKey, sValue, vEnd, sPath, sDomain, bSecure) {
            if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) {
                return false;
            }
            var sExpires = "";
            var vExpiryDate = {
                getInStringFormat: function(nMaxAge) { //"max-age" in second
                    if (nMaxAge === Infinity) {
                        return "Fri, 31 Dec 9999 23:59:59 GMT";
                    }
                    var dDate = new Date();
                    dDate.setTime(dDate.getTime() + (nMaxAge * 1000));
                    return dDate.toGMTString();
                }
            }
            if (vEnd) {
                switch (vEnd.constructor) {
                    case Number:
                        sExpires = "; expires=" + vExpiryDate.getInStringFormat(vEnd) + vEnd === Infinity ? "" : "; max-age=" + vEnd;
                        break;
                    case String:
                        sExpires = "; expires=" + vEnd;
                        break;
                    case Date:
                        sExpires = "; expires=" + vEnd.toUTCString();
                        break;
                }
            }
            document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
            return true;
        },
        removeItem: function(sKey, sPath, sDomain) {
            if (!this.hasItem(sKey)) {
                return false;
            }
            document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
            return true;
        },
        key: function() {
            var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
            for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) {
                aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]);
            }
            return aKeys;
        }
    };

    var isLocalStorageNameSupported = function(lsname) {
        if (window[lsname]) {
            var testKey = 'test',
                storage = window[lsname];
            try {
                storage.setItem(testKey, '1');
                storage.removeItem(testKey);
                return true;
            } catch (error) {
                return false;
            }
        } else {
            return false;
        }
    }
  
    var setBrowserStorage = function(key, value) {
        var cookieFallback = true;
        if (isLocalStorageNameSupported('localStorage')) {
            localStorage.setItem(key, value);
            cookieFallback = false;
        }

        if (isLocalStorageNameSupported('sessionStorage')) {
            sessionStorage.setItem(key, value);
            cookieFallback = false;
        }

        if (cookieFallback) {
            documentCookies.setItem(key, value);
        }
    }

    var getBrowserStorage = function(key) {

        if (isLocalStorageNameSupported('localStorage')) {
            return localStorage.getItem(key);
        }

        if (isLocalStorageNameSupported('sessionStorage')) {
            return sessionStorage.getItem(key);
        }

        return documentCookies.getItem(key);
    }


    var generateUid = function(separator) {
        var delim = separator || "-";

        function S4() {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        }
        return (S4() + S4() + delim + S4() + delim + S4() + delim + S4() + delim + S4() + S4() + S4());
    };

    var auidCookieKey = "__aasauid";
    var urlCookieKey = "__aasurl";
    var uidCookieKey = "_aasuid";

    var uidUpdate = false;

    var title = document.title || null;
    var language = window.navigator.userLanguage || window.navigator.language;
    var encoding = document.characterSet || document.charset;


    var today = new Date();
    var afterOneYear = new Date((today.getYear() + 1), (today.getMonth() + 1), (today.getDay() + 1));

    var auid = "";
    var uid = "";
    var lrsite = '';
    var providerId = "";
	
    if (getBrowserStorage(uidCookieKey)) {
        uid = getBrowserStorage(uidCookieKey);
    } else if (getBrowserStorage("lr-user-uid")) {
        uidUpdate = true;
        var val = getBrowserStorage("lr-user-uid");
        uid = val;
        setBrowserStorage(uidCookieKey, val, afterOneYear);
    }

    if (getBrowserStorage(auidCookieKey)) {
        auid = getBrowserStorage(auidCookieKey)
    } else {
        auid = generateUid();
        setBrowserStorage(auidCookieKey, auid, afterOneYear);
    }

    var url = "";
    if (getBrowserStorage(urlCookieKey)) {
        url = getBrowserStorage(urlCookieKey);
        if ((url != md5(window.location.href)) || uidUpdate) {
            //track with some delay so global option can be reflect
            setTimeout(function(){
                setImage('pageView');
            },1000);
        }

    } else {
        setTimeout(function(){
            setImage('pageView');
        },1000);
    }

    setBrowserStorage(urlCookieKey, md5(window.location.href),afterOneYear);
    function jsonToQueryString(json) {
        return Object.keys(json).map(function(key) {
            if (json[key]) {
                return encodeURIComponent(key) + '=' + encodeURIComponent(json[key]);
            }
        }).join('&');
    }
    function setImage(event,useruid, provider, customFields) {
        var cf ='';
        if(customFields){
          cf = jsonToQueryString(customFields);
         }
        providerId = provider || providerId;
        uid = useruid || uid;
        var screenResolution = 0;
        var screenColorDepth = 0;
        if (window.screen) {
            screenHeight = window.screen.height;
	    screenWidth = window.screen.width;
            screenColorDepth = window.screen.colorDepth;
        }

        var img = new Image();
        img.style.position = "fixed";
        img.onload = function() {
            if (document.body) {
                document.body.appendChild(img);
            }
        };

        img.src = '//gauge.social9.com/image.gif?aassite=' + lrsite  + '&aasauid=' + auid + "&aasuid=" + uid + "&aasurl=" + window.location.href + "&aassh=" + screenHeight + "&aassw=" + screenWidth + "&aasscd=" + screenColorDepth + "&aashn=" + window.location.hostname + "&aaspt=" + title + "&aasln=" + language + "&aasenc=" + encoding +"&aasev=" + event + "&aasidprov=" + providerId + "&" + cf;
    }
    var module= {};

    module.track = function(event,uid, provider,customFields){
        setImage(event,uid, provider, customFields);
    }


    module.setUid = function(id){
        uid = id;
        setBrowserStorage(uidCookieKey, uid, afterOneYear);
    }

    module.init = function(options){
        options = options || {};

        uid = options.uid;
        lrsite = options.appName || options.appname;

        setBrowserStorage(uidCookieKey, uid, afterOneYear);
    }

    return module;
})();

var LoginRadiusAnonymous = aas;