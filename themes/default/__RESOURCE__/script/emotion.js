(function(e,t,n,r){
    W.emotion={
        url:"http://res.mail.qq.com/zh_CN/images/mo/DEFAULT2/",data:{
            0:"微笑",1:"撇嘴",2:"色",3:"发呆",4:"得意",5:"流泪",6:"害羞",7:"闭嘴",8:"睡",9:"大哭",10:"尴尬",11:"发怒",12:"调皮",13:"呲牙",14:"惊讶",15:"难过",16:"酷",17:"冷汗",18:"抓狂",19:"吐",20:"偷笑",21:"可爱",22:"白眼",23:"傲慢",24:"饥饿",25:"困",26:"惊恐",27:"流汗",28:"憨笑",29:"大兵",30:"奋斗",31:"咒骂",32:"疑问",33:"嘘",34:"晕",35:"折磨",36:"衰",37:"骷髅",38:"敲打",39:"再见",40:"擦汗",41:"抠鼻",42:"鼓掌",43:"糗大了",44:"坏笑",45:"左哼哼",46:"右哼哼",47:"哈欠",48:"鄙视",49:"委屈",50:"快哭了",51:"阴险",52:"亲亲",53:"吓",54:"可怜",55:"菜刀",56:"西瓜",57:"啤酒",58:"篮球",59:"乒乓",60:"咖啡",61:"饭",62:"猪头",63:"玫瑰",64:"凋谢",65:"示爱",66:"爱心",67:"心碎",68:"蛋糕",69:"闪电",70:"炸弹",71:"刀",72:"足球",73:"瓢虫",74:"便便",75:"月亮",76:"太阳",77:"礼物",78:"拥抱",79:"强",80:"弱",81:"握手",82:"胜利",83:"抱拳",84:"勾引",85:"拳头",86:"差劲",87:"爱你",88:"NO",89:"OK",90:"爱情",91:"飞吻",92:"跳跳",93:"发抖",94:"怄火",95:"转圈",96:"磕头",97:"回头",98:"跳绳",99:"挥手",100:"激动",101:"街舞",102:"献吻",103:"左太极",104:"右太极"
        }
        ,ext:".gif",ReplaceEmoji:function(e){
            var t,n,r=W.emotion,i=r.url,s=r.ext,o=r.data;
            for(t in o)n=new RegExp("/"+o[t],"g"),e=e.replace(n,'<img src="'+i+t+s+'" alt="mo-'+o[t]+'"/>');
            return e
        }
        
    }
    ,LINK=t.Links,t.Event.bind("WXM:Plugins:Wysisyg:change",function(t,n){
        var r=n.$textarea,i=r.data("$tip"),s=e.trim(n.wysiwyg.getContent()).length,o=r.data("max-length"),u=o-s;
        i&&i.html(u>=0?'还可以输入<span class="b i">'+u+"</span>字":'已超出<span class="b i c-r">'+Math.abs(u)+"</span>字")
    }),W.upload={
        suc:function(t,n,r){
            W.suc(t),e("#uploadIframe"+r).attr("src","&lang=zh_CN&t=wxm-upload&type="+n+"&formId="+r),W.M[n].click({
                formId:r,type:n
            })
        }
        ,err:function(t,n,r){
            W.err(t),e("#uploadIframe"+r).attr("src",LINK.indexpage+"lang=zh_CN&t=wxm-upload&type="+n+"&formId="+r)
        }
        
    }
    ,W.pageNavCallBack=function(e){
        var n=e.formId,r=e.type,i=e.pageIdx,s=e.pageSize,o=e.subtype,u=W.M[r].click;
        return t.DATA.replytype=="smartreply"&&o==0&&(u=W.M[20].click(e)),u&&u(e)
    }
    ,W.pageJump=function(t,n,r){
        var i=e(t),s=i.parent().find(".pageIdxInput"),o=e.trim(s.val())*1-1,u=n.pageCount;
        o=o>0?o:0,o=u&&u<=o?u-1:o;
        if(!r||r.type=="click")n.pageIdx=o,W.pageNavCallBack(n);
        else{
            var a=0;
            window.event?a=window.event.keyCode:r.which&&(a=r.which),a==13&&(n.pageIdx=o,W.pageNavCallBack(n))
        }
        
    };
    var i=function(e,t){
        var n,t;
        n=e.formId?W.M.list[e.formId]:e,t=t||e.type,n.find(".selected").removeClass("selected"),n.find(".chooseMedia"+t).addClass("selected"),s(t)
    }
    ,s=function(n){
        n!=2&&n!=3&&n!=4&&n!=10||t.DATA.canMassSendComment!=1?e("#needComment").hide():e("#needComment").show()
    }
    ,o=function(e){
        var n=e.type,r=e.formId,i=e.title||"选择素材",s=e.pageIdx||0,o=e.pageSize||10,u=LINK.filemanagepage+"&lang=zh_CN&t=ajax-fileselect&type="+n+"&r="+Math.random();
        n==10&&(u=LINK.operate_appmsg+"&lang=zh_CN&sub=list&t=ajax-fileselect&type=10"+"&r="+Math.random()),u+="&pageIdx="+s+"&pagesize="+o+"&formid="+r,W.d.show({
            title:i,content:'<div class="mediaList"><div class="loading"><div><img src="/htmledition/images/w_loader.gif"></div><div>数据加载中...</div></div></div>',width:800,height:400,onok:function(){
                var t=W.M[n].sure;
                return t&&t(e)
            }
            
        }),W.ajax(u,{},function(e){
            var i=W.d.get$Inside(".mediaList").html(W.t("#tFileListItem",e));
            i.find(".uploadArea iframe").attr("id","uploadIframe"+r).attr("src",LINK.indexpage+"&lang=zh_CN&t=wxm-upload&type="+n+"&formId="+r),t.Event.notify("WXM:mediaLoaded")
        }
        ,function(){
            W.d.hide(),W.err("加载失败")
        })
    }
    ,u=function(n){
        var r=t.DATA.ACL,i=n.type,s=n.subtype,o=n.formId,s=n.subtype,u=n.title||"选择图文消息",a=n.pageIdx||0,f=n.pageSize||10,l=LINK.operate_appmsg+"&lang=zh_CN&sub=list&t=ajax-appmsgs-fileselect&type=10"+"&r="+Math.random();
        if(r.appMsg!=="1")return alert("你没有权限选择选择图文消息"),!1;
        var c={
            multiMixAppMsg:3,commAppMsg:2
        }
        ,h=[];
        for(var p in c)r[p]==="1"&&h.push(c[p]);
        s=s||h[0],l+="&pageIdx="+a+"&pagesize="+f+"&formid="+o+"&subtype="+s,W.d.show({
            title:u,content:W.t("#tAppMsgBox",{
                List:!1,subtype:s,height:500
            }),width:840,height:400,onok:function(){
                n.subtype=s;
                var e=W.M[i].sure;
                return e&&e(n)
            }
            
        }),e("#appMsgBoxTab"+s).addClass("selected"),s*1===2?e("#addAppmsgBtn").hide():e("#addAppmsgBtn").show().attr("href",LINK.operate_appmsg+"&sub=edit&t=wxm-appmsgs-edit&type=10&subtype="+s+"&lang=zh_CN"),e(".chooseAppmsg").click(function(){
            return n.subtype=e(this).data("subtype"),n.pageIdx=0,n.pageSize=10,W.M[10].click(n),!1
        }),W.ajax(l,{},function(n){
            W.d.get$Inside(".appmsgBoxContent").html(W.t("#tAppMsgListItem",n)),e(".dialogBox .msg-item-wrapper").unbind("click").click(function(){
                e(".dialogBox .msg-item-wrapper").removeClass("msg-selected"),e(this).addClass("msg-selected")
            }).hover(function(){
                e(this).addClass("msg-hover")
            }
            ,function(){
                e(this).removeClass("msg-hover")
            }),t.Event.notify("WXM:mediaLoaded")
        }
        ,function(){
            W.d.hide(),W.err("加载失败")
        })
    }
    ,a=function(n){
        var r=n.title||"选择文件素材",i=n.pageIdx||0,s=n.pageSize||10,o=n.type||2;
        _callback=n.callback,_url=LINK.filemanagepage+"&lang=zh_CN&sub=list&t=ajax-fileselect&type="+o+"&r="+Math.random(),_url+="&pageIdx="+i+"&pagesize="+s,W.d.show({
            title:r,content:W.t("#tFileBox"),width:840,height:400,onok:function(){
                n.type=o,g(n)
            }
            
        }),e("#addAppmsgBtn").show().attr("href",LINK.filemanagepage+"&type=0&t=wxm-file&pagesize=10&pageidx=0&lang=zh_CN"),e("#fileBoxTab"+o).addClass("selected"),e(".choosefile").click(function(){
            return n.pageIdx=0,n.pageSize=10,n.type=e(this).attr("type"),n.callback=_callback,a(n),!1
        }),W.ajax(_url,{},function(e){
            e.PageMsg.FileBox=!0,W.d.get$Inside(".fileBoxContent").html(W.t("#tFileBoxItem",e)),t.Event.notify("WXM:mediaLoaded")
        }
        ,function(){
            W.d.hide(),W.err("加载失败")
        })
    }
    ,f=function(t,n,r){
        var i=e("#previewBox"),s=i.find(".loading"),o=i.find(".errorTip"),u=e("#bCardUserInput");
        _$bCardPreBox=e("#bCardPreBox");
        var a="/cgi-bin/masssend?lang=zh_CN&t=ajax-business-card&action=preview",f=e.trim(u.val());
        if(f.length<6||f.length>20)return alert("微信号必须为6到20个字符"),u.focus(),r&&r(),!1;
        _$bCardPreBox.html("").hide(),o.hide(),s.show(),W.ajax(a,{
            username:f
        }
        ,function(e){
            s.hide();
            var r=e.ret;
            if(e&&e.ret=="0")_$bCardPreBox.html(W.t("#tMediaBCard",{
                fakeid:e.result.fakeId,nickname:e.result.nickname,username:e.result.username
            })),_$bCardPreBox.show(),t&&t(e);
            else{
                switch(e.ret){
                    case"64001":o.html("你输入是非法的微信号，请重新输入");
                    break;
                    case"64002":o.html("你输入的微信号不存在，请重新输入");
                    break;
                    case"64003":o.html("你输入的微信号不是你的好友，无法发送其名片");
                    break;
                    default:o.html("系统繁忙，请稍后重试")
                }
                o.show(),u.focus(),n&&n(e)
            }
            
        }
        ,function(){
            o.html("加载失败，请稍后重试"),n&&n(data)
        }
        ,function(){
            s.hide(),r&&r()
        })
    }
    ,l=function(t){
        var n=t.formId,r=W.M.list[n],i=r.mediaData,s=t.type,o=t.title||"选择好友名片";
        W.d.show({
            title:o,content:W.t("#tBusinessCardBox"),width:400,height:210,onok:function(){
                var e=W.M[s].sure,t=e&&e({
                    formId:n,type:s
                });
                return t
            }
            
        });
        var u=function(e){
            i.username=e.result.username
        };
        e("#bCardUserInput").keydown(function(e){
            if(e.keyCode==13)return f(u),!1
        }),e("#btnPreview").click(function(){
            f(u)
        })
    }
    ,c=function(t){
        if(e("#dialogOK").attr("disable")=="false")return!1;
        var n=t.formId,r=W.M.list[n],s=r.find(".txtArea"),o=r.find(".mediaArea"),u=e.trim(e("#bCardPreBox").html()),a=function(e){
            o.html(e),i(t),s.hide(),o.show()
        };
        return u!=""?(a(u),!1):(e("#dialogOK").addClass("btnDisableS").attr("disable",!1),f(function(t){
            a(e.trim(e("#bCardPreBox").html())),e("#dialogOK").removeClass("btnDisableS").attr("disable",!0),W.d.hide(),r.mediaData.username=t.result.username
        }
        ,function(){},function(){
            e("#dialogOK").removeClass("btnDisableS").attr("disable",!0)
        }),!0)
    }
    ,h=function(n){
        var r=n.formId,s,o;
        n.type==10?o=e(".appmsgBox .msg-selected").removeClass("msg-selected").data("appid"):(s=W.d.get$Inside(".mediaList input[name='file']:checked"),o=s.val());
        if(o){
            if(m){
                m(n,o);
                return
            }
            var u=W.M.list[r],a=u.find(".txtArea"),f=u.find(".mediaArea");
            u.mediaData.fid=o,n.type==10?f.html('<div class="msg-item-wrapper msg-col">'+e("#appmsg"+o).html()+"</div>"):f.html(e("#fileInfo"+o).html()),t.Event.notify("WXM:mediaLoaded"),i(n),a.hide(),f.show()
        }
        
    }
    ,p=function(e){
        var n=e.type,r=e.formId,i=W.M.list[r],s=i.find(".txtArea"),o=s.find("textarea"),u=i.find(".mediaArea"),a=i.mediaData,f=e.data;
        u.html(W.t("#tFile"+n,f)),s.hide(),u.show(),n==10?a.fid=f.appmsgid:n==42?a.username=f.username:a.fid=f.fileId,i.find(".selected").removeClass("selected"),i.find(".chooseMedia"+f.type).addClass("selected"),t.Event.notify("WXM:mediaLoaded")
    }
    ,d=function(e){
        var t=e.mediaData,n=e.title;
        return t.type=e.type,t.fileid=t.fid,t.error=!1,t.fileid||(W.err("选择的"+n+"为空，请选择"+n+"后再发送"),t.error=!0),t
    };
    W.M={
        list:{},0:{
            click:function(e){
                var n=W.M.list[e.formId],r=n.find(".txtArea"),s=r.find("textarea"),o=n.find(".mediaArea"),u=e.formId;
                o.html('<iframe frameborder="0" style="width:400px;height:250px;border:none;" src="'+t.StaticPath.recorder+"#_formId="+u+"&"+ +(new Date)+'"></iframe>'),n.iframe=o.find("iframe")[0],r.hide(),o.show(),i(e)
            }
            ,getData:function(e){
                var t=e.formId,n=W.M.list[t].mediaData;
                return n.error=!W.R.isVoiceRecorderValid(t),n
            }
            
        }
        ,1:{
            click:function(e){
                var t=W.M.list[e.formId],n=t.find(".txtArea"),r=t.find(".mediaArea");
                t.mediaData.type=e.type,n.show(),r.hide(),i(e)
            }
            ,init:function(e){
                var t=W.M.list[e.formId],n=t.find(".txtArea"),r=n.find("textarea"),i=t.find(".mediaArea"),s=e.data;
                r.data("Wysiwyg").insertHTML(W.emotion.ReplaceEmoji(s.content)),n.show(),i.hide()
            }
            ,getData:function(t){
                var n=t.formId,r=W.M.list[t.formId],i=r.find(".txtArea"),s=i.find("textarea"),o=r.mediaData;
                o.content=e.trim(s.data("Wysiwyg").replace().getContent()),o.error=!1;
                var u=s.data("max-length");
                if(o.content==""||o.content.length>u)o.error=!0,W.err("文字必须为1到"+u+"个字符");
                return{
                    type:1,content:o.content,error:o.error
                }
                
            }
            
        }
        ,2:{
            click:function(e){
                e.title="选择图片",o(e)

            }
            ,init:function(e){
                p(e)
            }
            ,sure:function(e){
                h(e)
            }
            ,getData:function(e){
                var t=e.formId,n=W.M.list[e.formId];
                return d({
                    type:2,title:"图片",mediaData:n.mediaData
                })
            }
            
        }
        ,3:{
            click:function(e){
                e.title="选择语音",o(e)
            }
            ,init:function(e){
                p(e)
            }
            ,sure:function(e){
                h(e)
            }
            ,getData:function(e){
                var t=e.formId,n=W.M.list[e.formId];
                return d({
                    type:3,title:"语音",mediaData:n.mediaData
                })
            }
            
        }
        ,4:{
            click:function(e){
                e.title="选择视频",o(e)
            }
            ,init:function(e){
                p(e)
            }
            ,sure:function(e){
                h(e)
            }
            ,getData:function(e){
                var t=e.formId,n=W.M.list[e.formId];
                return d({
                    type:4,title:"视频",mediaData:n.mediaData
                })
            }
            
        }
        ,20:{
            click:function(e){
                a(e)
            }
            ,init:function(e){
                p(e)
            }
            ,sure:function(e){
                g(e)
            }
            ,getData:function(e){}
        }
        ,10:{
            click:function(e){
                u(e)
            }
            ,init:function(e){
                p(e)
            }
            ,sure:function(e){
                h(e)
            }
            ,getData:function(e){
                var t=e.formId,n=W.M.list[e.formId],r=n.mediaData;
                return r.type=10,r.appmsgid=r.fid,r.error=!1,r.appmsgid||(W.err("请选择图文消息"),r.error=!0),r
            }
            
        }
        ,42:{
            click:function(e){
                l(e)
            }
            ,init:function(e){
                p(e)
            }
            ,sure:function(e){
                return c(e)
            }
            ,getData:function(e){
                var t=e.formId,n=W.M.list[e.formId],r=n.mediaData;
                return r.type=42,r.username=r.username,r.error=!1,r.username==""&&(W.err("名片为空，请选择一张名片"),r.error=!0),r
            }
            
        }
        
    }
    ,W.M[5]=W.M[10],W.M[5].init=function(n){
        var r=n.type,i=n.formId,s=W.M.list[i],o=s.find(".mediaArea"),u=n.data;
        s.mediaData.fid=u.ruleId,s.find(".txtArea").hide(),o.html(W.t("#tLoading",{})).show(),W.ajax("/cgi-bin/replyrulepage?t=ajax-rule-msg&lang=zh_CN&action=showrule&ruleid="+n.data.ruleId,{},function(n){
            o.html(W.t("#tFile10",e.extend({},n,{
                time:""
            }))),s.find(".selected").removeClass("selected"),s.find(".chooseMedia10").addClass("selected"),t.Event.notify("WXM:mediaLoaded")
        }
        ,function(){
            o.html("加载失败")
        })
    }
    ,W.R={
        chooseVoiceById:function(e){
            if(W.M.list[e]){
                var t=3;
                W.M[t].click({
                    type:t,formId:e
                })
            }
            
        }
        ,getRecorderState:function(e){
            var t;
            try{
                t=e.contentWindow.document.getElementById("recorder").jfGetFlashCurrentState()+""
            }
            catch(n){
                t="4444"
            }
            return t
        }
        ,getNotifyVoiceUploadUrl:function(e,t){
            var n=W.M.list[e];
            return top.location.protocol+"//"+top.location.host+LINK.fmstransport+"&lang=zh_CN&voiceid="+n._fileid+"&streamhost="+n._host+"&_formId="+e+"&callback="+(t||"showUploadResult")+"&t=iframe-fmstransport&"+ +(new Date)
        }
        ,showUploadResult:function(e,t,n,r){
            n==0?(W.suc("录音提交成功"),W.R.chooseVoiceById(e)):W.err("提交录音失败:"+r)
        }
        ,saveCurrentVoice:function(e,t,n,r){
            n==0?(W.suc("录音提交成功"),W.R.chooseVoiceById(e)):W.err("提交录音失败")
        }
        ,isVoiceRecorderValid:function(e){
            var t=W.M.list[e].iframe;
            switch(W.R.getRecorderState(t)){
                case"-1":return W.err("请先点击开始录音"),!1;
                case"401":return W.err("录制中...请先停止录音"),!1;
                case"402":return e&&(t.src=W.R.getNotifyVoiceUploadUrl(e,"saveCurrentVoice")),!1;
                case"4444":return W.err("录音模块不存在"),!1
            }
            
        }
        
    };
    var v={
        filter:function(e){
            return e.replace(/<img.*?alt=["]{0,1}mo-([^"\s]*).*?>/ig,"/$1").replace(/<br.*?>/ig,"\n").replace(/<.*?>/g,"").replace(/&amp;/gi,"&").replace(/&lt;/gi,"<").replace(/&gt;/gi,">").replace(/&quot;/gi,'"').replace(/&nbsp;/gi," ").replace(/&copy;/gi,"©").replace(/&reg;/gi,"®")
        }
        ,input_filter:function(e){
            var t="";
            return e.nodeName.toUpperCase()==="IMG"&&(t=e.alt&&e.alt.substr(0,3)==="mo-"?e:""),t
        }
        
    };
    W.M.initMsgSender=function(t,n){
        function r(){
            var t=[],n=24,i=24,s=15,u=7,f,l,c,h,p,d=W.emotion,v,m,g;
            for(f=0;
            f<u;
            ++f){
                t.push("<tr>");
                for(l=0;
                l<s;
                ++l)v=f*s+l,m=d.url+v+d.ext,title=d.data[v+""],g=' data-title="'+title+'" data-gifurl="'+m+'" ',p="background-position:"+ -v*n+"px 0;",t.push('<td><div class="eItem" style="'+p+'"'+g+"></div></td>");
                t.push("</tr>")
            }
            a.find("table").html(t.join("")),e(".eItem").hover(function(){
                var t=e(this).data("gifurl");
                e(".emotionsGif").html('<img src="'+t+'" />').show()
            }
            ,function(){
                e(".emotionsGif").html("")
            }).click(function(){
                var t=e(this).data("title"),n=e(this).data("gifurl");
                o.data("Wysiwyg").insertHTML('<img src="'+n+'"'+'alt="mo-'+t+'"'+"/>").focus(),a.fadeOut()
            }),r=null
        }
        var s=t.find(".txtArea"),o=s.find("textarea"),u=t.find(".iconEmotion"),a=t.find(".emotions"),f=t.find(".mediaArea"),l=t.find(".uploadFile"),c=null,h=n&&n.data,p=n&&n.maxLength,d={
            type:!!h&&h.type?h.type:1
        };
        o.Wysiwyg(v),o.data({
            "max-length":p||300,$tip:s.find(".tip")
        });
        var m="file_from_"+ +(new Date);
        t.data("formId",m),t.mediaData=d,W.M.list[m]=t,t.find(".uploadArea iframe").attr("id","uploadIframe"+m).attr("src",LINK.indexpage+"&lang=zh_CN&t=wxm-upload&type=0&formId="+m),l.attr("id","uploadfile"+m),n.init&&n.init(t),t.find(".chooseMedia").click(function(){
            var t=e(this),n=t.data("type"),r=W.M[n].click;
            return r&&r({
                formId:m,type:n
            })
        });
        if(h&&h.type){
            var g=W.M[h.type].init;
            g&&g({
                formId:m,type:h.type,data:h
            })
        }
        return t.getData=function(){
            var e=t.find("li.selected").data("type"),n=W.M[e].getData;
            return n?n({
                formId:m
            }):{
                error:!0
            }
            
        }
        ,u.click(function(){
            r&&r(),a.show().hover(function(){
                a.show()
            }
            ,function(){
                a.fadeOut()
            })
        }),{
            setChoose:function(e,n){
                e=e!=5?e:10,i(t,e),e==1?(s.show(),f.hide(),o.data("Wysiwyg").setHTML(n)):(f.html(n).show(),s.hide())
            }
            
        }
        
    }
    ,W.M.MsgSenderExtend={};
    var m;
    W.M.MsgSenderExtend.showAppMsgBox=function(e){
        m=e.callback,u(e)
    };
    var g;
    W.M.MsgSenderExtend.showFileBox=function(e){
        a(e),g=e.callback
    }
    
})(jQuery,WXM,window);
