(()=>{var t={757:(t,e,r)=>{t.exports=r(666)},524:(t,e,r)=>{"use strict";r.d(e,{Z:()=>i});var n=r(519),o=r.n(n)()((function(t){return t[1]}));o.push([t.id,".lit-meta-preview{max-width:600px}.lit-google-title{color:#1a0dab;display:inline-block;font-size:20px;margin-bottom:3px;padding-top:4px}.lit-google-title,.lit-google-url{font-family:arial,sans-serif;font-weight:400;height:auto;line-height:1.3}.lit-google-url{color:#006621;display:block;font-style:normal}.lit-google-description{color:#545454;line-height:1.58;max-width:48em;min-height:50px;position:relative}.lit-google-description span{color:#222;font-family:arial,sans-serif;font-size:14px;line-height:1.58}",""]);const i=o},519:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var r=t(e);return e[2]?"@media ".concat(e[2]," {").concat(r,"}"):r})).join("")},e.i=function(t,r,n){"string"==typeof t&&(t=[[null,t,""]]);var o={};if(n)for(var i=0;i<this.length;i++){var a=this[i][0];null!=a&&(o[a]=!0)}for(var s=0;s<t.length;s++){var l=[].concat(t[s]);n&&o[l[0]]||(r&&(l[2]?l[2]="".concat(r," and ").concat(l[2]):l[2]=r),e.push(l))}},e}},666:t=>{var e=function(t){"use strict";var e,r=Object.prototype,n=r.hasOwnProperty,o="function"==typeof Symbol?Symbol:{},i=o.iterator||"@@iterator",a=o.asyncIterator||"@@asyncIterator",s=o.toStringTag||"@@toStringTag";function l(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(t){l=function(t,e,r){return t[e]=r}}function c(t,e,r,n){var o=e&&e.prototype instanceof g?e:g,i=Object.create(o.prototype),a=new k(n||[]);return i._invoke=function(t,e,r){var n=f;return function(o,i){if(n===h)throw new Error("Generator is already running");if(n===p){if("throw"===o)throw i;return F()}for(r.method=o,r.arg=i;;){var a=r.delegate;if(a){var s=E(a,r);if(s){if(s===v)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===f)throw n=p,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=h;var l=u(t,e,r);if("normal"===l.type){if(n=r.done?p:d,l.arg===v)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n=p,r.method="throw",r.arg=l.arg)}}}(t,r,a),i}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=c;var f="suspendedStart",d="suspendedYield",h="executing",p="completed",v={};function g(){}function m(){}function y(){}var w={};l(w,i,(function(){return this}));var b=Object.getPrototypeOf,_=b&&b(b(T([])));_&&_!==r&&n.call(_,i)&&(w=_);var x=y.prototype=g.prototype=Object.create(w);function C(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function L(t,e){function r(o,i,a,s){var l=u(t[o],t,i);if("throw"!==l.type){var c=l.arg,f=c.value;return f&&"object"==typeof f&&n.call(f,"__await")?e.resolve(f.__await).then((function(t){r("next",t,a,s)}),(function(t){r("throw",t,a,s)})):e.resolve(f).then((function(t){c.value=t,a(c)}),(function(t){return r("throw",t,a,s)}))}s(l.arg)}var o;this._invoke=function(t,n){function i(){return new e((function(e,o){r(t,n,e,o)}))}return o=o?o.then(i,i):i()}}function E(t,r){var n=t.iterator[r.method];if(n===e){if(r.delegate=null,"throw"===r.method){if(t.iterator.return&&(r.method="return",r.arg=e,E(t,r),"throw"===r.method))return v;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return v}var o=u(n,t.iterator,r.arg);if("throw"===o.type)return r.method="throw",r.arg=o.arg,r.delegate=null,v;var i=o.arg;return i?i.done?(r[t.resultName]=i.value,r.next=t.nextLoc,"return"!==r.method&&(r.method="next",r.arg=e),r.delegate=null,v):i:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,v)}function S(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function j(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function k(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(S,this),this.reset(!0)}function T(t){if(t){var r=t[i];if(r)return r.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,a=function r(){for(;++o<t.length;)if(n.call(t,o))return r.value=t[o],r.done=!1,r;return r.value=e,r.done=!0,r};return a.next=a}}return{next:F}}function F(){return{value:e,done:!0}}return m.prototype=y,l(x,"constructor",y),l(y,"constructor",m),m.displayName=l(y,s,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,y):(t.__proto__=y,l(t,s,"GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},C(L.prototype),l(L.prototype,a,(function(){return this})),t.AsyncIterator=L,t.async=function(e,r,n,o,i){void 0===i&&(i=Promise);var a=new L(c(e,r,n,o),i);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},C(x),l(x,s,"Generator"),l(x,i,(function(){return this})),l(x,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=T,k.prototype={constructor:k,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(j),!t)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var r=this;function o(n,o){return s.type="throw",s.arg=t,r.next=n,o&&(r.method="next",r.arg=e),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var a=this.tryEntries[i],s=a.completion;if("root"===a.tryLoc)return o("end");if(a.tryLoc<=this.prev){var l=n.call(a,"catchLoc"),c=n.call(a,"finallyLoc");if(l&&c){if(this.prev<a.catchLoc)return o(a.catchLoc,!0);if(this.prev<a.finallyLoc)return o(a.finallyLoc)}else if(l){if(this.prev<a.catchLoc)return o(a.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return o(a.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var o=this.tryEntries[r];if(o.tryLoc<=this.prev&&n.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,v):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),v},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),j(r),v}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;j(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,r,n){return this.delegate={iterator:T(t),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=e),v}},t}(t.exports);try{regeneratorRuntime=e}catch(t){"object"==typeof globalThis?globalThis.regeneratorRuntime=e:Function("r","regeneratorRuntime = r")(e)}},379:(t,e,r)=>{"use strict";var n,o=function(){return void 0===n&&(n=Boolean(window&&document&&document.all&&!window.atob)),n},i=function(){var t={};return function(e){if(void 0===t[e]){var r=document.querySelector(e);if(window.HTMLIFrameElement&&r instanceof window.HTMLIFrameElement)try{r=r.contentDocument.head}catch(t){r=null}t[e]=r}return t[e]}}(),a=[];function s(t){for(var e=-1,r=0;r<a.length;r++)if(a[r].identifier===t){e=r;break}return e}function l(t,e){for(var r={},n=[],o=0;o<t.length;o++){var i=t[o],l=e.base?i[0]+e.base:i[0],c=r[l]||0,u="".concat(l," ").concat(c);r[l]=c+1;var f=s(u),d={css:i[1],media:i[2],sourceMap:i[3]};-1!==f?(a[f].references++,a[f].updater(d)):a.push({identifier:u,updater:g(d,e),references:1}),n.push(u)}return n}function c(t){var e=document.createElement("style"),n=t.attributes||{};if(void 0===n.nonce){var o=r.nc;o&&(n.nonce=o)}if(Object.keys(n).forEach((function(t){e.setAttribute(t,n[t])})),"function"==typeof t.insert)t.insert(e);else{var a=i(t.insert||"head");if(!a)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");a.appendChild(e)}return e}var u,f=(u=[],function(t,e){return u[t]=e,u.filter(Boolean).join("\n")});function d(t,e,r,n){var o=r?"":n.media?"@media ".concat(n.media," {").concat(n.css,"}"):n.css;if(t.styleSheet)t.styleSheet.cssText=f(e,o);else{var i=document.createTextNode(o),a=t.childNodes;a[e]&&t.removeChild(a[e]),a.length?t.insertBefore(i,a[e]):t.appendChild(i)}}function h(t,e,r){var n=r.css,o=r.media,i=r.sourceMap;if(o?t.setAttribute("media",o):t.removeAttribute("media"),i&&"undefined"!=typeof btoa&&(n+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i))))," */")),t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}var p=null,v=0;function g(t,e){var r,n,o;if(e.singleton){var i=v++;r=p||(p=c(e)),n=d.bind(null,r,i,!1),o=d.bind(null,r,i,!0)}else r=c(e),n=h.bind(null,r,e),o=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(r)};return n(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;n(t=e)}else o()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=o());var r=l(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var n=0;n<r.length;n++){var o=s(r[n]);a[o].references--}for(var i=l(t,e),c=0;c<r.length;c++){var u=s(r[c]);0===a[u].references&&(a[u].updater(),a.splice(u,1))}r=i}}}}},e={};function r(n){var o=e[n];if(void 0!==o)return o.exports;var i=e[n]={id:n,exports:{}};return t[n](i,i.exports,r),i.exports}r.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return r.d(e,{a:e}),e},r.d=(t,e)=>{for(var n in e)r.o(e,n)&&!r.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:e[n]})},r.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{"use strict";var t=r(757),e=r.n(t);function n(t,e,r,n,o,i,a){try{var s=t[i](a),l=s.value}catch(t){return void r(t)}s.done?e(l):Promise.resolve(l).then(n,o)}function o(t){return function(){var e=this,r=arguments;return new Promise((function(o,i){var a=t.apply(e,r);function s(t){n(a,o,i,s,l,"next",t)}function l(t){n(a,o,i,s,l,"throw",t)}s(void 0)}))}}const i={name:"LitMeta",props:["model","field"],computed:{slugHasChanged:function(){return this.originalSlug!=this.newSlug},location:function(){return window.location},description:function(){var t=this.meta.description;if(t){var e=t.match(/.{1,320}/g);return t=e[0],e.length>1&&(t+="…"),t}}},beforeMount:function(){var t=this;this.loadMeta(),Lit.bus.$on("save",this.createForwarding),Lit.bus.$on("saveCanceled",(function(){t.originalSlug=null,t.newSlug=null}))},data:function(){return{showEdit:!1,busy:!1,meta:{},originalSlug:null,newSlug:null,shouldCreateForwarding:!0}},methods:{createForwarding:function(){var t=this;return o(e().mark((function r(){return e().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(t.slugHasChanged&&t.shouldCreateForwarding){e.next=2;break}return e.abrupt("return");case 2:return e.next=4,t.sendCreateForwarding();case 4:if(e.sent){e.next=7;break}return e.abrupt("return");case 7:t.originalSlug=null,t.newSlug=null;case 9:case"end":return e.stop()}}),r)})))()},sendCreateForwarding:function(){var t=this;return o(e().mark((function r(){return e().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,axios.post("".concat(t.field.route_prefix,"/meta/forward"),{field_id:t.field.id,payload:{to:t.newSlug}});case 3:return e.abrupt("return",e.sent);case 6:e.prev=6,e.t0=e.catch(0),console.log(e.t0);case 9:case"end":return e.stop()}}),r,null,[[0,6]])})))()},slugChanged:function(t){this.originalSlug=this.$refs.slugField.original,this.newSlug=t},loadMeta:function(){var t=this;return o(e().mark((function r(){var n;return e().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.busy=!0,e.next=3,t.sendLoadMeta();case 3:if(n=e.sent){e.next=6;break}return e.abrupt("return",t.busy=!1);case 6:t.meta=t.crud(n.data),delete t.meta.attributes.title,delete t.meta.attributes.description,delete t.meta.attributes.keywords,t.busy=!1;case 11:case"end":return e.stop()}}),r)})))()},sendLoadMeta:function(){var t=this;return o(e().mark((function r(){return e().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,axios.post("".concat(t.field.route_prefix,"/meta/load"),{field_id:t.field.id});case 3:return e.abrupt("return",e.sent);case 6:e.prev=6,e.t0=e.catch(0),console.log(e.t0);case 9:case"end":return e.stop()}}),r,null,[[0,6]])})))()}}};var a=r(379),s=r.n(a),l=r(524),c={insert:"head",singleton:!1};s()(l.Z,c);l.Z.locals;function u(t,e,r,n,o,i,a,s){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=r,c._compiled=!0),n&&(c.functional=!0),i&&(c._scopeId="data-v-"+i),a?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},c._ssrRegister=l):o&&(l=s?function(){o.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var f=c.beforeCreate;c.beforeCreate=f?[].concat(f,l):[l]}return{exports:t,options:c}}const f=u(i,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("lit-col",{attrs:{width:t.field.width}},[r("div",{staticClass:"d-flex justify-content-between"},[r("label",{staticClass:"mb-2 lit-form-item-title d-flex justify-content-between"},[r("span",{domProps:{innerHTML:t._s(t.field.title)}})]),t._v(" "),t.showEdit||t.busy?t._e():r("a",{attrs:{href:"#"},domProps:{innerHTML:t._s(t.field.edit_text)},on:{click:function(e){e.preventDefault(),t.showEdit=!t.showEdit}}})]),t._v(" "),t.busy?[r("div",{staticClass:"d-flex justify-content-around"},[r("lit-spinner")],1)]:[r("div",{staticClass:"lit-meta-preview mb-3"},[r("div",{staticClass:"lit-google-title"},[t._v(t._s(t.meta.title))]),t._v(" "),r("div",{staticClass:"lit-google-url"},[t._v("\n                "+t._s(t.location.origin)+"\n                "),r("span",{staticStyle:{color:"#006621"}},[t._v("›\n                    "),t.field.route?[t._v("\n                        "+t._s(t._format(t._.nth(t.field.route.split("/"),-2),t.model))+"\n                        ›\n                        "),r("span",{domProps:{innerHTML:t._s(encodeURI(t._format(t._.last(t.field.route.split("/")),t.model)))}})]:[t._v("\n                        ...\n                    ")]],2)]),t._v(" "),r("div",{staticClass:"lit-google-description"},[r("span",[t._v(t._s(t.description))])])]),t._v(" "),t.showEdit?r("div",{staticClass:"row"},[t._l(t.field.form.fields,(function(e,n){return r("lit-field",t._g({key:n,attrs:{field:e,"model-id":t.model.id,model:t.meta}},t.$listeners))})),t._v(" "),t.field.slug_field?r("lit-field",t._g({ref:"slugField",attrs:{field:t.field.slug_field,model:t.model},on:{changed:t.slugChanged}},t.$listeners)):t._e(),t._v(" "),t.slugHasChanged?r("lit-col",{staticClass:"mb-3"},[r("b-form-checkbox",{attrs:{id:"create-slug-forwarding",name:"create-slug-forwarding"},model:{value:t.shouldCreateForwarding,callback:function(e){t.shouldCreateForwarding=e},expression:"shouldCreateForwarding"}},[r("span",{domProps:{innerHTML:t._s(t.field.create_forwarding_text)}}),t._v(" "),r("span",{staticClass:"badge badge-light"},[t._v(t._s(t.originalSlug))]),t._v("\n                    -> "),r("span",{staticClass:"badge badge-light"},[t._v(t._s(t.newSlug))])])],1):t._e()],2):t._e()]],2)}),[],!1,null,null,null).exports;const d=u({name:"LitMetaSocial",props:["model","field"]},(function(){var t=this,e=t.$createElement;return(t._self._c||e)("lit-col",{attrs:{width:t.field.width}})}),[],!1,null,null,null).exports;window.Lit.booting((function(t){t.component("lit-meta",f),t.component("lit-meta-social",d)}))})()})();