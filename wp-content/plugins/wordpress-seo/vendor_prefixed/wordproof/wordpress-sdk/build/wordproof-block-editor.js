<<<<<<< HEAD
!function(){var e={703:function(e,t,o){"use strict";var n=o(414);function r(){}function a(){}a.resetWarningCache=r,e.exports=function(){function e(e,t,o,r,a,s){if(s!==n){var i=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw i.name="Invariant Violation",i}}function t(){return e}e.isRequired=e;var o={array:e,bigint:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:a,resetWarningCache:r};return o.PropTypes=o,o}},697:function(e,t,o){e.exports=o(703)()},414:function(e){"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"}},t={};function o(n){var r=t[n];if(void 0!==r)return r.exports;var a=t[n]={exports:{}};return e[n](a,a.exports,o),a.exports}o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,{a:t}),t},o.d=function(e,t){for(var n in t)o.o(t,n)&&!o.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";var e=window.wp.element,t=window.wp.data,n=window.wp.apiFetch,r=o.n(n);async function a(e,t,o){let n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:200;try{const r=await e();return!!r&&(r.status===n?t(r):o(r))}catch(e){}}async function s(e){try{return await r()(e)}catch(e){return e.error&&e.status?e:e instanceof window.Response&&await e.json()}}const i=async()=>await a((async()=>await c()),(e=>e),(()=>!1)),c=async()=>await s({path:"wordproof/v1/oauth/destroy",method:"POST"}),{get:p}=lodash,d=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return p(window,"wordproofSdk.data"+(e?`.${e}`:""),t)};var l=o(697),u=o.n(l);function w(e){const t=new window.CustomEvent(e);window.dispatchEvent(t)}const f=e=>{const{response:t,createSuccessNotice:o,createErrorNotice:n,postId:r}=e;if(null===t||200===t.status)return;const a={id:"wordproof-timestamp-notice"};t&&201===t.status?0===t.balance?(a.actions=[{label:d("translations.open_settings_button_text"),onClick:()=>{w("wordproof:open_settings")},variant:"link"}],n(d("translations.no_balance"),a)):(o(d("translations.timestamp_success"),{type:"snackbar",id:"wordproof-timestamp-notice"}),h(r,t.hash,n,a)):t.error&&("not_authenticated"===t.error?(a.type="snackbar",a.actions=[{label:d("translations.open_authentication_button_text"),onClick:()=>{w("wordproof:open_authentication")},variant:"link"}],n(d("translations.not_authenticated"),a)):n(d("translations.timestamp_failed"),a))},h=async(e,t,o,n)=>{setTimeout((async()=>{const r=await(async e=>s({path:`wordproof/v1/posts/${e}/timestamp/transaction/latest`,method:"GET"}))(e);r.hash!==t&&(n.type="snackbar",o(d("translations.webhook_failed"),n))}),1e4)};f.proptypes={timestampResponse:u().any.isRequired,createSuccessNotice:u().func.isRequired,createErrorNotice:u().func.isRequired,postId:u().number.isRequired};const{debounce:m}=lodash,{applyFilters:y}=wp.hooks;const{dispatch:v}=wp.data;const{subscribe:_,select:g}=wp.data;function b(e){let t=!0;_((()=>{const o=g("core/editor").isSavingPost(),n=g("core/editor").isAutosavingPost(),r=g("core/editor").didPostSaveRequestSucceed();if(o&&r&&!n){if(t)return void(t=!1);e()}}))}const{__:__}=wp.i18n,{useCallback:E}=wp.element,{withSelect:k}=wp.data,{compose:P}=wp.compose,T=t=>{const{isAuthenticated:o}=t,n=d("popup_redirect_authentication_url"),r=d("popup_redirect_settings_url"),a=E((e=>{e.preventDefault(),w("wordproof:open_settings")})),s=E((e=>{e.preventDefault(),w("wordproof:open_authentication")}));return(0,e.createElement)(e.Fragment,null,o&&(0,e.createElement)("a",{href:r,onClick:a},__("Open settings","wordproof")),!o&&(0,e.createElement)("a",{href:n,onClick:s},__("Open authentication","wordproof")))};T.proptypes={isAuthenticated:u().bool.isRequired};var R=P([k((e=>({isAuthenticated:e("wordproof").getIsAuthenticated()})))])(T);const{Modal:S}=wp.components,C=t=>{const{title:o,children:n,close:r}=t;return(0,e.createElement)(e.Fragment,null,(0,e.createElement)(S,{style:{maxWidth:"440px"},title:o,onRequestClose:r},n))};C.proptypes={title:u().string.isRequired,children:u().any,close:u().func.isRequired};var O=C;const{Button:q}=wp.components,{useCallback:W}=wp.element,{__:A}=wp.i18n,L=t=>{const{close:o}=t,n=W((e=>{e.preventDefault(),w("wordproof:open_authentication")}));return(0,e.createElement)(O,{close:o,title:A("Authentication denied","wordproof")},(0,e.createElement)(e.Fragment,null,(0,e.createElement)("p",null,A("You need to allow WordProof to access your site to finish the WordProof installation.","wordproof")),(0,e.createElement)(q,{variant:"primary",onClick:n},A("Retry authentication","wordproof"))))};L.proptypes={close:u().func.isRequired};var $=L;function x(t,o){let n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";return(0,e.createInterpolateElement)(t,{a:(0,e.createElement)("a",{id:n,href:o,target:"_blank",rel:"noopener noreferrer"})})}const{Button:I}=wp.components,{useCallback:D}=wp.element,{__:F,sprintf:M}=wp.i18n,N=t=>{const{close:o}=t,n=D((e=>{e.preventDefault(),w("wordproof:open_authentication")}));return(0,e.createElement)(O,{close:o,title:F("Authentication failed","wordproof")},(0,e.createElement)(e.Fragment,null,(0,e.createElement)("p",null,M(
=======
!function(){var e={703:function(e,t,o){"use strict";var n=o(414);function r(){}function a(){}a.resetWarningCache=r,e.exports=function(){function e(e,t,o,r,a,s){if(s!==n){var i=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw i.name="Invariant Violation",i}}function t(){return e}e.isRequired=e;var o={array:e,bigint:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:a,resetWarningCache:r};return o.PropTypes=o,o}},697:function(e,t,o){e.exports=o(703)()},414:function(e){"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"}},t={};function o(n){var r=t[n];if(void 0!==r)return r.exports;var a=t[n]={exports:{}};return e[n](a,a.exports,o),a.exports}o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,{a:t}),t},o.d=function(e,t){for(var n in t)o.o(t,n)&&!o.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";var e=window.wp.element,t=window.wp.data,n=window.wp.apiFetch,r=o.n(n);async function a(e,t,o){let n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:200;try{const r=await e();return!!r&&(r.status===n?t(r):o(r))}catch(e){}}async function s(e){try{return await r()(e)}catch(e){return e.error&&e.status?e:e instanceof window.Response&&await e.json()}}const i=async()=>await a((async()=>await c()),(e=>e),(()=>!1)),c=async()=>await s({path:"wordproof/v1/oauth/destroy",method:"POST"}),{get:p}=lodash,d=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return p(window,"wordproofSdk.data"+(e?`.${e}`:""),t)};var l=o(697),u=o.n(l);function w(e){const t=new window.CustomEvent(e);window.dispatchEvent(t)}const f=e=>{const{response:t,createSuccessNotice:o,createErrorNotice:n,postId:r}=e;if(null===t||200===t.status)return;const a={id:"wordproof-timestamp-notice"};t&&201===t.status?0===t.balance?(a.actions=[{label:d("translations.open_settings_button_text"),onClick:()=>{w("wordproof:open_settings")},variant:"link"}],n(d("translations.no_balance"),a)):(o(d("translations.timestamp_success"),{type:"snackbar",id:"wordproof-timestamp-notice"}),h(r,t.hash,n,a)):t.error&&("not_authenticated"===t.error?(a.type="snackbar",a.actions=[{label:d("translations.open_authentication_button_text"),onClick:()=>{w("wordproof:open_authentication")},variant:"link"}],n(d("translations.not_authenticated"),a)):n(d("translations.timestamp_failed"),a))},h=async(e,t,o,n)=>{setTimeout((async()=>{const r=await(async e=>s({path:`wordproof/v1/posts/${e}/timestamp/transaction/latest`,method:"GET"}))(e);r.hash!==t&&(n.type="snackbar",o(d("translations.webhook_failed"),n))}),1e4)};f.proptypes={timestampResponse:u().any.isRequired,createSuccessNotice:u().func.isRequired,createErrorNotice:u().func.isRequired,postId:u().number.isRequired};const{debounce:m}=lodash,{applyFilters:y}=wp.hooks;const{dispatch:v}=wp.data;const{subscribe:_,select:g}=wp.data;function b(e){let t=!0;_((()=>{const o=g("core/editor").isSavingPost(),n=g("core/editor").isAutosavingPost(),r=g("core/editor").didPostSaveRequestSucceed();if(o&&r&&!n){if(t)return void(t=!1);e()}}))}const{__:__}=wp.i18n,{useCallback:E}=wp.element,{withSelect:P}=wp.data,{compose:k}=wp.compose,T=t=>{const{isAuthenticated:o}=t,n=d("popup_redirect_authentication_url"),r=d("popup_redirect_settings_url"),a=E((e=>{e.preventDefault(),w("wordproof:open_settings")})),s=E((e=>{e.preventDefault(),w("wordproof:open_authentication")}));return(0,e.createElement)(e.Fragment,null,o&&(0,e.createElement)("a",{href:r,onClick:a},__("Open settings","wordproof")),!o&&(0,e.createElement)("a",{href:n,onClick:s},__("Open authentication","wordproof")))};T.proptypes={isAuthenticated:u().bool.isRequired};var R=k([P((e=>({isAuthenticated:e("wordproof").getIsAuthenticated()})))])(T);const{Modal:S}=wp.components,C=t=>{const{title:o,children:n,close:r}=t;return(0,e.createElement)(e.Fragment,null,(0,e.createElement)(S,{style:{maxWidth:"440px"},title:o,onRequestClose:r},n))};C.proptypes={title:u().string.isRequired,children:u().any,close:u().func.isRequired};var O=C;const{Button:q}=wp.components,{useCallback:W}=wp.element,{__:A}=wp.i18n,L=t=>{const{close:o}=t,n=W((e=>{e.preventDefault(),w("wordproof:open_authentication")}));return(0,e.createElement)(O,{close:o,title:A("Authentication denied","wordproof")},(0,e.createElement)(e.Fragment,null,(0,e.createElement)("p",null,A("You need to allow WordProof to access your site to finish the WordProof installation.","wordproof")),(0,e.createElement)(q,{variant:"primary",onClick:n},A("Retry authentication","wordproof"))))};L.proptypes={close:u().func.isRequired};var $=L;function x(t,o){let n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";return(0,e.createInterpolateElement)(t,{a:(0,e.createElement)("a",{id:n,href:o,target:"_blank",rel:"noopener noreferrer"})})}const{Button:I}=wp.components,{useCallback:D}=wp.element,{__:F,sprintf:M}=wp.i18n,N=t=>{const{close:o}=t,n=D((e=>{e.preventDefault(),w("wordproof:open_authentication")}));return(0,e.createElement)(O,{close:o,title:F("Authentication failed","wordproof")},(0,e.createElement)(e.Fragment,null,(0,e.createElement)("p",null,M(
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
/* Translators: %s expands to WordProof */
F("Something failed during the authentication of your %s account.","wordproof"),"WordProof"),x(M(
/* Translators: %1s and %2s are html tags. %3s expands to WordProof */
F("Please try again or contact the %1$s%3$s support team%2$s.","wordpress-seo"),"<a>","</a>","WordProof"),"https://help.wordproof.com/")),(0,e.createElement)(I,{variant:"primary",onClick:n},F("Retry authentication","wordproof"))))};N.proptypes={close:u().func.isRequired};var j=N;const{__:Y,sprintf:B}=wp.i18n,{compose:H}=wp.compose,{withSelect:U}=wp.data,z=t=>{const{close:o,postType:n}=t;return(0,e.createElement)(O,{close:o,title:Y("Authenticated","wordproof")},(0,e.createElement)("p",null,B(
/* translators: %s expands to WordProof. */
Y("You have successfully connected your %s account with this site.","wordproof"),"WordProof"),n&&B(
/* translators: %s is the singular post type. */
Y("Your %s will now be timestamped everytime you update or publish.","wordproof"),n)))};z.proptypes={close:u().func.isRequired};var G=H([U((e=>({postType:e("core/editor").getCurrentPostType()})))])(z);const{__:V,sprintf:X}=wp.i18n,J=t=>{const{close:o}=t;return(0,e.createElement)(O,{close:o,title:V("Webhook failed","wordproof")},(0,e.createElement)("p",null,X(
/* Translators: %s expands to WordProof */
V("The timestamp sent by %s was not received on your website.","WordProof"),"WordProof"),x(X(
/* Translators: %1s and %2s are html tags. %3s expands to WordProof */
V("Please contact the %1$s%3$s support team%2$s to help solve this problem.","wordpress-seo"),"<a>","</a>","WordProof"),"https://help.wordproof.com/")))};J.proptypes={close:u().func.isRequired};var K=J;const{useState:Q,useCallback:Z,useEffect:ee}=wp.element;var te=()=>{const[t,o]=Q(null),n=Z((()=>{o("oauth:failed")})),r=Z((()=>{o("oauth:denied")})),a=Z((()=>{o("webhook:failed")})),s=Z((()=>{o("oauth:success")})),i=Z((()=>{o(null)}));return ee((()=>(window.addEventListener("wordproof:oauth:success",s,!1),window.addEventListener("wordproof:oauth:failed",n,!1),window.addEventListener("wordproof:oauth:denied",r,!1),window.addEventListener("wordproof:webhook:failed",a,!1),()=>{window.removeEventListener("wordproof:oauth:success",s,!1),window.removeEventListener("wordproof:oauth:failed",n,!1),window.removeEventListener("wordproof:oauth:denied",r,!1),window.removeEventListener("wordproof:webhook:failed",a,!1)})),[]),(0,e.createElement)(e.Fragment,null,"oauth:success"===t&&(0,e.createElement)(G,{close:i}),"oauth:denied"===t&&(0,e.createElement)($,{close:i}),"oauth:failed"===t&&(0,e.createElement)(j,{close:i}),"webhook:failed"===t&&(0,e.createElement)(K,{close:i}))};const{__:oe,sprintf:ne}=wp.i18n,{PluginDocumentSettingPanel:re}=wp.editPost,{ToggleControl:ae,PanelRow:se}=wp.components,{compose:ie}=wp.compose,{withSelect:ce,withDispatch:pe}=wp.data,{useCallback:de}=wp.element,le=t=>{let{postType:o,postMeta:n,isAuthenticated:r,selectedPostTypes:a,setPostMeta:s}=t;const i=de((()=>a.includes(o)),[a,o]),c=de((()=>{w("wordproof:open_authentication")}));return void 0===n?(0,e.createElement)(e.Fragment,null):(0,e.createElement)(re,{title:oe("WordProof Timestamp","wordproof"),initialOpen:"true"},(0,e.createElement)(se,null,(0,e.createElement)(ae,{label:ne(
/* translators: %s expands to the post type */
<<<<<<< HEAD
oe("Timestamp this %s","wordproof"),o),onChange:e=>{s({_wordproof_timestamp:e}),r||!0!==e||c()},checked:n._wordproof_timestamp||i(),disabled:i()})),(0,e.createElement)(se,null,(0,e.createElement)(R,null)),(0,e.createElement)(te,null))};le.proptypes={postType:u().string.isRequired,postMeta:u().object.isRequired,isAuthenticated:u().bool.isRequired,setPostMeta:u().func.isRequired};var ue=ie([ce((e=>({postMeta:e("core/editor").getEditedPostAttribute("meta"),postType:e("core/editor").getCurrentPostType(),isAuthenticated:e("wordproof").getIsAuthenticated(),selectedPostTypes:e("wordproof").getSelectedPostTypes()}))),pe((e=>({setPostMeta(t){e("core/editor").editPost({meta:t})}})))])(le);const{registerPlugin:we}=wp.plugins;we("wordproof-timestamp-panel",{render:()=>(0,e.createElement)(ue,null)}),function(){const{createSuccessNotice:e,createErrorNotice:o}=(0,t.dispatch)("core/notices");(function(){const{setIsAuthenticated:e,setSelectedPostTypes:t}=v("wordproof"),o=d("popup_redirect_authentication_url"),n=d("popup_redirect_settings_url");let r=null;const c=(e,t)=>{r=function(e,t){let o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:800,r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:680;const a=e.top.outerHeight/2+e.top.screenY-r/2,s=e.top.outerWidth/2+e.top.screenX-n/2;return e.open(t,o,`toolbar=no,\n\t\tlocation=no,\n\t\tdirectories=no,\n\t\tstatus=no,\n\t\tmenubar=no,\n\t\tresizable=no,\n\t\tcopyhistory=no,\n\t\twidth=${n},\n\t\theight=${r},\n\t\ttop=${a},\n\t\tleft=${s}`)}(window,e,t),r&&r.focus(),window.addEventListener("message",p,!1)},p=async e=>{const{data:t,source:o,origin:n}=e;if(n===d("origin")&&r===o)switch(t.type){case"wordproof:oauth:granted":!1===await f(t)&&await l("wordproof:oauth:failed",!1);break;case"wordproof:oauth:failed":await l("wordproof:oauth:failed",!1);break;case"wordproof:oauth:denied":await l("wordproof:oauth:denied",!1);break;case"wordproof:oauth:invalid_token":await l("wordproof:oauth:invalid_token",!1);break;case"wordproof:webhook:success":await l("wordproof:oauth:success",!0);break;case"wordproof:webhook:failed":await l("wordproof:webhook:failed",!1);break;case"wordproof:settings:updated":await l("wordproof:settings:updated"),await h(t);break;case"wordproof:oauth:destroy":await l("wordproof:oauth:destroy",!1);break;case"wordproof:oauth:retry":await l("wordproof:open_authentication",!1);break;case"wordproof:oauth:close":u()}},l=async function(t){let o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;u(),w(t),!1===o&&(await i(),e(!1)),!0===o&&e(!0)},u=()=>{window.removeEventListener("message",p,!1),r.close()},f=async e=>{await a((()=>(async e=>{const{state:t,code:o}=e;return await s({path:"wordproof/v1/oauth/authenticate",method:"POST",data:{state:t,code:o}})})(e)),(async e=>{const t={type:"wordproof:sdk:access-token",source_id:e.source_id};return r.postMessage(t,d("origin")),!0}),(async()=>!1))},h=async e=>{await a((()=>(async e=>{const{settings:t}=e;return await s({path:"wordproof/v1/settings",method:"POST",data:{settings:t}})})(e)),(async()=>{const o=e.settings;return o.selectedPostTypes&&t(o.selectedPostTypes),!0}),(async()=>!1))};window.addEventListener("wordproof:open_authentication",(e=>{e.preventDefault(),c(o,"WordProof_Authentication")}),!1),window.addEventListener("wordproof:open_settings",(e=>{e.preventDefault(),c(n,"WordProof_Settings")}),!1)})(),function(e,t,o){e(m((async()=>{if(y("wordproof.timestamp",!0)){const e=d("current_post_id"),n=await(async e=>s({path:`wordproof/v1/posts/${e}/timestamp`,method:"POST"}))(e);f({response:n,createSuccessNotice:t,createErrorNotice:o,postId:e})}}),500))}(b,e,o)}()}()}();
=======
oe("Timestamp this %s","wordproof"),o),onChange:e=>{s({_wordproof_timestamp:e}),r||!0!==e||c()},checked:n._wordproof_timestamp||i(),disabled:i()})),(0,e.createElement)(se,null,(0,e.createElement)(R,null)),(0,e.createElement)(te,null))};le.proptypes={postType:u().string.isRequired,postMeta:u().object.isRequired,isAuthenticated:u().bool.isRequired,setPostMeta:u().func.isRequired};var ue=ie([ce((e=>({postMeta:e("core/editor").getEditedPostAttribute("meta"),postType:e("core/editor").getCurrentPostType(),isAuthenticated:e("wordproof").getIsAuthenticated(),selectedPostTypes:e("wordproof").getSelectedPostTypes()}))),pe((e=>({setPostMeta(t){e("core/editor").editPost({meta:t})}})))])(le);const{registerPlugin:we}=wp.plugins;we("wordproof-timestamp-panel",{render:()=>(0,e.createElement)(ue,null)}),function(){const{createSuccessNotice:e,createErrorNotice:o}=(0,t.dispatch)("core/notices");(function(){const{setIsAuthenticated:e,setSelectedPostTypes:t}=v("wordproof"),o=d("popup_redirect_authentication_url"),n=d("popup_redirect_settings_url");let r=null;const c=(e,t)=>{r=function(e,t){let o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:800,r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:680;const a=e.top.outerHeight/2+e.top.screenY-r/2,s=e.top.outerWidth/2+e.top.screenX-n/2;return e.open(t,o,`toolbar=no,\n\t\tlocation=no,\n\t\tdirectories=no,\n\t\tstatus=no,\n\t\tmenubar=no,\n\t\tresizable=no,\n\t\tcopyhistory=no,\n\t\twidth=${n},\n\t\theight=${r},\n\t\ttop=${a},\n\t\tleft=${s}`)}(window,e,t),r&&r.focus(),window.addEventListener("message",p,!1)},p=async e=>{const{data:t,source:o,origin:n}=e;if(n===d("origin")&&r===o)switch(t.type){case"wordproof:oauth:granted":!1===await f(t)&&await l("wordproof:oauth:failed",!1);break;case"wordproof:oauth:failed":await l("wordproof:oauth:failed",!1);break;case"wordproof:oauth:denied":await l("wordproof:oauth:denied",!1);break;case"wordproof:webhook:success":await l("wordproof:oauth:success",!0);break;case"wordproof:webhook:failed":await l("wordproof:webhook:failed",!1);break;case"wordproof:settings:updated":await l("wordproof:settings:updated"),await h(t);break;case"wordproof:oauth:destroy":await l("wordproof:oauth:destroy",!1);break;case"wordproof:oauth:retry":await l("wordproof:open_authentication",!1);break;case"wordproof:oauth:close":u()}},l=async function(t){let o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;u(),w(t),!1===o&&(await i(),e(!1)),!0===o&&e(!0)},u=()=>{window.removeEventListener("message",p,!1),r.close()},f=async e=>{await a((()=>(async e=>{const{state:t,code:o}=e;return await s({path:"wordproof/v1/oauth/authenticate",method:"POST",data:{state:t,code:o}})})(e)),(async e=>{const t={type:"wordproof:sdk:access-token",source_id:e.source_id};return r.postMessage(t,d("origin")),!0}),(async()=>!1))},h=async e=>{await a((()=>(async e=>{const{settings:t}=e;return await s({path:"wordproof/v1/settings",method:"POST",data:{settings:t}})})(e)),(async()=>{const o=e.settings;return o.selectedPostTypes&&t(o.selectedPostTypes),!0}),(async()=>!1))};window.addEventListener("wordproof:open_authentication",(e=>{e.preventDefault(),c(o,"WordProof_Authentication")}),!1),window.addEventListener("wordproof:open_settings",(e=>{e.preventDefault(),c(n,"WordProof_Settings")}),!1)})(),function(e,t,o){e(m((async()=>{if(y("wordproof.timestamp",!0)){const e=d("current_post_id"),n=await(async e=>s({path:`wordproof/v1/posts/${e}/timestamp`,method:"POST"}))(e);f({response:n,createSuccessNotice:t,createErrorNotice:o,postId:e})}}),500))}(b,e,o)}()}()}();
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
