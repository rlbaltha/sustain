+function(d){var c=function(f,e){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null;this.init("tooltip",f,e)};c.VERSION="3.3.1";c.TRANSITION_DURATION=150;c.DEFAULTS={animation:true,placement:"top",selector:false,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:false,container:false,viewport:{selector:"body",padding:0}};c.prototype.init=function(l,j,g){this.enabled=true;this.type=l;this.$element=d(j);this.options=this.getOptions(g);this.$viewport=this.options.viewport&&d(this.options.viewport.selector||this.options.viewport);var k=this.options.trigger.split(" ");for(var h=k.length;h--;){var f=k[h];if(f=="click"){this.$element.on("click."+this.type,this.options.selector,d.proxy(this.toggle,this))}else{if(f!="manual"){var m=f=="hover"?"mouseenter":"focusin";var e=f=="hover"?"mouseleave":"focusout";this.$element.on(m+"."+this.type,this.options.selector,d.proxy(this.enter,this));this.$element.on(e+"."+this.type,this.options.selector,d.proxy(this.leave,this))}}}this.options.selector?(this._options=d.extend({},this.options,{trigger:"manual",selector:""})):this.fixTitle()};c.prototype.getDefaults=function(){return c.DEFAULTS};c.prototype.getOptions=function(e){e=d.extend({},this.getDefaults(),this.$element.data(),e);if(e.delay&&typeof e.delay=="number"){e.delay={show:e.delay,hide:e.delay}}return e};c.prototype.getDelegateOptions=function(){var e={};var f=this.getDefaults();this._options&&d.each(this._options,function(g,h){if(f[g]!=h){e[g]=h}});return e};c.prototype.enter=function(f){var e=f instanceof this.constructor?f:d(f.currentTarget).data("bs."+this.type);if(e&&e.$tip&&e.$tip.is(":visible")){e.hoverState="in";return}if(!e){e=new this.constructor(f.currentTarget,this.getDelegateOptions());d(f.currentTarget).data("bs."+this.type,e)}clearTimeout(e.timeout);e.hoverState="in";if(!e.options.delay||!e.options.delay.show){return e.show()}e.timeout=setTimeout(function(){if(e.hoverState=="in"){e.show()}},e.options.delay.show)};c.prototype.leave=function(f){var e=f instanceof this.constructor?f:d(f.currentTarget).data("bs."+this.type);if(!e){e=new this.constructor(f.currentTarget,this.getDelegateOptions());d(f.currentTarget).data("bs."+this.type,e)}clearTimeout(e.timeout);e.hoverState="out";if(!e.options.delay||!e.options.delay.hide){return e.hide()}e.timeout=setTimeout(function(){if(e.hoverState=="out"){e.hide()}},e.options.delay.hide)};c.prototype.show=function(){var p=d.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(p);var q=d.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(p.isDefaultPrevented()||!q){return}var o=this;var m=this.tip();var i=this.getUID(this.type);this.setContent();m.attr("id",i);this.$element.attr("aria-describedby",i);if(this.options.animation){m.addClass("fade")}var l=typeof this.options.placement=="function"?this.options.placement.call(this,m[0],this.$element[0]):this.options.placement;var t=/\s?auto?\s?/i;var u=t.test(l);if(u){l=l.replace(t,"")||"top"}m.detach().css({top:0,left:0,display:"block"}).addClass(l).data("bs."+this.type,this);this.options.container?m.appendTo(this.options.container):m.insertAfter(this.$element);var r=this.getPosition();var f=m[0].offsetWidth;var n=m[0].offsetHeight;if(u){var k=l;var s=this.options.container?d(this.options.container):this.$element.parent();var h=this.getPosition(s);l=l=="bottom"&&r.bottom+n>h.bottom?"top":l=="top"&&r.top-n<h.top?"bottom":l=="right"&&r.right+f>h.width?"left":l=="left"&&r.left-f<h.left?"right":l;m.removeClass(k).addClass(l)}var j=this.getCalculatedOffset(l,r,f,n);this.applyPlacement(j,l);var g=function(){var e=o.hoverState;o.$element.trigger("shown.bs."+o.type);o.hoverState=null;if(e=="out"){o.leave(o)}};d.support.transition&&this.$tip.hasClass("fade")?m.one("bsTransitionEnd",g).emulateTransitionEnd(c.TRANSITION_DURATION):g()}};c.prototype.applyPlacement=function(j,k){var l=this.tip();var g=l[0].offsetWidth;var q=l[0].offsetHeight;var f=parseInt(l.css("margin-top"),10);var i=parseInt(l.css("margin-left"),10);if(isNaN(f)){f=0}if(isNaN(i)){i=0}j.top=j.top+f;j.left=j.left+i;d.offset.setOffset(l[0],d.extend({using:function(r){l.css({top:Math.round(r.top),left:Math.round(r.left)})}},j),0);l.addClass("in");var e=l[0].offsetWidth;var m=l[0].offsetHeight;if(k=="top"&&m!=q){j.top=j.top+q-m}var p=this.getViewportAdjustedDelta(k,j,e,m);if(p.left){j.left+=p.left}else{j.top+=p.top}var n=/top|bottom/.test(k);var h=n?p.left*2-g+e:p.top*2-q+m;var o=n?"offsetWidth":"offsetHeight";l.offset(j);this.replaceArrow(h,l[0][o],n)};c.prototype.replaceArrow=function(g,e,f){this.arrow().css(f?"left":"top",50*(1-g/e)+"%").css(f?"top":"left","")};c.prototype.setContent=function(){var f=this.tip();var e=this.getTitle();f.find(".tooltip-inner")[this.options.html?"html":"text"](e);f.removeClass("fade in top bottom left right")};c.prototype.hide=function(j){var g=this;var i=this.tip();var h=d.Event("hide.bs."+this.type);function f(){if(g.hoverState!="in"){i.detach()}g.$element.removeAttr("aria-describedby").trigger("hidden.bs."+g.type);j&&j()}this.$element.trigger(h);if(h.isDefaultPrevented()){return}i.removeClass("in");d.support.transition&&this.$tip.hasClass("fade")?i.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f();this.hoverState=null;return this};c.prototype.fixTitle=function(){var e=this.$element;if(e.attr("title")||typeof(e.attr("data-original-title"))!="string"){e.attr("data-original-title",e.attr("title")||"").attr("title","")}};c.prototype.hasContent=function(){return this.getTitle()};c.prototype.getPosition=function(g){g=g||this.$element;var i=g[0];var f=i.tagName=="BODY";var h=i.getBoundingClientRect();if(h.width==null){h=d.extend({},h,{width:h.right-h.left,height:h.bottom-h.top})}var k=f?{top:0,left:0}:g.offset();var e={scroll:f?document.documentElement.scrollTop||document.body.scrollTop:g.scrollTop()};var j=f?{width:d(window).width(),height:d(window).height()}:null;return d.extend({},h,e,j,k)};c.prototype.getCalculatedOffset=function(e,h,f,g){return e=="bottom"?{top:h.top+h.height,left:h.left+h.width/2-f/2}:e=="top"?{top:h.top-g,left:h.left+h.width/2-f/2}:e=="left"?{top:h.top+h.height/2-g/2,left:h.left-f}:{top:h.top+h.height/2-g/2,left:h.left+h.width}};c.prototype.getViewportAdjustedDelta=function(h,k,e,j){var m={top:0,left:0};if(!this.$viewport){return m}var g=this.options.viewport&&this.options.viewport.padding||0;var l=this.getPosition(this.$viewport);if(/right|left/.test(h)){var n=k.top-g-l.scroll;var i=k.top+g-l.scroll+j;if(n<l.top){m.top=l.top-n}else{if(i>l.top+l.height){m.top=l.top+l.height-i}}}else{var o=k.left-g;var f=k.left+g+e;if(o<l.left){m.left=l.left-o}else{if(f>l.width){m.left=l.left+l.width-f}}}return m};c.prototype.getTitle=function(){var g;var e=this.$element;var f=this.options;g=e.attr("data-original-title")||(typeof f.title=="function"?f.title.call(e[0]):f.title);return g};c.prototype.getUID=function(e){do{e+=~~(Math.random()*1000000)}while(document.getElementById(e));return e};c.prototype.tip=function(){return(this.$tip=this.$tip||d(this.options.template))};c.prototype.arrow=function(){return(this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow"))};c.prototype.enable=function(){this.enabled=true};c.prototype.disable=function(){this.enabled=false};c.prototype.toggleEnabled=function(){this.enabled=!this.enabled};c.prototype.toggle=function(g){var f=this;if(g){f=d(g.currentTarget).data("bs."+this.type);if(!f){f=new this.constructor(g.currentTarget,this.getDelegateOptions());d(g.currentTarget).data("bs."+this.type,f)}}f.tip().hasClass("in")?f.leave(f):f.enter(f)};c.prototype.destroy=function(){var e=this;clearTimeout(this.timeout);this.hide(function(){e.$element.off("."+e.type).removeData("bs."+e.type)})};function b(e){return this.each(function(){var i=d(this);var h=i.data("bs.tooltip");var g=typeof e=="object"&&e;var f=g&&g.selector;if(!h&&e=="destroy"){return}if(f){if(!h){i.data("bs.tooltip",(h={}))}if(!h[f]){h[f]=new c(this,g)}}else{if(!h){i.data("bs.tooltip",(h=new c(this,g)))}}if(typeof e=="string"){h[e]()}})}var a=d.fn.tooltip;d.fn.tooltip=b;d.fn.tooltip.Constructor=c;d.fn.tooltip.noConflict=function(){d.fn.tooltip=a;return this}}(jQuery);