/**
 * @author Ryan Johnson <ryan@livepipe.net>
 * @copyright 2007 LivePipe LLC
 * @package Control.Modal
 * @license MIT
 * @url http://livepipe.net/projects/control_modal/
 * @version 1.2.6
 */

if(typeof(Control) == "undefined")
	Control = {};
Control.Modal = Class.create();
Object.extend(Control.Modal,{
	responders: $A([]),
	overlay: false,
	container: false,
	current: false,
	ie: false,
	targetRegexp: /#(.+)$/,
	imgRegexp: /\.(jpe?g|gif|png|tiff?)$/,
	overlayStyles: {
		position: 'absolute',
		top: 0,
		left: 0,
		zIndex: 9998
	},
	load: function(){
		Control.Modal.ie = (navigator.appName == 'Microsoft Internet Explorer');
		Control.Modal.overlay = $(document.createElement('div'));
		Control.Modal.overlay.id = 'modal_overlay';
		Object.extend(Control.Modal.overlay.style,Control.Modal.overlayStyles);
		Control.Modal.overlay.hide();
		Control.Modal.container = $(document.createElement('div'));
		Control.Modal.container.id = 'modal_container';
		Control.Modal.container.hide();
		document.getElementsByTagName('body')[0].appendChild(Control.Modal.overlay);
		document.getElementsByTagName('body')[0].appendChild(Control.Modal.container);
	},
	open: function(contents,options){
		m = new Control.Modal(false,$H({contents:contents}).merge(options));
		m.open();
		return m;
	},
	close: function(){
		if(Control.Modal.current)
			Control.Modal.current.close();
	},
	attachEvents: function(){
		Event.observe(window,'load',Control.Modal.load);
		Event.observe(window,'unload',Event.unloadCache,false);
	},
	center: function(){
		element = this.container;
		if(!element._centered){
			this.container.setStyle({
				position: 'absolute'
			}); 
			this.container._centered = true;
		}
		dimensions = Control.Modal.container.getDimensions();
		Position.prepare();
		offset_left = (Position.deltaX + Math.floor((Control.Modal.getWindowWidth() - dimensions.width) / 2));
		offset_top = (Position.deltaY + Math.floor((Control.Modal.getWindowHeight() - dimensions.height) / 2));
		modal_dimensions = Control.Modal.container.getDimensions();
		Control.Modal.container.setStyle({
			top: ((modal_dimensions.height <= Control.Modal.getWindowHeight()) ? ((offset_top != null && offset_top > 0) ? offset_top : '0') + 'px' : 0),
			left: ((modal_dimensions.width <= Control.Modal.getWindowWidth()) ? ((offset_left != null && offset_left > 0) ? offset_left : '0') + 'px' : 0)
		});
	},
	getWindowWidth: function(){
		return (self.innerWidth || document.documentElement.clientWidth || document.body.clientWidth || 0);
	},
	getWindowHeight: function(){
		return (self.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0);
	},
	getDocumentWidth: function(){
		return Math.max(document.body.scrollWidth,Control.Modal.getWindowWidth());
	},
	getDocumentHeight: function(){
		return Math.max(document.body.scrollHeight,Control.Modal.getWindowHeight());
	},	
	onKeyDown: function(event){
		if(event.keyCode == Event.KEY_ESC)
			Control.Modal.close();
	},
	addResponder: function(responder){
		Control.Modal.responders.push(responder);
	},
	removeResponder: function(responder){
		Control.Modal.responders = Control.Modal.responders.without(responder);
	},
	//from Scriptaculous
	setOpacity: function(element,value){
		element= $(element);  
		if(value == 1){
			Element.setStyle(element,{
				opacity: (/Gecko/.test(navigator.userAgent) && !/Konqueror|Safari|KHTML/.test(navigator.userAgent)) ? 0.999999 : null
			});
		if(/MSIE/.test(navigator.userAgent))
			Element.setStyle(element,{
				filter: Element.getStyle(element,'filter').replace(/alpha\([^\)]*\)/gi,'')
			});  
		}else{  
			if(value < 0.00001) value = 0;  
			Element.setStyle(element, {opacity: value});
			if(/MSIE/.test(navigator.userAgent))  
				Element.setStyle(element,{
					filter: Element.getStyle(element,'filter').replace(/alpha\([^\)]*\)/gi,'') + 'alpha(opacity='+value*100+')'
				});  
		}
	}
});
Object.extend(Control.Modal.prototype,{
	mode: '',
	html: false,
	href: '',
	element: false,
	src: false,
	imageLoaded: false,
	initialize: function(element,options){
		this.element = $(element);
		this.options = $H({
			beforeOpen: Prototype.emptyFunction,
			afterOpen: Prototype.emptyFunction,
			beforeClose: Prototype.emptyFunction,
			afterClose: Prototype.emptyFunction,
			beforeLoad: Prototype.emptyFunction,
			onLoad: Prototype.emptyFunction,
			onFailure: Prototype.emptyFunction,
			onException: Prototype.emptyFunction,
			afterLoad: Prototype.emptyFunction,
			beforeImageLoad: Prototype.emptyFunction,
			afterImageLoad: Prototype.emptyFunction,
			contents: false,
			image: false,
			imageTemplate: new Template('<img src="#{src}" id="#{id}"/>'),
			imageAutoDisplay: true,
			imageCloseOnClick: true,
			hover: false,
			iframe: false,
			iframeTemplate: new Template('<iframe src="#{href}" width="100%" height="100%" frameborder="0" id="#{id}"></iframe>'),
			evalScripts: true, //for Ajax, define here instead of in requestOptions
			requestOptions: {}, //for Ajax.Request
			overlayClassName: '',
			containerClassName: '',
			opacity: 0.3,
			zIndex: 9998,
			width: null,
			height: null,
			offsetLeft: 0, //for use with 'relative'
			offsetTop: 0, //for use with 'relative'
			position: 'absolute' //'absolute' or 'relative'
		});
		if(options)
			for(o in options)
				this.options[o] = options[o];
		target_match = false;
		image_match = false;
		if(this.element){
			target_match = Control.Modal.targetRegexp.exec(this.element.href);
			image_match = Control.Modal.imgRegexp.exec(this.element.href);
		}
		if(this.options.contents){
			this.mode = 'contents';
		}else if(this.options.image || image_match){
			this.mode = 'image';
			this.src = this.element.href;
		}else if(target_match){
			this.mode = 'named';
			x = $(target_match[1]);
			this.html = x.innerHTML;
			x.remove();
			this.href = target_match[1];
		}else{
			this.mode = (this.options.iframe) ? 'iframe' : 'ajax';
			this.href = this.element.href;
		}
		if(this.element){
			if(this.options.hover){
				this.element.observe('mouseover',this.open.bind(this));
				this.element.observe('mouseout',this.close.bind(this));
			}else{
				this.element.onclick = function(){
					this.open();
					return false;
				}.bindAsEventListener(this);
			}
		}
		targets = Control.Modal.targetRegexp.exec(window.location);
		this.position = function(){
			Control.Modal.overlay.setStyle({
				height: Control.Modal.getDocumentHeight() + 'px',
				width: Control.Modal.getDocumentWidth() + 'px'
			});
			if(this.options.position == 'absolute')
				Control.Modal.center();
			else{
				yx = Position.cumulativeOffset(this.element);
				Control.Modal.container.setStyle({
					position: 'absolute',
					top: yx[1] + this.options.offsetTop,
					left: yx[0] + this.options.offsetLeft
				});
			}
		}.bind(this);
		if(this.mode == 'image'){
			this.afterImageLoad = function(){
				if(this.options.imageAutoDisplay && !window.opera)
					$('modal_image').show();
				this.position();
				this.notifyResponders('afterImageLoad');
			}.bind(this);
		}
		if(this.mode == 'named' && targets && targets[1] && targets[1] == this.href)
			this.open();
	},
	open: function(){
		if(!this.options.hover)
			Event.observe($(document.getElementsByTagName('body')[0]),'keydown',Control.Modal.onKeyDown);
		Control.Modal.current = this;
		if(this.notifyResponders('beforeOpen') === false)
			return;
		if(!this.options.hover){
			Control.Modal.overlay.setStyle({
				zIndex: this.options.zIndex
			});
			Control.Modal.setOpacity(Control.Modal.overlay,this.options.opacity);
		}
		Control.Modal.container.setStyle({
			zIndex: this.options.zIndex + 1,
			width: (this.options.width ? this.options.width + 'px' : ''),
			height: (this.options.height ? this.options.height + 'px' : '')
		});
		if(Control.Modal.ie && !this.options.hover)
			$$('select').invoke('setStyle',{visibility: 'hidden'});
		Control.Modal.overlay.addClassName(this.options.overlayClassName);
		Control.Modal.container.addClassName(this.options.containerClassName);
		switch(this.mode){
			case 'image':
				this.imageLoaded = false;
				this.notifyResponders('beforeImageLoad');
				this.update(this.options.imageTemplate.evaluate({src: this.src, id: 'modal_image'}));
				this.position();
				if(this.options.imageAutoDisplay && !window.opera)
					$('modal_image').hide();
				if(this.options.imageCloseOnClick)
					$('modal_image').observe('click',Control.Modal.close);
				$('modal_image').observe('load',this.afterImageLoad);
				$('modal_image').observe('readystatechange',this.afterImageLoad);
				break;
			case 'ajax':
				this.notifyResponders('beforeLoad');
				options = $H({
					method: 'get',
					onSuccess: function(request){
						this.notifyResponders('onLoad',request);
						this.update(request.responseText);
						if(this.options.evalScripts)
							request.responseText.evalScripts();
						this.notifyResponders('afterLoad',request);
					}.bind(this),
					onFailure: this.options.onFailure,
					onException: this.options.onException
				});
				if(this.options.requestOptions)
					for(o in this.options.requestOptions)
						options[o] = this.options.requestOptions[o];
				new Ajax.Request(this.href,options);
				break;
			case 'iframe':
				this.update(this.options.iframeTemplate.evaluate({href: this.href, id: 'modal_iframe'}));
				this.position();
				break;
			case 'contents':
				this.update((typeof(this.options.contents) == 'function' ? this.options.contents.bind(this)() : this.options.contents));
				break;
			case 'named':
				this.update(this.html);
				break;
		}
		if(!this.options.hover){
			Control.Modal.overlay.observe('click',Control.Modal.close);
			Control.Modal.overlay.show();
		}
		this.options.afterOpen();
	},
	update: function(html){
		Control.Modal.container.update(html);
		this.position();
		Control.Modal.container.show();
		Event.stopObserving(window,'resize',this.position,false);
		Event.stopObserving(window,'scroll',this.position,false);
		Event.observe(window,'resize',this.position,false);
		Event.observe(window,'scroll',this.position,false);
	},
	close: function(){
		response = this.notifyResponders('beforeClose');
		if(response == false && response != null)
			return;
		if(this.mode == 'image'){
			if(this.options.imageCloseOnClick)
				$('modal_image').stopObserving('click',Control.Modal.close);
			$('modal_image').stopObserving('load',this.afterImageLoad);
			$('modal_image').stopObserving('readystatechange',this.afterImageLoad);
		}
		if(Control.Modal.ie && !this.options.hover)
			$$('select').invoke('setStyle',{visibility: 'visible'});	
		if(!this.options.hover)
			Event.stopObserving(window,'keyup',Control.Modal.onKeyDown);
		Control.Modal.current = false;	
		Control.Modal.overlay.removeClassName(this.options.overlayClassName);
		Control.Modal.container.removeClassName(this.options.containerClassName);
		Event.stopObserving(window,'resize',this.position,false);
		Event.stopObserving(window,'scroll',this.position,false);
		if(!this.options.hover){
			Control.Modal.overlay.stopObserving('click',Control.Modal.close);
			Control.Modal.overlay.hide();
		}
		Control.Modal.container.update('');
		Control.Modal.container.hide();
		this.notifyResponders('afterClose');
	},
	notifyResponders: function(event_name,argument){
		Control.Modal.responders.each(function(responder){
			if(responder[event_name])
				responder[event_name](argument);
		});
		response = this.options[event_name](argument);
		return response;
	}
});
Control.Modal.attachEvents();
