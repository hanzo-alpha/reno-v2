function Ht(a, t) {
    var e = Object.keys(a);
    if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(a);
        t && (i = i.filter(function(o) {
            return Object.getOwnPropertyDescriptor(a, o).enumerable;
        })), e.push.apply(e, i);
    }
    return e;
}

function Jt(a) {
    for (var t = 1; t < arguments.length; t++) {
        var e = arguments[t] != null ? arguments[t] : {};
        t % 2 ? Ht(Object(e), !0).forEach(function(i) {
            bi(a, i, e[i]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(a, Object.getOwnPropertyDescriptors(e)) : Ht(Object(e)).forEach(function(i) {
            Object.defineProperty(a, i, Object.getOwnPropertyDescriptor(e, i));
        });
    }
    return a;
}

function mi(a, t) {
    if (typeof a != 'object' || !a) return a;
    var e = a[Symbol.toPrimitive];
    if (e !== void 0) {
        var i = e.call(a, t || 'default');
        if (typeof i != 'object') return i;
        throw new TypeError('@@toPrimitive must return a primitive value.');
    }
    return (t === 'string' ? String : Number)(a);
}

function ti(a) {
    var t = mi(a, 'string');
    return typeof t == 'symbol' ? t : t + '';
}

function vt(a) {
    '@babel/helpers - typeof';
    return vt = typeof Symbol == 'function' && typeof Symbol.iterator == 'symbol' ? function(t) {
        return typeof t;
    } : function(t) {
        return t && typeof Symbol == 'function' && t.constructor === Symbol && t !== Symbol.prototype ? 'symbol' : typeof t;
    }, vt(a);
}

function vi(a, t) {
    if (!(a instanceof t)) throw new TypeError('Cannot call a class as a function');
}

function Pt(a, t) {
    for (var e = 0; e < t.length; e++) {
        var i = t[e];
        i.enumerable = i.enumerable || !1, i.configurable = !0, 'value' in i && (i.writable = !0), Object.defineProperty(a, ti(i.key), i);
    }
}

function wi(a, t, e) {
    return t && Pt(a.prototype, t), e && Pt(a, e), Object.defineProperty(a, 'prototype', { writable: !1 }), a;
}

function bi(a, t, e) {
    return t = ti(t), t in a ? Object.defineProperty(a, t, {
        value: e,
        enumerable: !0,
        configurable: !0,
        writable: !0,
    }) : a[t] = e, a;
}

function ii(a) {
    return yi(a) || xi(a) || Di(a) || Ei();
}

function yi(a) {
    if (Array.isArray(a)) return wt(a);
}

function xi(a) {
    if (typeof Symbol < 'u' && a[Symbol.iterator] != null || a['@@iterator'] != null) return Array.from(a);
}

function Di(a, t) {
    if (a) {
        if (typeof a == 'string') return wt(a, t);
        var e = Object.prototype.toString.call(a).slice(8, -1);
        if (e === 'Object' && a.constructor && (e = a.constructor.name), e === 'Map' || e === 'Set') return Array.from(a);
        if (e === 'Arguments' || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(e)) return wt(a, t);
    }
}

function wt(a, t) {
    (t == null || t > a.length) && (t = a.length);
    for (var e = 0, i = new Array(t); e < t; e++) i[e] = a[e];
    return i;
}

function Ei() {
    throw new TypeError(`Invalid attempt to spread non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`);
}

var ft = typeof window < 'u' && typeof window.document < 'u', H = ft ? window : {},
    Ot = ft && H.document.documentElement ? 'ontouchstart' in H.document.documentElement : !1,
    Nt = ft ? 'PointerEvent' in H : !1, y = 'cropper', At = 'all', ei = 'crop', ai = 'move', ri = 'zoom', G = 'e',
    q = 'w', K = 's', X = 'n', it = 'ne', et = 'nw', at = 'se', rt = 'sw', bt = ''.concat(y, '-crop'),
    Yt = ''.concat(y, '-disabled'), S = ''.concat(y, '-hidden'), zt = ''.concat(y, '-hide'),
    Mi = ''.concat(y, '-invisible'), pt = ''.concat(y, '-modal'), yt = ''.concat(y, '-move'),
    ot = ''.concat(y, 'Action'), ct = ''.concat(y, 'Preview'), St = 'crop', ni = 'move', oi = 'none', xt = 'crop',
    Dt = 'cropend', Et = 'cropmove', Mt = 'cropstart', Xt = 'dblclick', Ci = Ot ? 'touchstart' : 'mousedown',
    Ti = Ot ? 'touchmove' : 'mousemove', Oi = Ot ? 'touchend touchcancel' : 'mouseup', Wt = Nt ? 'pointerdown' : Ci,
    Ut = Nt ? 'pointermove' : Ti, jt = Nt ? 'pointerup pointercancel' : Oi, Vt = 'ready', $t = 'resize', Gt = 'wheel',
    Ct = 'zoom', qt = 'image/jpeg', Ni = /^e|w|s|n|se|sw|ne|nw|all|crop|move|zoom$/, Ai = /^data:/,
    Si = /^data:image\/jpeg;base64,/, Ri = /^img|canvas$/i, si = 200, hi = 100, Ft = {
        viewMode: 0,
        dragMode: St,
        initialAspectRatio: NaN,
        aspectRatio: NaN,
        data: null,
        preview: '',
        responsive: !0,
        restore: !0,
        checkCrossOrigin: !0,
        checkOrientation: !0,
        modal: !0,
        guides: !0,
        center: !0,
        highlight: !0,
        background: !0,
        autoCrop: !0,
        autoCropArea: .8,
        movable: !0,
        rotatable: !0,
        scalable: !0,
        zoomable: !0,
        zoomOnTouch: !0,
        zoomOnWheel: !0,
        wheelZoomRatio: .1,
        cropBoxMovable: !0,
        cropBoxResizable: !0,
        toggleDragModeOnDblclick: !0,
        minCanvasWidth: 0,
        minCanvasHeight: 0,
        minCropBoxWidth: 0,
        minCropBoxHeight: 0,
        minContainerWidth: si,
        minContainerHeight: hi,
        ready: null,
        cropstart: null,
        cropmove: null,
        cropend: null,
        crop: null,
        zoom: null,
    },
    Bi = '<div class="cropper-container" touch-action="none"><div class="cropper-wrap-box"><div class="cropper-canvas"></div></div><div class="cropper-drag-box"></div><div class="cropper-crop-box"><span class="cropper-view-box"></span><span class="cropper-dashed dashed-h"></span><span class="cropper-dashed dashed-v"></span><span class="cropper-center"></span><span class="cropper-face"></span><span class="cropper-line line-e" data-cropper-action="e"></span><span class="cropper-line line-n" data-cropper-action="n"></span><span class="cropper-line line-w" data-cropper-action="w"></span><span class="cropper-line line-s" data-cropper-action="s"></span><span class="cropper-point point-e" data-cropper-action="e"></span><span class="cropper-point point-n" data-cropper-action="n"></span><span class="cropper-point point-w" data-cropper-action="w"></span><span class="cropper-point point-s" data-cropper-action="s"></span><span class="cropper-point point-ne" data-cropper-action="ne"></span><span class="cropper-point point-nw" data-cropper-action="nw"></span><span class="cropper-point point-sw" data-cropper-action="sw"></span><span class="cropper-point point-se" data-cropper-action="se"></span></div></div>',
    Ii = Number.isNaN || H.isNaN;

function g(a) {
    return typeof a == 'number' && !Ii(a);
}

var Kt = function(t) {
    return t > 0 && t < 1 / 0;
};

function gt(a) {
    return typeof a > 'u';
}

function F(a) {
    return vt(a) === 'object' && a !== null;
}

var ki = Object.prototype.hasOwnProperty;

function Q(a) {
    if (!F(a)) return !1;
    try {
        var t = a.constructor, e = t.prototype;
        return t && e && ki.call(e, 'isPrototypeOf');
    } catch {
        return !1;
    }
}

function A(a) {
    return typeof a == 'function';
}

var Li = Array.prototype.slice;

function ci(a) {
    return Array.from ? Array.from(a) : Li.call(a);
}

function E(a, t) {
    return a && A(t) && (Array.isArray(a) || g(a.length) ? ci(a).forEach(function(e, i) {
        t.call(a, e, i, a);
    }) : F(a) && Object.keys(a).forEach(function(e) {
        t.call(a, a[e], e, a);
    })), a;
}

var x = Object.assign || function(t) {
    for (var e = arguments.length, i = new Array(e > 1 ? e - 1 : 0), o = 1; o < e; o++) i[o - 1] = arguments[o];
    return F(t) && i.length > 0 && i.forEach(function(r) {
        F(r) && Object.keys(r).forEach(function(n) {
            t[n] = r[n];
        });
    }), t;
}, _i = /\.\d*(?:0|9){12}\d*$/;

function J(a) {
    var t = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : 1e11;
    return _i.test(a) ? Math.round(a * t) / t : a;
}

var Hi = /^width|height|left|top|marginLeft|marginTop$/;

function W(a, t) {
    var e = a.style;
    E(t, function(i, o) {
        Hi.test(o) && g(i) && (i = ''.concat(i, 'px')), e[o] = i;
    });
}

function Pi(a, t) {
    return a.classList ? a.classList.contains(t) : a.className.indexOf(t) > -1;
}

function O(a, t) {
    if (t) {
        if (g(a.length)) {
            E(a, function(i) {
                O(i, t);
            });
            return;
        }
        if (a.classList) {
            a.classList.add(t);
            return;
        }
        var e = a.className.trim();
        e ? e.indexOf(t) < 0 && (a.className = ''.concat(e, ' ').concat(t)) : a.className = t;
    }
}

function _(a, t) {
    if (t) {
        if (g(a.length)) {
            E(a, function(e) {
                _(e, t);
            });
            return;
        }
        if (a.classList) {
            a.classList.remove(t);
            return;
        }
        a.className.indexOf(t) >= 0 && (a.className = a.className.replace(t, ''));
    }
}

function Z(a, t, e) {
    if (t) {
        if (g(a.length)) {
            E(a, function(i) {
                Z(i, t, e);
            });
            return;
        }
        e ? O(a, t) : _(a, t);
    }
}

var Yi = /([a-z\d])([A-Z])/g;

function Rt(a) {
    return a.replace(Yi, '$1-$2').toLowerCase();
}

function Tt(a, t) {
    return F(a[t]) ? a[t] : a.dataset ? a.dataset[t] : a.getAttribute('data-'.concat(Rt(t)));
}

function st(a, t, e) {
    F(e) ? a[t] = e : a.dataset ? a.dataset[t] = e : a.setAttribute('data-'.concat(Rt(t)), e);
}

function zi(a, t) {
    if (F(a[t])) try {
        delete a[t];
    } catch {
        a[t] = void 0;
    } else if (a.dataset) try {
        delete a.dataset[t];
    } catch {
        a.dataset[t] = void 0;
    } else a.removeAttribute('data-'.concat(Rt(t)));
}

var li = /\s\s*/, pi = function() {
    var a = !1;
    if (ft) {
        var t = !1, e = function() {
        }, i = Object.defineProperty({}, 'once', {
            get: function() {
                return a = !0, t;
            }, set: function(r) {
                t = r;
            },
        });
        H.addEventListener('test', e, i), H.removeEventListener('test', e, i);
    }
    return a;
}();

function k(a, t, e) {
    var i = arguments.length > 3 && arguments[3] !== void 0 ? arguments[3] : {}, o = e;
    t.trim().split(li).forEach(function(r) {
        if (!pi) {
            var n = a.listeners;
            n && n[r] && n[r][e] && (o = n[r][e], delete n[r][e], Object.keys(n[r]).length === 0 && delete n[r], Object.keys(n).length === 0 && delete a.listeners);
        }
        a.removeEventListener(r, o, i);
    });
}

function I(a, t, e) {
    var i = arguments.length > 3 && arguments[3] !== void 0 ? arguments[3] : {}, o = e;
    t.trim().split(li).forEach(function(r) {
        if (i.once && !pi) {
            var n = a.listeners, s = n === void 0 ? {} : n;
            o = function() {
                delete s[r][e], a.removeEventListener(r, o, i);
                for (var l = arguments.length, h = new Array(l), c = 0; c < l; c++) h[c] = arguments[c];
                e.apply(a, h);
            }, s[r] || (s[r] = {}), s[r][e] && a.removeEventListener(r, s[r][e], i), s[r][e] = o, a.listeners = s;
        }
        a.addEventListener(r, o, i);
    });
}

function tt(a, t, e) {
    var i;
    return A(Event) && A(CustomEvent) ? i = new CustomEvent(t, {
        detail: e,
        bubbles: !0,
        cancelable: !0,
    }) : (i = document.createEvent('CustomEvent'), i.initCustomEvent(t, !0, !0, e)), a.dispatchEvent(i);
}

function fi(a) {
    var t = a.getBoundingClientRect();
    return {
        left: t.left + (window.pageXOffset - document.documentElement.clientLeft),
        top: t.top + (window.pageYOffset - document.documentElement.clientTop),
    };
}

var mt = H.location, Xi = /^(\w+:)\/\/([^:/?#]*):?(\d*)/i;

function Qt(a) {
    var t = a.match(Xi);
    return t !== null && (t[1] !== mt.protocol || t[2] !== mt.hostname || t[3] !== mt.port);
}

function Zt(a) {
    var t = 'timestamp='.concat(new Date().getTime());
    return a + (a.indexOf('?') === -1 ? '?' : '&') + t;
}

function nt(a) {
    var t = a.rotate, e = a.scaleX, i = a.scaleY, o = a.translateX, r = a.translateY, n = [];
    g(o) && o !== 0 && n.push('translateX('.concat(o, 'px)')), g(r) && r !== 0 && n.push('translateY('.concat(r, 'px)')), g(t) && t !== 0 && n.push('rotate('.concat(t, 'deg)')), g(e) && e !== 1 && n.push('scaleX('.concat(e, ')')), g(i) && i !== 1 && n.push('scaleY('.concat(i, ')'));
    var s = n.length ? n.join(' ') : 'none';
    return { WebkitTransform: s, msTransform: s, transform: s };
}

function Wi(a) {
    var t = Jt({}, a), e = 0;
    return E(a, function(i, o) {
        delete t[o], E(t, function(r) {
            var n = Math.abs(i.startX - r.startX), s = Math.abs(i.startY - r.startY), p = Math.abs(i.endX - r.endX),
                l = Math.abs(i.endY - r.endY), h = Math.sqrt(n * n + s * s), c = Math.sqrt(p * p + l * l),
                f = (c - h) / h;
            Math.abs(f) > Math.abs(e) && (e = f);
        });
    }), e;
}

function lt(a, t) {
    var e = a.pageX, i = a.pageY, o = { endX: e, endY: i };
    return t ? o : Jt({ startX: e, startY: i }, o);
}

function Ui(a) {
    var t = 0, e = 0, i = 0;
    return E(a, function(o) {
        var r = o.startX, n = o.startY;
        t += r, e += n, i += 1;
    }), t /= i, e /= i, { pageX: t, pageY: e };
}

function U(a) {
    var t = a.aspectRatio, e = a.height, i = a.width,
        o = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : 'contain', r = Kt(i), n = Kt(e);
    if (r && n) {
        var s = e * t;
        o === 'contain' && s > i || o === 'cover' && s < i ? e = i / t : i = e * t;
    } else r ? e = i / t : n && (i = e * t);
    return { width: i, height: e };
}

function ji(a) {
    var t = a.width, e = a.height, i = a.degree;
    if (i = Math.abs(i) % 180, i === 90) return { width: e, height: t };
    var o = i % 90 * Math.PI / 180, r = Math.sin(o), n = Math.cos(o), s = t * n + e * r, p = t * r + e * n;
    return i > 90 ? { width: p, height: s } : { width: s, height: p };
}

function Vi(a, t, e, i) {
    var o = t.aspectRatio, r = t.naturalWidth, n = t.naturalHeight, s = t.rotate, p = s === void 0 ? 0 : s,
        l = t.scaleX, h = l === void 0 ? 1 : l, c = t.scaleY, f = c === void 0 ? 1 : c, u = e.aspectRatio,
        m = e.naturalWidth, b = e.naturalHeight, v = i.fillColor, M = v === void 0 ? 'transparent' : v,
        T = i.imageSmoothingEnabled, D = T === void 0 ? !0 : T, P = i.imageSmoothingQuality,
        R = P === void 0 ? 'low' : P, d = i.maxWidth, w = d === void 0 ? 1 / 0 : d, C = i.maxHeight,
        B = C === void 0 ? 1 / 0 : C, Y = i.minWidth, j = Y === void 0 ? 0 : Y, V = i.minHeight,
        z = V === void 0 ? 0 : V, L = document.createElement('canvas'), N = L.getContext('2d'),
        $ = U({ aspectRatio: u, width: w, height: B }), ht = U({ aspectRatio: u, width: j, height: z }, 'cover'),
        dt = Math.min($.width, Math.max(ht.width, m)), ut = Math.min($.height, Math.max(ht.height, b)),
        It = U({ aspectRatio: o, width: w, height: B }), kt = U({ aspectRatio: o, width: j, height: z }, 'cover'),
        Lt = Math.min(It.width, Math.max(kt.width, r)), _t = Math.min(It.height, Math.max(kt.height, n)),
        ui = [-Lt / 2, -_t / 2, Lt, _t];
    return L.width = J(dt), L.height = J(ut), N.fillStyle = M, N.fillRect(0, 0, dt, ut), N.save(), N.translate(dt / 2, ut / 2), N.rotate(p * Math.PI / 180), N.scale(h, f), N.imageSmoothingEnabled = D, N.imageSmoothingQuality = R, N.drawImage.apply(N, [a].concat(ii(ui.map(function(gi) {
        return Math.floor(J(gi));
    })))), N.restore(), L;
}

var di = String.fromCharCode;

function $i(a, t, e) {
    var i = '';
    e += t;
    for (var o = t; o < e; o += 1) i += di(a.getUint8(o));
    return i;
}

var Gi = /^data:.*,/;

function qi(a) {
    var t = a.replace(Gi, ''), e = atob(t), i = new ArrayBuffer(e.length), o = new Uint8Array(i);
    return E(o, function(r, n) {
        o[n] = e.charCodeAt(n);
    }), i;
}

function Fi(a, t) {
    for (var e = [], i = 8192, o = new Uint8Array(a); o.length > 0;) e.push(di.apply(null, ci(o.subarray(0, i)))), o = o.subarray(i);
    return 'data:'.concat(t, ';base64,').concat(btoa(e.join('')));
}

function Ki(a) {
    var t = new DataView(a), e;
    try {
        var i, o, r;
        if (t.getUint8(0) === 255 && t.getUint8(1) === 216) for (var n = t.byteLength, s = 2; s + 1 < n;) {
            if (t.getUint8(s) === 255 && t.getUint8(s + 1) === 225) {
                o = s;
                break;
            }
            s += 1;
        }
        if (o) {
            var p = o + 4, l = o + 10;
            if ($i(t, p, 4) === 'Exif') {
                var h = t.getUint16(l);
                if (i = h === 18761, (i || h === 19789) && t.getUint16(l + 2, i) === 42) {
                    var c = t.getUint32(l + 4, i);
                    c >= 8 && (r = l + c);
                }
            }
        }
        if (r) {
            var f = t.getUint16(r, i), u, m;
            for (m = 0; m < f; m += 1) if (u = r + m * 12 + 2, t.getUint16(u, i) === 274) {
                u += 8, e = t.getUint16(u, i), t.setUint16(u, 1, i);
                break;
            }
        }
    } catch {
        e = 1;
    }
    return e;
}

function Qi(a) {
    var t = 0, e = 1, i = 1;
    switch (a) {
        case 2:
            e = -1;
            break;
        case 3:
            t = -180;
            break;
        case 4:
            i = -1;
            break;
        case 5:
            t = 90, i = -1;
            break;
        case 6:
            t = 90;
            break;
        case 7:
            t = 90, e = -1;
            break;
        case 8:
            t = -90;
            break;
    }
    return { rotate: t, scaleX: e, scaleY: i };
}

var Zi = {
    render: function() {
        this.initContainer(), this.initCanvas(), this.initCropBox(), this.renderCanvas(), this.cropped && this.renderCropBox();
    }, initContainer: function() {
        var t = this.element, e = this.options, i = this.container, o = this.cropper, r = Number(e.minContainerWidth),
            n = Number(e.minContainerHeight);
        O(o, S), _(t, S);
        var s = { width: Math.max(i.offsetWidth, r >= 0 ? r : si), height: Math.max(i.offsetHeight, n >= 0 ? n : hi) };
        this.containerData = s, W(o, { width: s.width, height: s.height }), O(t, S), _(o, S);
    }, initCanvas: function() {
        var t = this.containerData, e = this.imageData, i = this.options.viewMode, o = Math.abs(e.rotate) % 180 === 90,
            r = o ? e.naturalHeight : e.naturalWidth, n = o ? e.naturalWidth : e.naturalHeight, s = r / n, p = t.width,
            l = t.height;
        t.height * s > t.width ? i === 3 ? p = t.height * s : l = t.width / s : i === 3 ? l = t.width / s : p = t.height * s;
        var h = { aspectRatio: s, naturalWidth: r, naturalHeight: n, width: p, height: l };
        this.canvasData = h, this.limited = i === 1 || i === 2, this.limitCanvas(!0, !0), h.width = Math.min(Math.max(h.width, h.minWidth), h.maxWidth), h.height = Math.min(Math.max(h.height, h.minHeight), h.maxHeight), h.left = (t.width - h.width) / 2, h.top = (t.height - h.height) / 2, h.oldLeft = h.left, h.oldTop = h.top, this.initialCanvasData = x({}, h);
    }, limitCanvas: function(t, e) {
        var i = this.options, o = this.containerData, r = this.canvasData, n = this.cropBoxData, s = i.viewMode,
            p = r.aspectRatio, l = this.cropped && n;
        if (t) {
            var h = Number(i.minCanvasWidth) || 0, c = Number(i.minCanvasHeight) || 0;
            s > 1 ? (h = Math.max(h, o.width), c = Math.max(c, o.height), s === 3 && (c * p > h ? h = c * p : c = h / p)) : s > 0 && (h ? h = Math.max(h, l ? n.width : 0) : c ? c = Math.max(c, l ? n.height : 0) : l && (h = n.width, c = n.height, c * p > h ? h = c * p : c = h / p));
            var f = U({ aspectRatio: p, width: h, height: c });
            h = f.width, c = f.height, r.minWidth = h, r.minHeight = c, r.maxWidth = 1 / 0, r.maxHeight = 1 / 0;
        }
        if (e) if (s > (l ? 0 : 1)) {
            var u = o.width - r.width, m = o.height - r.height;
            r.minLeft = Math.min(0, u), r.minTop = Math.min(0, m), r.maxLeft = Math.max(0, u), r.maxTop = Math.max(0, m), l && this.limited && (r.minLeft = Math.min(n.left, n.left + (n.width - r.width)), r.minTop = Math.min(n.top, n.top + (n.height - r.height)), r.maxLeft = n.left, r.maxTop = n.top, s === 2 && (r.width >= o.width && (r.minLeft = Math.min(0, u), r.maxLeft = Math.max(0, u)), r.height >= o.height && (r.minTop = Math.min(0, m), r.maxTop = Math.max(0, m))));
        } else r.minLeft = -r.width, r.minTop = -r.height, r.maxLeft = o.width, r.maxTop = o.height;
    }, renderCanvas: function(t, e) {
        var i = this.canvasData, o = this.imageData;
        if (e) {
            var r = ji({
                width: o.naturalWidth * Math.abs(o.scaleX || 1),
                height: o.naturalHeight * Math.abs(o.scaleY || 1),
                degree: o.rotate || 0,
            }), n = r.width, s = r.height, p = i.width * (n / i.naturalWidth), l = i.height * (s / i.naturalHeight);
            i.left -= (p - i.width) / 2, i.top -= (l - i.height) / 2, i.width = p, i.height = l, i.aspectRatio = n / s, i.naturalWidth = n, i.naturalHeight = s, this.limitCanvas(!0, !1);
        }
        (i.width > i.maxWidth || i.width < i.minWidth) && (i.left = i.oldLeft), (i.height > i.maxHeight || i.height < i.minHeight) && (i.top = i.oldTop), i.width = Math.min(Math.max(i.width, i.minWidth), i.maxWidth), i.height = Math.min(Math.max(i.height, i.minHeight), i.maxHeight), this.limitCanvas(!1, !0), i.left = Math.min(Math.max(i.left, i.minLeft), i.maxLeft), i.top = Math.min(Math.max(i.top, i.minTop), i.maxTop), i.oldLeft = i.left, i.oldTop = i.top, W(this.canvas, x({
            width: i.width,
            height: i.height,
        }, nt({
            translateX: i.left,
            translateY: i.top,
        }))), this.renderImage(t), this.cropped && this.limited && this.limitCropBox(!0, !0);
    }, renderImage: function(t) {
        var e = this.canvasData, i = this.imageData, o = i.naturalWidth * (e.width / e.naturalWidth),
            r = i.naturalHeight * (e.height / e.naturalHeight);
        x(i, {
            width: o,
            height: r,
            left: (e.width - o) / 2,
            top: (e.height - r) / 2,
        }), W(this.image, x({ width: i.width, height: i.height }, nt(x({
            translateX: i.left,
            translateY: i.top,
        }, i)))), t && this.output();
    }, initCropBox: function() {
        var t = this.options, e = this.canvasData, i = t.aspectRatio || t.initialAspectRatio,
            o = Number(t.autoCropArea) || .8, r = { width: e.width, height: e.height };
        i && (e.height * i > e.width ? r.height = r.width / i : r.width = r.height * i), this.cropBoxData = r, this.limitCropBox(!0, !0), r.width = Math.min(Math.max(r.width, r.minWidth), r.maxWidth), r.height = Math.min(Math.max(r.height, r.minHeight), r.maxHeight), r.width = Math.max(r.minWidth, r.width * o), r.height = Math.max(r.minHeight, r.height * o), r.left = e.left + (e.width - r.width) / 2, r.top = e.top + (e.height - r.height) / 2, r.oldLeft = r.left, r.oldTop = r.top, this.initialCropBoxData = x({}, r);
    }, limitCropBox: function(t, e) {
        var i = this.options, o = this.containerData, r = this.canvasData, n = this.cropBoxData, s = this.limited,
            p = i.aspectRatio;
        if (t) {
            var l = Number(i.minCropBoxWidth) || 0, h = Number(i.minCropBoxHeight) || 0,
                c = s ? Math.min(o.width, r.width, r.width + r.left, o.width - r.left) : o.width,
                f = s ? Math.min(o.height, r.height, r.height + r.top, o.height - r.top) : o.height;
            l = Math.min(l, o.width), h = Math.min(h, o.height), p && (l && h ? h * p > l ? h = l / p : l = h * p : l ? h = l / p : h && (l = h * p), f * p > c ? f = c / p : c = f * p), n.minWidth = Math.min(l, c), n.minHeight = Math.min(h, f), n.maxWidth = c, n.maxHeight = f;
        }
        e && (s ? (n.minLeft = Math.max(0, r.left), n.minTop = Math.max(0, r.top), n.maxLeft = Math.min(o.width, r.left + r.width) - n.width, n.maxTop = Math.min(o.height, r.top + r.height) - n.height) : (n.minLeft = 0, n.minTop = 0, n.maxLeft = o.width - n.width, n.maxTop = o.height - n.height));
    }, renderCropBox: function() {
        var t = this.options, e = this.containerData, i = this.cropBoxData;
        (i.width > i.maxWidth || i.width < i.minWidth) && (i.left = i.oldLeft), (i.height > i.maxHeight || i.height < i.minHeight) && (i.top = i.oldTop), i.width = Math.min(Math.max(i.width, i.minWidth), i.maxWidth), i.height = Math.min(Math.max(i.height, i.minHeight), i.maxHeight), this.limitCropBox(!1, !0), i.left = Math.min(Math.max(i.left, i.minLeft), i.maxLeft), i.top = Math.min(Math.max(i.top, i.minTop), i.maxTop), i.oldLeft = i.left, i.oldTop = i.top, t.movable && t.cropBoxMovable && st(this.face, ot, i.width >= e.width && i.height >= e.height ? ai : At), W(this.cropBox, x({
            width: i.width,
            height: i.height,
        }, nt({
            translateX: i.left,
            translateY: i.top,
        }))), this.cropped && this.limited && this.limitCanvas(!0, !0), this.disabled || this.output();
    }, output: function() {
        this.preview(), tt(this.element, xt, this.getData());
    },
}, Ji = {
    initPreview: function() {
        var t = this.element, e = this.crossOrigin, i = this.options.preview, o = e ? this.crossOriginUrl : this.url,
            r = t.alt || 'The image to preview', n = document.createElement('img');
        if (e && (n.crossOrigin = e), n.src = o, n.alt = r, this.viewBox.appendChild(n), this.viewBoxImage = n, !!i) {
            var s = i;
            typeof i == 'string' ? s = t.ownerDocument.querySelectorAll(i) : i.querySelector && (s = [i]), this.previews = s, E(s, function(p) {
                var l = document.createElement('img');
                st(p, ct, {
                    width: p.offsetWidth,
                    height: p.offsetHeight,
                    html: p.innerHTML,
                }), e && (l.crossOrigin = e), l.src = o, l.alt = r, l.style.cssText = 'display:block;width:100%;height:auto;min-width:0!important;min-height:0!important;max-width:none!important;max-height:none!important;image-orientation:0deg!important;"', p.innerHTML = '', p.appendChild(l);
            });
        }
    }, resetPreview: function() {
        E(this.previews, function(t) {
            var e = Tt(t, ct);
            W(t, { width: e.width, height: e.height }), t.innerHTML = e.html, zi(t, ct);
        });
    }, preview: function() {
        var t = this.imageData, e = this.canvasData, i = this.cropBoxData, o = i.width, r = i.height, n = t.width,
            s = t.height, p = i.left - e.left - t.left, l = i.top - e.top - t.top;
        !this.cropped || this.disabled || (W(this.viewBoxImage, x({ width: n, height: s }, nt(x({
            translateX: -p,
            translateY: -l,
        }, t)))), E(this.previews, function(h) {
            var c = Tt(h, ct), f = c.width, u = c.height, m = f, b = u, v = 1;
            o && (v = f / o, b = r * v), r && b > u && (v = u / r, m = o * v, b = u), W(h, {
                width: m,
                height: b,
            }), W(h.getElementsByTagName('img')[0], x({ width: n * v, height: s * v }, nt(x({
                translateX: -p * v,
                translateY: -l * v,
            }, t))));
        }));
    },
}, te = {
    bind: function() {
        var t = this.element, e = this.options, i = this.cropper;
        A(e.cropstart) && I(t, Mt, e.cropstart), A(e.cropmove) && I(t, Et, e.cropmove), A(e.cropend) && I(t, Dt, e.cropend), A(e.crop) && I(t, xt, e.crop), A(e.zoom) && I(t, Ct, e.zoom), I(i, Wt, this.onCropStart = this.cropStart.bind(this)), e.zoomable && e.zoomOnWheel && I(i, Gt, this.onWheel = this.wheel.bind(this), {
            passive: !1,
            capture: !0,
        }), e.toggleDragModeOnDblclick && I(i, Xt, this.onDblclick = this.dblclick.bind(this)), I(t.ownerDocument, Ut, this.onCropMove = this.cropMove.bind(this)), I(t.ownerDocument, jt, this.onCropEnd = this.cropEnd.bind(this)), e.responsive && I(window, $t, this.onResize = this.resize.bind(this));
    }, unbind: function() {
        var t = this.element, e = this.options, i = this.cropper;
        A(e.cropstart) && k(t, Mt, e.cropstart), A(e.cropmove) && k(t, Et, e.cropmove), A(e.cropend) && k(t, Dt, e.cropend), A(e.crop) && k(t, xt, e.crop), A(e.zoom) && k(t, Ct, e.zoom), k(i, Wt, this.onCropStart), e.zoomable && e.zoomOnWheel && k(i, Gt, this.onWheel, {
            passive: !1,
            capture: !0,
        }), e.toggleDragModeOnDblclick && k(i, Xt, this.onDblclick), k(t.ownerDocument, Ut, this.onCropMove), k(t.ownerDocument, jt, this.onCropEnd), e.responsive && k(window, $t, this.onResize);
    },
}, ie = {
    resize: function() {
        if (!this.disabled) {
            var t = this.options, e = this.container, i = this.containerData, o = e.offsetWidth / i.width,
                r = e.offsetHeight / i.height, n = Math.abs(o - 1) > Math.abs(r - 1) ? o : r;
            if (n !== 1) {
                var s, p;
                t.restore && (s = this.getCanvasData(), p = this.getCropBoxData()), this.render(), t.restore && (this.setCanvasData(E(s, function(l, h) {
                    s[h] = l * n;
                })), this.setCropBoxData(E(p, function(l, h) {
                    p[h] = l * n;
                })));
            }
        }
    }, dblclick: function() {
        this.disabled || this.options.dragMode === oi || this.setDragMode(Pi(this.dragBox, bt) ? ni : St);
    }, wheel: function(t) {
        var e = this, i = Number(this.options.wheelZoomRatio) || .1, o = 1;
        this.disabled || (t.preventDefault(), !this.wheeling && (this.wheeling = !0, setTimeout(function() {
            e.wheeling = !1;
        }, 50), t.deltaY ? o = t.deltaY > 0 ? 1 : -1 : t.wheelDelta ? o = -t.wheelDelta / 120 : t.detail && (o = t.detail > 0 ? 1 : -1), this.zoom(-o * i, t)));
    }, cropStart: function(t) {
        var e = t.buttons, i = t.button;
        if (!(this.disabled || (t.type === 'mousedown' || t.type === 'pointerdown' && t.pointerType === 'mouse') && (g(e) && e !== 1 || g(i) && i !== 0 || t.ctrlKey))) {
            var o = this.options, r = this.pointers, n;
            t.changedTouches ? E(t.changedTouches, function(s) {
                r[s.identifier] = lt(s);
            }) : r[t.pointerId || 0] = lt(t), Object.keys(r).length > 1 && o.zoomable && o.zoomOnTouch ? n = ri : n = Tt(t.target, ot), Ni.test(n) && tt(this.element, Mt, {
                originalEvent: t,
                action: n,
            }) !== !1 && (t.preventDefault(), this.action = n, this.cropping = !1, n === ei && (this.cropping = !0, O(this.dragBox, pt)));
        }
    }, cropMove: function(t) {
        var e = this.action;
        if (!(this.disabled || !e)) {
            var i = this.pointers;
            t.preventDefault(), tt(this.element, Et, {
                originalEvent: t,
                action: e,
            }) !== !1 && (t.changedTouches ? E(t.changedTouches, function(o) {
                x(i[o.identifier] || {}, lt(o, !0));
            }) : x(i[t.pointerId || 0] || {}, lt(t, !0)), this.change(t));
        }
    }, cropEnd: function(t) {
        if (!this.disabled) {
            var e = this.action, i = this.pointers;
            t.changedTouches ? E(t.changedTouches, function(o) {
                delete i[o.identifier];
            }) : delete i[t.pointerId || 0], e && (t.preventDefault(), Object.keys(i).length || (this.action = ''), this.cropping && (this.cropping = !1, Z(this.dragBox, pt, this.cropped && this.options.modal)), tt(this.element, Dt, {
                originalEvent: t,
                action: e,
            }));
        }
    },
}, ee = {
    change: function(t) {
        var e = this.options, i = this.canvasData, o = this.containerData, r = this.cropBoxData, n = this.pointers,
            s = this.action, p = e.aspectRatio, l = r.left, h = r.top, c = r.width, f = r.height, u = l + c, m = h + f,
            b = 0, v = 0, M = o.width, T = o.height, D = !0, P;
        !p && t.shiftKey && (p = c && f ? c / f : 1), this.limited && (b = r.minLeft, v = r.minTop, M = b + Math.min(o.width, i.width, i.left + i.width), T = v + Math.min(o.height, i.height, i.top + i.height));
        var R = n[Object.keys(n)[0]], d = { x: R.endX - R.startX, y: R.endY - R.startY }, w = function(B) {
            switch (B) {
                case G:
                    u + d.x > M && (d.x = M - u);
                    break;
                case q:
                    l + d.x < b && (d.x = b - l);
                    break;
                case X:
                    h + d.y < v && (d.y = v - h);
                    break;
                case K:
                    m + d.y > T && (d.y = T - m);
                    break;
            }
        };
        switch (s) {
            case At:
                l += d.x, h += d.y;
                break;
            case G:
                if (d.x >= 0 && (u >= M || p && (h <= v || m >= T))) {
                    D = !1;
                    break;
                }
                w(G), c += d.x, c < 0 && (s = q, c = -c, l -= c), p && (f = c / p, h += (r.height - f) / 2);
                break;
            case X:
                if (d.y <= 0 && (h <= v || p && (l <= b || u >= M))) {
                    D = !1;
                    break;
                }
                w(X), f -= d.y, h += d.y, f < 0 && (s = K, f = -f, h -= f), p && (c = f * p, l += (r.width - c) / 2);
                break;
            case q:
                if (d.x <= 0 && (l <= b || p && (h <= v || m >= T))) {
                    D = !1;
                    break;
                }
                w(q), c -= d.x, l += d.x, c < 0 && (s = G, c = -c, l -= c), p && (f = c / p, h += (r.height - f) / 2);
                break;
            case K:
                if (d.y >= 0 && (m >= T || p && (l <= b || u >= M))) {
                    D = !1;
                    break;
                }
                w(K), f += d.y, f < 0 && (s = X, f = -f, h -= f), p && (c = f * p, l += (r.width - c) / 2);
                break;
            case it:
                if (p) {
                    if (d.y <= 0 && (h <= v || u >= M)) {
                        D = !1;
                        break;
                    }
                    w(X), f -= d.y, h += d.y, c = f * p;
                } else w(X), w(G), d.x >= 0 ? u < M ? c += d.x : d.y <= 0 && h <= v && (D = !1) : c += d.x, d.y <= 0 ? h > v && (f -= d.y, h += d.y) : (f -= d.y, h += d.y);
                c < 0 && f < 0 ? (s = rt, f = -f, c = -c, h -= f, l -= c) : c < 0 ? (s = et, c = -c, l -= c) : f < 0 && (s = at, f = -f, h -= f);
                break;
            case et:
                if (p) {
                    if (d.y <= 0 && (h <= v || l <= b)) {
                        D = !1;
                        break;
                    }
                    w(X), f -= d.y, h += d.y, c = f * p, l += r.width - c;
                } else w(X), w(q), d.x <= 0 ? l > b ? (c -= d.x, l += d.x) : d.y <= 0 && h <= v && (D = !1) : (c -= d.x, l += d.x), d.y <= 0 ? h > v && (f -= d.y, h += d.y) : (f -= d.y, h += d.y);
                c < 0 && f < 0 ? (s = at, f = -f, c = -c, h -= f, l -= c) : c < 0 ? (s = it, c = -c, l -= c) : f < 0 && (s = rt, f = -f, h -= f);
                break;
            case rt:
                if (p) {
                    if (d.x <= 0 && (l <= b || m >= T)) {
                        D = !1;
                        break;
                    }
                    w(q), c -= d.x, l += d.x, f = c / p;
                } else w(K), w(q), d.x <= 0 ? l > b ? (c -= d.x, l += d.x) : d.y >= 0 && m >= T && (D = !1) : (c -= d.x, l += d.x), d.y >= 0 ? m < T && (f += d.y) : f += d.y;
                c < 0 && f < 0 ? (s = it, f = -f, c = -c, h -= f, l -= c) : c < 0 ? (s = at, c = -c, l -= c) : f < 0 && (s = et, f = -f, h -= f);
                break;
            case at:
                if (p) {
                    if (d.x >= 0 && (u >= M || m >= T)) {
                        D = !1;
                        break;
                    }
                    w(G), c += d.x, f = c / p;
                } else w(K), w(G), d.x >= 0 ? u < M ? c += d.x : d.y >= 0 && m >= T && (D = !1) : c += d.x, d.y >= 0 ? m < T && (f += d.y) : f += d.y;
                c < 0 && f < 0 ? (s = et, f = -f, c = -c, h -= f, l -= c) : c < 0 ? (s = rt, c = -c, l -= c) : f < 0 && (s = it, f = -f, h -= f);
                break;
            case ai:
                this.move(d.x, d.y), D = !1;
                break;
            case ri:
                this.zoom(Wi(n), t), D = !1;
                break;
            case ei:
                if (!d.x || !d.y) {
                    D = !1;
                    break;
                }
                P = fi(this.cropper), l = R.startX - P.left, h = R.startY - P.top, c = r.minWidth, f = r.minHeight, d.x > 0 ? s = d.y > 0 ? at : it : d.x < 0 && (l -= c, s = d.y > 0 ? rt : et), d.y < 0 && (h -= f), this.cropped || (_(this.cropBox, S), this.cropped = !0, this.limited && this.limitCropBox(!0, !0));
                break;
        }
        D && (r.width = c, r.height = f, r.left = l, r.top = h, this.action = s, this.renderCropBox()), E(n, function(C) {
            C.startX = C.endX, C.startY = C.endY;
        });
    },
}, ae = {
    crop: function() {
        return this.ready && !this.cropped && !this.disabled && (this.cropped = !0, this.limitCropBox(!0, !0), this.options.modal && O(this.dragBox, pt), _(this.cropBox, S), this.setCropBoxData(this.initialCropBoxData)), this;
    }, reset: function() {
        return this.ready && !this.disabled && (this.imageData = x({}, this.initialImageData), this.canvasData = x({}, this.initialCanvasData), this.cropBoxData = x({}, this.initialCropBoxData), this.renderCanvas(), this.cropped && this.renderCropBox()), this;
    }, clear: function() {
        return this.cropped && !this.disabled && (x(this.cropBoxData, {
            left: 0,
            top: 0,
            width: 0,
            height: 0,
        }), this.cropped = !1, this.renderCropBox(), this.limitCanvas(!0, !0), this.renderCanvas(), _(this.dragBox, pt), O(this.cropBox, S)), this;
    }, replace: function(t) {
        var e = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : !1;
        return !this.disabled && t && (this.isImg && (this.element.src = t), e ? (this.url = t, this.image.src = t, this.ready && (this.viewBoxImage.src = t, E(this.previews, function(i) {
            i.getElementsByTagName('img')[0].src = t;
        }))) : (this.isImg && (this.replaced = !0), this.options.data = null, this.uncreate(), this.load(t))), this;
    }, enable: function() {
        return this.ready && this.disabled && (this.disabled = !1, _(this.cropper, Yt)), this;
    }, disable: function() {
        return this.ready && !this.disabled && (this.disabled = !0, O(this.cropper, Yt)), this;
    }, destroy: function() {
        var t = this.element;
        return t[y] ? (t[y] = void 0, this.isImg && this.replaced && (t.src = this.originalUrl), this.uncreate(), this) : this;
    }, move: function(t) {
        var e = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : t, i = this.canvasData, o = i.left,
            r = i.top;
        return this.moveTo(gt(t) ? t : o + Number(t), gt(e) ? e : r + Number(e));
    }, moveTo: function(t) {
        var e = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : t, i = this.canvasData, o = !1;
        return t = Number(t), e = Number(e), this.ready && !this.disabled && this.options.movable && (g(t) && (i.left = t, o = !0), g(e) && (i.top = e, o = !0), o && this.renderCanvas(!0)), this;
    }, zoom: function(t, e) {
        var i = this.canvasData;
        return t = Number(t), t < 0 ? t = 1 / (1 - t) : t = 1 + t, this.zoomTo(i.width * t / i.naturalWidth, null, e);
    }, zoomTo: function(t, e, i) {
        var o = this.options, r = this.canvasData, n = r.width, s = r.height, p = r.naturalWidth, l = r.naturalHeight;
        if (t = Number(t), t >= 0 && this.ready && !this.disabled && o.zoomable) {
            var h = p * t, c = l * t;
            if (tt(this.element, Ct, { ratio: t, oldRatio: n / p, originalEvent: i }) === !1) return this;
            if (i) {
                var f = this.pointers, u = fi(this.cropper),
                    m = f && Object.keys(f).length ? Ui(f) : { pageX: i.pageX, pageY: i.pageY };
                r.left -= (h - n) * ((m.pageX - u.left - r.left) / n), r.top -= (c - s) * ((m.pageY - u.top - r.top) / s);
            } else Q(e) && g(e.x) && g(e.y) ? (r.left -= (h - n) * ((e.x - r.left) / n), r.top -= (c - s) * ((e.y - r.top) / s)) : (r.left -= (h - n) / 2, r.top -= (c - s) / 2);
            r.width = h, r.height = c, this.renderCanvas(!0);
        }
        return this;
    }, rotate: function(t) {
        return this.rotateTo((this.imageData.rotate || 0) + Number(t));
    }, rotateTo: function(t) {
        return t = Number(t), g(t) && this.ready && !this.disabled && this.options.rotatable && (this.imageData.rotate = t % 360, this.renderCanvas(!0, !0)), this;
    }, scaleX: function(t) {
        var e = this.imageData.scaleY;
        return this.scale(t, g(e) ? e : 1);
    }, scaleY: function(t) {
        var e = this.imageData.scaleX;
        return this.scale(g(e) ? e : 1, t);
    }, scale: function(t) {
        var e = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : t, i = this.imageData, o = !1;
        return t = Number(t), e = Number(e), this.ready && !this.disabled && this.options.scalable && (g(t) && (i.scaleX = t, o = !0), g(e) && (i.scaleY = e, o = !0), o && this.renderCanvas(!0, !0)), this;
    }, getData: function() {
        var t = arguments.length > 0 && arguments[0] !== void 0 ? arguments[0] : !1, e = this.options,
            i = this.imageData, o = this.canvasData, r = this.cropBoxData, n;
        if (this.ready && this.cropped) {
            n = { x: r.left - o.left, y: r.top - o.top, width: r.width, height: r.height };
            var s = i.width / i.naturalWidth;
            if (E(n, function(h, c) {
                n[c] = h / s;
            }), t) {
                var p = Math.round(n.y + n.height), l = Math.round(n.x + n.width);
                n.x = Math.round(n.x), n.y = Math.round(n.y), n.width = l - n.x, n.height = p - n.y;
            }
        } else n = { x: 0, y: 0, width: 0, height: 0 };
        return e.rotatable && (n.rotate = i.rotate || 0), e.scalable && (n.scaleX = i.scaleX || 1, n.scaleY = i.scaleY || 1), n;
    }, setData: function(t) {
        var e = this.options, i = this.imageData, o = this.canvasData, r = {};
        if (this.ready && !this.disabled && Q(t)) {
            var n = !1;
            e.rotatable && g(t.rotate) && t.rotate !== i.rotate && (i.rotate = t.rotate, n = !0), e.scalable && (g(t.scaleX) && t.scaleX !== i.scaleX && (i.scaleX = t.scaleX, n = !0), g(t.scaleY) && t.scaleY !== i.scaleY && (i.scaleY = t.scaleY, n = !0)), n && this.renderCanvas(!0, !0);
            var s = i.width / i.naturalWidth;
            g(t.x) && (r.left = t.x * s + o.left), g(t.y) && (r.top = t.y * s + o.top), g(t.width) && (r.width = t.width * s), g(t.height) && (r.height = t.height * s), this.setCropBoxData(r);
        }
        return this;
    }, getContainerData: function() {
        return this.ready ? x({}, this.containerData) : {};
    }, getImageData: function() {
        return this.sized ? x({}, this.imageData) : {};
    }, getCanvasData: function() {
        var t = this.canvasData, e = {};
        return this.ready && E(['left', 'top', 'width', 'height', 'naturalWidth', 'naturalHeight'], function(i) {
            e[i] = t[i];
        }), e;
    }, setCanvasData: function(t) {
        var e = this.canvasData, i = e.aspectRatio;
        return this.ready && !this.disabled && Q(t) && (g(t.left) && (e.left = t.left), g(t.top) && (e.top = t.top), g(t.width) ? (e.width = t.width, e.height = t.width / i) : g(t.height) && (e.height = t.height, e.width = t.height * i), this.renderCanvas(!0)), this;
    }, getCropBoxData: function() {
        var t = this.cropBoxData, e;
        return this.ready && this.cropped && (e = {
            left: t.left,
            top: t.top,
            width: t.width,
            height: t.height,
        }), e || {};
    }, setCropBoxData: function(t) {
        var e = this.cropBoxData, i = this.options.aspectRatio, o, r;
        return this.ready && this.cropped && !this.disabled && Q(t) && (g(t.left) && (e.left = t.left), g(t.top) && (e.top = t.top), g(t.width) && t.width !== e.width && (o = !0, e.width = t.width), g(t.height) && t.height !== e.height && (r = !0, e.height = t.height), i && (o ? e.height = e.width / i : r && (e.width = e.height * i)), this.renderCropBox()), this;
    }, getCroppedCanvas: function() {
        var t = arguments.length > 0 && arguments[0] !== void 0 ? arguments[0] : {};
        if (!this.ready || !window.HTMLCanvasElement) return null;
        var e = this.canvasData, i = Vi(this.image, this.imageData, e, t);
        if (!this.cropped) return i;
        var o = this.getData(t.rounded), r = o.x, n = o.y, s = o.width, p = o.height,
            l = i.width / Math.floor(e.naturalWidth);
        l !== 1 && (r *= l, n *= l, s *= l, p *= l);
        var h = s / p, c = U({ aspectRatio: h, width: t.maxWidth || 1 / 0, height: t.maxHeight || 1 / 0 }),
            f = U({ aspectRatio: h, width: t.minWidth || 0, height: t.minHeight || 0 }, 'cover'), u = U({
                aspectRatio: h,
                width: t.width || (l !== 1 ? i.width : s),
                height: t.height || (l !== 1 ? i.height : p),
            }), m = u.width, b = u.height;
        m = Math.min(c.width, Math.max(f.width, m)), b = Math.min(c.height, Math.max(f.height, b));
        var v = document.createElement('canvas'), M = v.getContext('2d');
        v.width = J(m), v.height = J(b), M.fillStyle = t.fillColor || 'transparent', M.fillRect(0, 0, m, b);
        var T = t.imageSmoothingEnabled, D = T === void 0 ? !0 : T, P = t.imageSmoothingQuality;
        M.imageSmoothingEnabled = D, P && (M.imageSmoothingQuality = P);
        var R = i.width, d = i.height, w = r, C = n, B, Y, j, V, z, L;
        w <= -s || w > R ? (w = 0, B = 0, j = 0, z = 0) : w <= 0 ? (j = -w, w = 0, B = Math.min(R, s + w), z = B) : w <= R && (j = 0, B = Math.min(s, R - w), z = B), B <= 0 || C <= -p || C > d ? (C = 0, Y = 0, V = 0, L = 0) : C <= 0 ? (V = -C, C = 0, Y = Math.min(d, p + C), L = Y) : C <= d && (V = 0, Y = Math.min(p, d - C), L = Y);
        var N = [w, C, B, Y];
        if (z > 0 && L > 0) {
            var $ = m / s;
            N.push(j * $, V * $, z * $, L * $);
        }
        return M.drawImage.apply(M, [i].concat(ii(N.map(function(ht) {
            return Math.floor(J(ht));
        })))), v;
    }, setAspectRatio: function(t) {
        var e = this.options;
        return !this.disabled && !gt(t) && (e.aspectRatio = Math.max(0, t) || NaN, this.ready && (this.initCropBox(), this.cropped && this.renderCropBox())), this;
    }, setDragMode: function(t) {
        var e = this.options, i = this.dragBox, o = this.face;
        if (this.ready && !this.disabled) {
            var r = t === St, n = e.movable && t === ni;
            t = r || n ? t : oi, e.dragMode = t, st(i, ot, t), Z(i, bt, r), Z(i, yt, n), e.cropBoxMovable || (st(o, ot, t), Z(o, bt, r), Z(o, yt, n));
        }
        return this;
    },
}, re = H.Cropper, Bt = function() {
    function a(t) {
        var e = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : {};
        if (vi(this, a), !t || !Ri.test(t.tagName)) throw new Error('The first argument is required and must be an <img> or <canvas> element.');
        this.element = t, this.options = x({}, Ft, Q(e) && e), this.cropped = !1, this.disabled = !1, this.pointers = {}, this.ready = !1, this.reloading = !1, this.replaced = !1, this.sized = !1, this.sizing = !1, this.init();
    }

    return wi(a, [{
        key: 'init', value: function() {
            var e = this.element, i = e.tagName.toLowerCase(), o;
            if (!e[y]) {
                if (e[y] = this, i === 'img') {
                    if (this.isImg = !0, o = e.getAttribute('src') || '', this.originalUrl = o, !o) return;
                    o = e.src;
                } else i === 'canvas' && window.HTMLCanvasElement && (o = e.toDataURL());
                this.load(o);
            }
        },
    }, {
        key: 'load', value: function(e) {
            var i = this;
            if (e) {
                this.url = e, this.imageData = {};
                var o = this.element, r = this.options;
                if (!r.rotatable && !r.scalable && (r.checkOrientation = !1), !r.checkOrientation || !window.ArrayBuffer) {
                    this.clone();
                    return;
                }
                if (Ai.test(e)) {
                    Si.test(e) ? this.read(qi(e)) : this.clone();
                    return;
                }
                var n = new XMLHttpRequest, s = this.clone.bind(this);
                this.reloading = !0, this.xhr = n, n.onabort = s, n.onerror = s, n.ontimeout = s, n.onprogress = function() {
                    n.getResponseHeader('content-type') !== qt && n.abort();
                }, n.onload = function() {
                    i.read(n.response);
                }, n.onloadend = function() {
                    i.reloading = !1, i.xhr = null;
                }, r.checkCrossOrigin && Qt(e) && o.crossOrigin && (e = Zt(e)), n.open('GET', e, !0), n.responseType = 'arraybuffer', n.withCredentials = o.crossOrigin === 'use-credentials', n.send();
            }
        },
    }, {
        key: 'read', value: function(e) {
            var i = this.options, o = this.imageData, r = Ki(e), n = 0, s = 1, p = 1;
            if (r > 1) {
                this.url = Fi(e, qt);
                var l = Qi(r);
                n = l.rotate, s = l.scaleX, p = l.scaleY;
            }
            i.rotatable && (o.rotate = n), i.scalable && (o.scaleX = s, o.scaleY = p), this.clone();
        },
    }, {
        key: 'clone', value: function() {
            var e = this.element, i = this.url, o = e.crossOrigin, r = i;
            this.options.checkCrossOrigin && Qt(i) && (o || (o = 'anonymous'), r = Zt(i)), this.crossOrigin = o, this.crossOriginUrl = r;
            var n = document.createElement('img');
            o && (n.crossOrigin = o), n.src = r || i, n.alt = e.alt || 'The image to crop', this.image = n, n.onload = this.start.bind(this), n.onerror = this.stop.bind(this), O(n, zt), e.parentNode.insertBefore(n, e.nextSibling);
        },
    }, {
        key: 'start', value: function() {
            var e = this, i = this.image;
            i.onload = null, i.onerror = null, this.sizing = !0;
            var o = H.navigator && /(?:iPad|iPhone|iPod).*?AppleWebKit/i.test(H.navigator.userAgent),
                r = function(l, h) {
                    x(e.imageData, {
                        naturalWidth: l,
                        naturalHeight: h,
                        aspectRatio: l / h,
                    }), e.initialImageData = x({}, e.imageData), e.sizing = !1, e.sized = !0, e.build();
                };
            if (i.naturalWidth && !o) {
                r(i.naturalWidth, i.naturalHeight);
                return;
            }
            var n = document.createElement('img'), s = document.body || document.documentElement;
            this.sizingImage = n, n.onload = function() {
                r(n.width, n.height), o || s.removeChild(n);
            }, n.src = i.src, o || (n.style.cssText = 'left:0;max-height:none!important;max-width:none!important;min-height:0!important;min-width:0!important;opacity:0;position:absolute;top:0;z-index:-1;', s.appendChild(n));
        },
    }, {
        key: 'stop', value: function() {
            var e = this.image;
            e.onload = null, e.onerror = null, e.parentNode.removeChild(e), this.image = null;
        },
    }, {
        key: 'build', value: function() {
            if (!(!this.sized || this.ready)) {
                var e = this.element, i = this.options, o = this.image, r = e.parentNode,
                    n = document.createElement('div');
                n.innerHTML = Bi;
                var s = n.querySelector('.'.concat(y, '-container')), p = s.querySelector('.'.concat(y, '-canvas')),
                    l = s.querySelector('.'.concat(y, '-drag-box')), h = s.querySelector('.'.concat(y, '-crop-box')),
                    c = h.querySelector('.'.concat(y, '-face'));
                this.container = r, this.cropper = s, this.canvas = p, this.dragBox = l, this.cropBox = h, this.viewBox = s.querySelector('.'.concat(y, '-view-box')), this.face = c, p.appendChild(o), O(e, S), r.insertBefore(s, e.nextSibling), _(o, zt), this.initPreview(), this.bind(), i.initialAspectRatio = Math.max(0, i.initialAspectRatio) || NaN, i.aspectRatio = Math.max(0, i.aspectRatio) || NaN, i.viewMode = Math.max(0, Math.min(3, Math.round(i.viewMode))) || 0, O(h, S), i.guides || O(h.getElementsByClassName(''.concat(y, '-dashed')), S), i.center || O(h.getElementsByClassName(''.concat(y, '-center')), S), i.background && O(s, ''.concat(y, '-bg')), i.highlight || O(c, Mi), i.cropBoxMovable && (O(c, yt), st(c, ot, At)), i.cropBoxResizable || (O(h.getElementsByClassName(''.concat(y, '-line')), S), O(h.getElementsByClassName(''.concat(y, '-point')), S)), this.render(), this.ready = !0, this.setDragMode(i.dragMode), i.autoCrop && this.crop(), this.setData(i.data), A(i.ready) && I(e, Vt, i.ready, { once: !0 }), tt(e, Vt);
            }
        },
    }, {
        key: 'unbuild', value: function() {
            if (this.ready) {
                this.ready = !1, this.unbind(), this.resetPreview();
                var e = this.cropper.parentNode;
                e && e.removeChild(this.cropper), _(this.element, S);
            }
        },
    }, {
        key: 'uncreate', value: function() {
            this.ready ? (this.unbuild(), this.ready = !1, this.cropped = !1) : this.sizing ? (this.sizingImage.onload = null, this.sizing = !1, this.sized = !1) : this.reloading ? (this.xhr.onabort = null, this.xhr.abort()) : this.image && this.stop();
        },
    }], [{
        key: 'noConflict', value: function() {
            return window.Cropper = re, a;
        },
    }, {
        key: 'setDefaults', value: function(e) {
            x(Ft, Q(e) && e);
        },
    }]);
}();
x(Bt.prototype, Zi, Ji, te, ie, ee, ae);

function ne({ statePath: a, fileName: t, fileType: e, presets: i = {}, checkCrossOrigin: o = !0 }) {
    return {
        statePath: a,
        filename: t,
        filetype: e,
        checkCrossOrigin: o,
        cropper: null,
        presets: i,
        preset: 'custom',
        flippedHorizontally: !1,
        flippedVertically: !1,
        format: 'jpg',
        quality: 60,
        key: null,
        finalWidth: 0,
        finalHeight: 0,
        cropBoxData: { left: 0, top: 0, width: 0, height: 0 },
        data: { left: 0, top: 0, width: 0, height: 0, rotate: 0, scaleX: 1, scaleY: 1 },
        init() {
            this.destroy(), setTimeout(() => {
                this.cropper = new Bt(this.$refs.image, { checkCrossOrigin: this.checkCrossOrigin, background: !1 });
            }, 100), this.$watch('preset', r => {
                if (r === 'custom') this.cropper.reset(), this.key = null, this.format = 'jpg', this.quality = 60; else {
                    let n = this.cropper.getContainerData(), s = this.cropper.getCropBoxData(),
                        p = this.presets.find(u => u.key === r), l = p.width, h = p.height,
                        c = Math.round((n.width - l) / 2), f = Math.round((n.height - h) / 2);
                    this.cropper.setCropBoxData({
                        ...s,
                        left: c,
                        top: f,
                        width: l,
                        height: h,
                    }), this.key = p.key, this.format = p.format, this.quality = p.quality;
                }
            });
        },
        destroy() {
            this.cropper != null && (this.cropper.destroy(), this.cropper = null);
        },
        setData() {
            this.finalWidth = this.data.width, this.finalHeight = this.data.height, this.data = this.cropper.getData(!0), this.cropBoxData = this.cropper.getCropBoxData();
        },
        updateData() {
            this.finalWidth = this.data.width, this.finalHeight = this.data.height, this.data = this.cropper.getData(!0), this.cropBoxData = this.cropper.getCropBoxData();
        },
        setCropBoxX(r) {
            let n = this.cropper.getCropBoxData();
            this.cropper.setCropBoxData({ ...n, left: parseInt(r.target.value) });
        },
        setCropBoxY(r) {
            let n = this.cropper.getCropBoxData();
            this.cropper.setCropBoxData({ ...n, top: parseInt(r.target.value) });
        },
        setCropBoxWidth(r) {
            let n = this.cropper.getCropBoxData();
            this.cropper.setCropBoxData({ ...n, width: parseInt(r.target.value) });
        },
        setCropBoxHeight(r) {
            let n = this.cropper.getCropBoxData();
            this.cropper.setCropBoxData({ ...n, height: parseInt(r.target.value) });
        },
        flipHorizontally() {
            this.cropper.scaleY(this.flippedHorizontally ? 1 : -1), this.flippedHorizontally = !this.flippedHorizontally;
        },
        flipVertically() {
            this.cropper.scaleX(this.flippedVertically ? 1 : -1), this.flippedVertically = !this.flippedVertically;
        },
        saveCuration() {
            let r = this.cropper.getData(!0);
            r = {
                ...r,
                containerData: this.cropper.getContainerData(),
                imageData: this.cropper.getImageData(),
                canvasData: this.cropper.getCanvasData(),
                croppedCanvasData: this.cropper.getCroppedCanvas(),
                format: this.format,
                quality: this.quality,
                preset: this.preset,
                key: this.key ?? this.preset,
            }, this.$wire.saveCuration(r);
        },
    };
}

export { ne as default };
/*! Bundled license information:

cropperjs/dist/cropper.esm.js:
  (*!
   * Cropper.js v1.6.2
   * https://fengyuanchen.github.io/cropperjs
   *
   * Copyright 2015-present Chen Fengyuan
   * Released under the MIT license
   *
   * Date: 2024-04-21T07:43:05.335Z
   *)
*/
