<<<<<<< HEAD
!function(){var t={703:function(t,o,e){"use strict";var n=e(414);function a(){}function r(){}r.resetWarningCache=a,t.exports=function(){function t(t,o,e,a,r,s){if(s!==n){var i=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw i.name="Invariant Violation",i}}function o(){return t}t.isRequired=t;var e={array:t,bigint:t,bool:t,func:t,number:t,object:t,string:t,symbol:t,any:t,arrayOf:o,element:t,elementType:t,instanceOf:o,node:t,objectOf:o,oneOf:o,oneOfType:o,shape:o,exact:o,checkPropTypes:r,resetWarningCache:a};return e.PropTypes=e,e}},697:function(t,o,e){t.exports=e(703)()},414:function(t){"use strict";t.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"}},o={};function e(n){var a=o[n];if(void 0!==a)return a.exports;var r=o[n]={exports:{}};return t[n](r,r.exports,e),r.exports}e.n=function(t){var o=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(o,{a:o}),o},e.d=function(t,o){for(var n in o)e.o(o,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:o[n]})},e.o=function(t,o){return Object.prototype.hasOwnProperty.call(t,o)},function(){"use strict";var t=window.wp.apiFetch,o=e.n(t);async function n(t,o,e){let n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:200;try{const a=await t();return!!a&&(a.status===n?o(a):e(a))}catch(t){}}async function a(t){try{return await o()(t)}catch(t){return t.error&&t.status?t:t instanceof window.Response&&await t.json()}}const r=async()=>await n((async()=>await s()),(t=>t),(()=>!1)),s=async()=>await a({path:"wordproof/v1/oauth/destroy",method:"POST"}),{get:i}=lodash,c=function(t){let o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return i(window,"wordproofSdk.data"+(t?`.${t}`:""),o)};var d=e(697),p=e.n(d);function u(t){const o=new window.CustomEvent(t);window.dispatchEvent(o)}const w=t=>{const{response:o,createSuccessNotice:e,createErrorNotice:n,postId:a}=t;if(null===o||200===o.status)return;const r={id:"wordproof-timestamp-notice"};o&&201===o.status?0===o.balance?(r.actions=[{label:c("translations.open_settings_button_text"),onClick:()=>{u("wordproof:open_settings")},variant:"link"}],n(c("translations.no_balance"),r)):(e(c("translations.timestamp_success"),{type:"snackbar",id:"wordproof-timestamp-notice"}),f(a,o.hash,n,r)):o.error&&("not_authenticated"===o.error?(r.type="snackbar",r.actions=[{label:c("translations.open_authentication_button_text"),onClick:()=>{u("wordproof:open_authentication")},variant:"link"}],n(c("translations.not_authenticated"),r)):n(c("translations.timestamp_failed"),r))},f=async(t,o,e,n)=>{setTimeout((async()=>{const r=await(async t=>a({path:`wordproof/v1/posts/${t}/timestamp/transaction/latest`,method:"GET"}))(t);r.hash!==o&&(n.type="snackbar",e(c("translations.webhook_failed"),n))}),1e4)};w.proptypes={timestampResponse:p().any.isRequired,createSuccessNotice:p().func.isRequired,createErrorNotice:p().func.isRequired,postId:p().number.isRequired};const{debounce:l}=lodash,{applyFilters:h}=wp.hooks;const{dispatch:y}=wp.data;$e.modules.hookUI.Base;class m extends $e.modules.hookData.Base{constructor(t,o,e){super(),this.hook=t,this.id=o,this.callback=e}getCommand(){return this.hook}getId(){return this.id}apply(){return this.callback()}}function b(t,o){let e=null;o.actions&&(e=[],o.actions.forEach((t=>{e.push({name:"wordproof_notice_button",text:t.label,callback(){t.onClick()}})}))),window.elementor.notifications.showToast({message:t,buttons:e})}(function(){const{setIsAuthenticated:t,setSelectedPostTypes:o}=y("wordproof"),e=c("popup_redirect_authentication_url"),s=c("popup_redirect_settings_url");let i=null;const d=(t,o)=>{i=function(t,o){let e=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:800,a=arguments.length>4&&void 0!==arguments[4]?arguments[4]:680;const r=t.top.outerHeight/2+t.top.screenY-a/2,s=t.top.outerWidth/2+t.top.screenX-n/2;return t.open(o,e,`toolbar=no,\n\t\tlocation=no,\n\t\tdirectories=no,\n\t\tstatus=no,\n\t\tmenubar=no,\n\t\tresizable=no,\n\t\tcopyhistory=no,\n\t\twidth=${n},\n\t\theight=${a},\n\t\ttop=${r},\n\t\tleft=${s}`)}(window,t,o),i&&i.focus(),window.addEventListener("message",p,!1)},p=async t=>{const{data:o,source:e,origin:n}=t;if(n===c("origin")&&i===e)switch(o.type){case"wordproof:oauth:granted":!1===await l(o)&&await w("wordproof:oauth:failed",!1);break;case"wordproof:oauth:failed":await w("wordproof:oauth:failed",!1);break;case"wordproof:oauth:denied":await w("wordproof:oauth:denied",!1);break;case"wordproof:oauth:invalid_token":await w("wordproof:oauth:invalid_token",!1);break;case"wordproof:webhook:success":await w("wordproof:oauth:success",!0);break;case"wordproof:webhook:failed":await w("wordproof:webhook:failed",!1);break;case"wordproof:settings:updated":await w("wordproof:settings:updated"),await h(o);break;case"wordproof:oauth:destroy":await w("wordproof:oauth:destroy",!1);break;case"wordproof:oauth:retry":await w("wordproof:open_authentication",!1);break;case"wordproof:oauth:close":f()}},w=async function(o){let e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;f(),u(o),!1===e&&(await r(),t(!1)),!0===e&&t(!0)},f=()=>{window.removeEventListener("message",p,!1),i.close()},l=async t=>{await n((()=>(async t=>{const{state:o,code:e}=t;return await a({path:"wordproof/v1/oauth/authenticate",method:"POST",data:{state:o,code:e}})})(t)),(async t=>{const o={type:"wordproof:sdk:access-token",source_id:t.source_id};return i.postMessage(o,c("origin")),!0}),(async()=>!1))},h=async t=>{await n((()=>(async t=>{const{settings:o}=t;return await a({path:"wordproof/v1/settings",method:"POST",data:{settings:o}})})(t)),(async()=>{const e=t.settings;return e.selectedPostTypes&&o(e.selectedPostTypes),!0}),(async()=>!1))};window.addEventListener("wordproof:open_authentication",(t=>{t.preventDefault(),d(e,"WordProof_Authentication")}),!1),window.addEventListener("wordproof:open_settings",(t=>{t.preventDefault(),d(s,"WordProof_Settings")}),!1)})(),function(t,o,e){t(l((async()=>{if(h("wordproof.timestamp",!0)){const t=c("current_post_id"),n=await(async t=>a({path:`wordproof/v1/posts/${t}/timestamp`,method:"POST"}))(t);w({response:n,createSuccessNotice:o,createErrorNotice:e,postId:t})}}),500))}((function(t){!function(t,o,e){$e&&$e.hooks.registerDataAfter(new m("document/save/save","wordproof/timestamper",e))}(0,0,(()=>{window.setTimeout(t,1e3)}))}),b,b)}()}();
=======
!function(){var t={703:function(t,o,e){"use strict";var n=e(414);function a(){}function r(){}r.resetWarningCache=a,t.exports=function(){function t(t,o,e,a,r,s){if(s!==n){var i=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw i.name="Invariant Violation",i}}function o(){return t}t.isRequired=t;var e={array:t,bigint:t,bool:t,func:t,number:t,object:t,string:t,symbol:t,any:t,arrayOf:o,element:t,elementType:t,instanceOf:o,node:t,objectOf:o,oneOf:o,oneOfType:o,shape:o,exact:o,checkPropTypes:r,resetWarningCache:a};return e.PropTypes=e,e}},697:function(t,o,e){t.exports=e(703)()},414:function(t){"use strict";t.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"}},o={};function e(n){var a=o[n];if(void 0!==a)return a.exports;var r=o[n]={exports:{}};return t[n](r,r.exports,e),r.exports}e.n=function(t){var o=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(o,{a:o}),o},e.d=function(t,o){for(var n in o)e.o(o,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:o[n]})},e.o=function(t,o){return Object.prototype.hasOwnProperty.call(t,o)},function(){"use strict";var t=window.wp.apiFetch,o=e.n(t);async function n(t,o,e){let n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:200;try{const a=await t();return!!a&&(a.status===n?o(a):e(a))}catch(t){}}async function a(t){try{return await o()(t)}catch(t){return t.error&&t.status?t:t instanceof window.Response&&await t.json()}}const r=async()=>await n((async()=>await s()),(t=>t),(()=>!1)),s=async()=>await a({path:"wordproof/v1/oauth/destroy",method:"POST"}),{get:i}=lodash,c=function(t){let o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return i(window,"wordproofSdk.data"+(t?`.${t}`:""),o)};var d=e(697),p=e.n(d);function u(t){const o=new window.CustomEvent(t);window.dispatchEvent(o)}const w=t=>{const{response:o,createSuccessNotice:e,createErrorNotice:n,postId:a}=t;if(null===o||200===o.status)return;const r={id:"wordproof-timestamp-notice"};o&&201===o.status?0===o.balance?(r.actions=[{label:c("translations.open_settings_button_text"),onClick:()=>{u("wordproof:open_settings")},variant:"link"}],n(c("translations.no_balance"),r)):(e(c("translations.timestamp_success"),{type:"snackbar",id:"wordproof-timestamp-notice"}),f(a,o.hash,n,r)):o.error&&("not_authenticated"===o.error?(r.type="snackbar",r.actions=[{label:c("translations.open_authentication_button_text"),onClick:()=>{u("wordproof:open_authentication")},variant:"link"}],n(c("translations.not_authenticated"),r)):n(c("translations.timestamp_failed"),r))},f=async(t,o,e,n)=>{setTimeout((async()=>{const r=await(async t=>a({path:`wordproof/v1/posts/${t}/timestamp/transaction/latest`,method:"GET"}))(t);r.hash!==o&&(n.type="snackbar",e(c("translations.webhook_failed"),n))}),1e4)};w.proptypes={timestampResponse:p().any.isRequired,createSuccessNotice:p().func.isRequired,createErrorNotice:p().func.isRequired,postId:p().number.isRequired};const{debounce:l}=lodash,{applyFilters:h}=wp.hooks;const{dispatch:y}=wp.data;$e.modules.hookUI.Base;class m extends $e.modules.hookData.Base{constructor(t,o,e){super(),this.hook=t,this.id=o,this.callback=e}getCommand(){return this.hook}getId(){return this.id}apply(){return this.callback()}}function b(t,o){let e=null;o.actions&&(e=[],o.actions.forEach((t=>{e.push({name:"wordproof_notice_button",text:t.label,callback(){t.onClick()}})}))),window.elementor.notifications.showToast({message:t,buttons:e})}(function(){const{setIsAuthenticated:t,setSelectedPostTypes:o}=y("wordproof"),e=c("popup_redirect_authentication_url"),s=c("popup_redirect_settings_url");let i=null;const d=(t,o)=>{i=function(t,o){let e=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:800,a=arguments.length>4&&void 0!==arguments[4]?arguments[4]:680;const r=t.top.outerHeight/2+t.top.screenY-a/2,s=t.top.outerWidth/2+t.top.screenX-n/2;return t.open(o,e,`toolbar=no,\n\t\tlocation=no,\n\t\tdirectories=no,\n\t\tstatus=no,\n\t\tmenubar=no,\n\t\tresizable=no,\n\t\tcopyhistory=no,\n\t\twidth=${n},\n\t\theight=${a},\n\t\ttop=${r},\n\t\tleft=${s}`)}(window,t,o),i&&i.focus(),window.addEventListener("message",p,!1)},p=async t=>{const{data:o,source:e,origin:n}=t;if(n===c("origin")&&i===e)switch(o.type){case"wordproof:oauth:granted":!1===await l(o)&&await w("wordproof:oauth:failed",!1);break;case"wordproof:oauth:failed":await w("wordproof:oauth:failed",!1);break;case"wordproof:oauth:denied":await w("wordproof:oauth:denied",!1);break;case"wordproof:webhook:success":await w("wordproof:oauth:success",!0);break;case"wordproof:webhook:failed":await w("wordproof:webhook:failed",!1);break;case"wordproof:settings:updated":await w("wordproof:settings:updated"),await h(o);break;case"wordproof:oauth:destroy":await w("wordproof:oauth:destroy",!1);break;case"wordproof:oauth:retry":await w("wordproof:open_authentication",!1);break;case"wordproof:oauth:close":f()}},w=async function(o){let e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;f(),u(o),!1===e&&(await r(),t(!1)),!0===e&&t(!0)},f=()=>{window.removeEventListener("message",p,!1),i.close()},l=async t=>{await n((()=>(async t=>{const{state:o,code:e}=t;return await a({path:"wordproof/v1/oauth/authenticate",method:"POST",data:{state:o,code:e}})})(t)),(async t=>{const o={type:"wordproof:sdk:access-token",source_id:t.source_id};return i.postMessage(o,c("origin")),!0}),(async()=>!1))},h=async t=>{await n((()=>(async t=>{const{settings:o}=t;return await a({path:"wordproof/v1/settings",method:"POST",data:{settings:o}})})(t)),(async()=>{const e=t.settings;return e.selectedPostTypes&&o(e.selectedPostTypes),!0}),(async()=>!1))};window.addEventListener("wordproof:open_authentication",(t=>{t.preventDefault(),d(e,"WordProof_Authentication")}),!1),window.addEventListener("wordproof:open_settings",(t=>{t.preventDefault(),d(s,"WordProof_Settings")}),!1)})(),function(t,o,e){t(l((async()=>{if(h("wordproof.timestamp",!0)){const t=c("current_post_id"),n=await(async t=>a({path:`wordproof/v1/posts/${t}/timestamp`,method:"POST"}))(t);w({response:n,createSuccessNotice:o,createErrorNotice:e,postId:t})}}),500))}((function(t){!function(t,o,e){$e&&$e.hooks.registerDataAfter(new m("document/save/save","wordproof/timestamper",e))}(0,0,(()=>{window.setTimeout(t,1e3)}))}),b,b)}()}();
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
