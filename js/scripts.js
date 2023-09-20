!function(){this.MyThemeMobileMenu=function(){"use strict";this.toggle=null,this.menu=null,this.menu_container=null,this.overlay=null,this.menu_open=!1;arguments[0]&&"object"==typeof arguments[0]&&(this.options=function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n]);return e}({toggle_selector:".mytheme-mobile-menu-nav-toggle",menu_selector:".mytheme-mobile-menu-nav-main-ul",menu_container_selector:".mytheme-mobile-menu-nav-main",callback_menu_open:function(){},callback_menu_close:function(){}},arguments[0])),this.toggle=document.querySelectorAll(this.options.toggle_selector)[0],this.menu=document.querySelectorAll(this.options.menu_selector)[0],this.menu_container=document.querySelectorAll(this.options.menu_container_selector)[0],null==this.toggle||null==this.menu||null==this.menu_container?console.log("Please check MyThemeMobileMenu settings"):function(){this.toggle&&this.toggle.addEventListener("click",this.toggleMenu.bind(this))}.call(this)},MyThemeMobileMenu.prototype={toggleMenu:function(){return this.menu_open?this.closeMenu():this.openMenu(),this.menu_open},openMenu:function(){this.menu_open=!0,this.menu.classList.add("is-active"),this.toggle.setAttribute("aria-expanded","true"),this.toggle.classList.add("is-active"),document.querySelector("body").classList.add("mobile-menu-is-active"),this.options.callback_menu_open()},closeMenu:function(){this.menu_open=!1,this.toggle.setAttribute("aria-expanded","false"),this.toggle.classList.remove("is-active"),this.menu.classList.remove("is-active"),document.querySelector("body").classList.remove("mobile-menu-is-active"),this.options.callback_menu_close()}}}();
!function(){this.MyThemeDropdownMenu=function(e){"use strict";var t=null;if(null==(t=document.querySelectorAll(e)[0]))console.log("Please check MyThemeDropdownMenu settings");else{var r,u,d,n=t.parentElement,i=(null==n.getAttribute("id")&&n.setAttribute("id","mytheme-dropdown-menu-1"),t.classList.remove("no-js"),t.querySelectorAll("ul"));if(0<i.length)for(var a=0;a<i.length;a++){var l=i[a],o=l.parentElement;void 0!==l&&(o=function(e){var t=e.getElementsByTagName("a")[0],n=t.innerHTML,r=t.attributes,i=document.createElement("button");if(null!==t){for(i.innerHTML=n.trim(),u=0,d=r.length;u<d;u++){var a=r[u];"href"!==a.name&&i.setAttribute(a.name,a.value)}e.replaceChild(i,t)}return i}(o),function(e,t){var n;n=null===e.getAttribute("id")?t.textContent.trim().replace(/\s+/g,"-").toLowerCase()+"-submenu":menuItemId+"-submenu";t.setAttribute("aria-controls",n),t.setAttribute("aria-expanded",!1),e.setAttribute("id",n),e.setAttribute("aria-hidden",!0)}(l,o),o.addEventListener("click",s),t.addEventListener("keyup",m))}document.addEventListener("click",function(e){r&&!e.target.closest("#"+n.id)&&c(r)})}function s(e){e=e.currentTarget;r&&e!==r&&c(r),c(e)}function c(e){var t,n=document.getElementById(e.getAttribute("aria-controls"));r="true"===e.getAttribute("aria-expanded")?(e.setAttribute("aria-expanded",!1),n.setAttribute("aria-hidden",!0),!1):(e.setAttribute("aria-expanded",!0),n.setAttribute("aria-hidden",!1),n=n,t=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth,n.offsetParent.getBoundingClientRect().left+n.offsetWidth+32>t&&n.classList.add("sub-menu--right"),e)}function m(e){27===e.keyCode&&(null!==e.target.closest('ul[aria-hidden="false"]')?(r.focus(),c(r)):"true"===e.target.getAttribute("aria-expanded")&&c(r))}}}();
document.addEventListener("DOMContentLoaded",function(){"use strict";var e=document.querySelectorAll(['iframe[src*="youtube.com"]','iframe[src*="youtube-nocookie.com"]','iframe[src*="vimeo.com"]'].join(","));if(e.length)for(var t=0;t<e.length;t++){var o,i,r=e[t],n=r.parentNode;n.classList.contains("wp-block-embed")||n.classList.contains("wp-block-embed__wrapper")||(o=r.getAttribute("width"),o=r.getAttribute("height")/o,(i=document.createElement("div")).className="fluid-width-video-wrapper",i.style.paddingBottom=100*o+"%",n.insertBefore(i,r),r.remove(),i.appendChild(r),r.removeAttribute("height"),r.removeAttribute("width"))}});
'use strict';

document.addEventListener('DOMContentLoaded', function () {

	// Define options for the mobile menu.
	var mobileMenuOptions = {
		toggle_selector: '.float-nav-toggle',
		menu_selector: '.float-nav-ul',
		menu_container_selector: '.float-nav'
	}

	// Mobile navigation.
 	var MobileMenu = new MyThemeMobileMenu(mobileMenuOptions);

	// Drop-down navigation.
	var DropdownMenu = new MyThemeDropdownMenu('.float-nav-ul');

});

//# sourceMappingURL=scripts.js.map
