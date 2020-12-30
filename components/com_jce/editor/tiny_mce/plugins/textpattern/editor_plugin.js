/* jce - 2.7.19 | 2019-10-25 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2019 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){function toHtml(s){return s=tinymce.trim(s),"function"==typeof marked?marked(s):s}function cleanURL(src,mode){function toUnicode(s){for(var c=s.toString(16).toUpperCase();c.length<4;)c="0"+c;return"\\u"+c}function clean(s,spaces){function cleanChars(s){s=s.replace(/[\+\\\/\?\#%&<>"\'=\[\]\{\},;@\^\(\)£€$]/g,"");for(var r="",i=0,ln=s.length;i<ln;i++){var ch=s[i];/[^\w\.\-~\s ]/.test(ch)&&toUnicode(ch.charCodeAt(0))<"\\u007F"||(r+=ch)}return s=r}return spaces||(s=s.replace(/[\s ]/g,"_")),s=s.replace(/[\/\\\\]+/g,"/"),s=s.split("/").map(function(string){return cleanChars(string,mode)}).join("/"),s=s.replace(/(\.){2,}/g,""),s=s.replace(/^\./,""),s=s.replace(/\.$/,""),s=s.replace(/^\//,"").replace(/\/$/,"")}return src=clean(src,!0)}tinymce.create("tinymce.plugins.TextPatternPlugin",{init:function(editor,url){function getPatterns(){return isPatternsDirty&&(patterns.sort(function(a,b){return a.start.length>b.start.length?-1:a.start.length<b.start.length?1:0}),isPatternsDirty=!1),patterns}function findPattern(text){for(var patterns=getPatterns(),i=0;i<patterns.length;i++)if(0===text.indexOf(patterns[i].start)&&(!patterns[i].end||text.lastIndexOf(patterns[i].end)==text.length-patterns[i].end.length))return patterns[i]}function sortPatterns(patterns){return patterns.sort(function(a,b){return a.start.length>b.start.length?-1:a.start.length<b.start.length?1:0})}function isMatchingPattern(pattern,text,offset,delta){var textEnd=text.substr(offset-pattern.end.length-delta,pattern.end.length);return textEnd===pattern.end}function hasContent(offset,delta,pattern){return offset-delta-pattern.end.length-pattern.start.length>0}function findEndPattern(text,offset,delta){var pattern,i,patterns=getPatterns(),sortedPatterns=sortPatterns(patterns);for(i=0;i<sortedPatterns.length;i++)if(pattern=sortedPatterns[i],void 0!==pattern.end&&isMatchingPattern(pattern,text,offset,delta)&&hasContent(offset,delta,pattern))return pattern}function splitContainer(container,pattern,offset,startOffset,delta){return container=startOffset>0?container.splitText(startOffset):container,container.splitText(offset-startOffset-delta),container.deleteData(0,pattern.start.length),container.deleteData(container.data.length-pattern.end.length,pattern.end.length),container}function applyInlineFormat(space){var selection,dom,rng,container,offset,startOffset,text,patternRng,pattern,delta,format;if(selection=editor.selection,dom=editor.dom,selection.isCollapsed()&&(rng=selection.getRng(!0),container=rng.startContainer,offset=rng.startOffset,text=container.data,delta=space===!0?1:0,3==container.nodeType&&(pattern=findEndPattern(text,offset,delta),void 0!==pattern&&(startOffset=Math.max(0,offset-delta),startOffset=text.lastIndexOf(pattern.start,startOffset-pattern.end.length-1),startOffset!==-1&&(patternRng=dom.createRng(),patternRng.setStart(container,startOffset),patternRng.setEnd(container,offset-delta),pattern=findPattern(patternRng.toString()),pattern&&pattern.end&&!(container.data.length<=pattern.start.length+pattern.end.length)&&pattern.format)))))return format=editor.formatter.get(pattern.format),format&&format[0].inline?(container=splitContainer(container,pattern,offset,startOffset,delta),editor.formatter.apply(pattern.format,{},container),container):void 0}function applyBlockFormat(){var selection,dom,container,firstTextNode,node,format,textBlockElm,pattern,walker,rng,offset;if(selection=editor.selection,dom=editor.dom,selection.isCollapsed()&&(textBlockElm=dom.getParent(selection.getStart(),"p"))){for(walker=new tinymce.dom.TreeWalker(textBlockElm,textBlockElm);node=walker.next();)if(3==node.nodeType){firstTextNode=node;break}if(firstTextNode){if(pattern=findPattern(firstTextNode.data),!pattern)return;if(rng=selection.getRng(!0),container=rng.startContainer,offset=rng.startOffset,firstTextNode==container&&(offset=Math.max(0,offset-pattern.start.length)),tinymce.trim(firstTextNode.data).length==pattern.start.length)return;if(pattern.format&&(format=editor.formatter.get(pattern.format),format&&format[0].block&&(firstTextNode.deleteData(0,pattern.start.length),editor.formatter.apply(pattern.format,{},firstTextNode),rng.setStart(container,offset),rng.collapse(!0),selection.setRng(rng))),pattern.cmd){editor.undoManager.add();var length=pattern.start.length,data=firstTextNode.data;pattern.remove&&(length=firstTextNode.data.length),firstTextNode.deleteData(0,length),editor.execCommand(pattern.cmd,!1,data)}}}}function handleEnter(){var rng,wrappedTextNode;wrappedTextNode=applyInlineFormat(),wrappedTextNode&&(rng=editor.dom.createRng(),rng.setStart(wrappedTextNode,wrappedTextNode.data.length),rng.setEnd(wrappedTextNode,wrappedTextNode.data.length),editor.selection.setRng(rng)),applyBlockFormat()}function handleSpace(){var wrappedTextNode,lastChar,lastCharNode,rng,dom;wrappedTextNode=applyInlineFormat(!0),wrappedTextNode&&(dom=editor.dom,lastChar=wrappedTextNode.data.slice(-1),/[\u00a0 ]/.test(lastChar)&&(wrappedTextNode.deleteData(wrappedTextNode.data.length-1,1),lastCharNode=dom.doc.createTextNode(lastChar),wrappedTextNode.nextSibling?dom.insertAfter(lastCharNode,wrappedTextNode.nextSibling):wrappedTextNode.parentNode.appendChild(lastCharNode),rng=dom.createRng(),rng.setStart(lastCharNode,1),rng.setEnd(lastCharNode,1),editor.selection.setRng(rng)))}var patterns,isPatternsDirty=!0,use_markdown=!!editor.settings.textpattern_use_markdown;if(use_markdown){var scriptLoader=new tinymce.dom.ScriptLoader;scriptLoader.add(url+"/js/marked.min.js"),scriptLoader.loadQueue(function(){"undefined"!=typeof marked&&marked.setOptions({renderer:new marked.Renderer,gfm:!0})})}editor.onPreInit.add(function(ed){ed.formatter.register("markdownlink",{inline:"a",selector:"a",remove:"all",split:!0,deep:!0,onmatch:function(){return!0},onformat:function(elm,fmt,vars){tinymce.each(vars,function(value,key){ed.dom.setAttrib(elm,key,value)})}})}),editor.addCommand("InsertMarkdownImage",function(ui,node){var data=node.split("]("),dom=editor.dom;if(data.length<2)return!1;var alt=data[0],src=data[1];src=src.substring(0,src.length),alt=alt.substring(1,1),src=cleanURL(src),src=editor.convertURL(src);var args={alt:alt,src:src};src||(args["data-mce-upload-marker"]=1,args.width=320,args.height=240,args.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",args.class="mce-item-uploadmarker");var html=dom.createHTML("img",args);return editor.execCommand("mceInsertContent",!1,html),!1});var custom_patterns=editor.getParam("textpattern_custom_patterns","","hash");editor.addCommand("InsertCustomTextPattern",function(ui,node){node=node.replace(/^\$\$|\$\$$/g,"");var html;tinymce.is(custom_patterns,"function")&&(html=custom_patterns(node)),tinymce.is(custom_patterns,"object")&&(html=custom_patterns[node]),tinymce.is(html)&&editor.execCommand("mceReplaceContent",!1,html)}),patterns=editor.settings.textpattern_patterns||[{start:"*",end:"*",format:"italic"},{start:"**",end:"**",format:"bold"},{start:"~~",end:"~~",format:"strikethrough"},{start:"`",end:"`",format:"code"},{start:"![",end:")",cmd:"InsertMarkdownImage",remove:!0},{start:"#",format:"h1"},{start:"##",format:"h2"},{start:"###",format:"h3"},{start:"####",format:"h4"},{start:"#####",format:"h5"},{start:"######",format:"h6"},{start:">",format:"blockquote"},{start:"1. ",cmd:"InsertOrderedList"},{start:"* ",cmd:"InsertUnorderedList"},{start:"- ",cmd:"InsertUnorderedList"},{start:"$$",end:"$$",cmd:"InsertCustomTextPattern"}],editor.onKeyDown.add(function(ed,e){13!=e.keyCode||tinymce.VK.modifierPressed(e)||handleEnter()}),editor.onKeyUp.add(function(ed,e){32!=e.keyCode||tinymce.VK.modifierPressed(e)||handleSpace()}),this.getPatterns=getPatterns,this.setPatterns=function(newPatterns){patterns=newPatterns,isPatternsDirty=!0},use_markdown&&(editor.onBeforeSetContent.add(function(ed,o){o.content=toHtml(o.content)}),editor.plugins.clipboard&&editor.onGetClipboardContent.add(function(ed,clipboard){var text=clipboard["text/plain"]||"",html=clipboard["text/html"]||"";text&&!html&&(markdown=toHtml(text),markdown!==text&&(clipboard["text/html"]=markdown))}))}}),tinymce.PluginManager.add("textpattern",tinymce.plugins.TextPatternPlugin)}();