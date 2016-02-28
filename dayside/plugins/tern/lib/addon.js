(function($,ui){
    
dayside.plugins.tern = $.Class.extend({
    init: function (o) {
        this.options = o;
        dayside.ready(function(){
            dayside.editor.bind("editorCreated",function(b,e){
                if (e.tab.options.file.split(".").pop()!="js") return;

                var editor = e.cm;
                function getURL(url, c) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("get", url, true);
                    xhr.send();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState != 4) return;
                        if (xhr.status < 400) return c(null, xhr.responseText);
                        var e = new Error(xhr.responseText || "No response");
                        e.status = xhr.status;
                        c(e);
                    };
                }

                var server;
                getURL("http://ternjs.net/defs/ecma5.json", function(err, code) {
                    if (err) throw new Error("Request for ecma5.json: " + err);
                    server = new CodeMirror.TernServer({defs: [JSON.parse(code)]});
                    editor.setOption("extraKeys", {
                        "Ctrl-Space": function(cm) { server.complete(cm); },
                        "Ctrl-I": function(cm) { server.showType(cm); },
                        "Alt-.": function(cm) { server.jumpToDef(cm); },
                        "Alt-,": function(cm) { server.jumpBack(cm); },
                        "Ctrl-Q": function(cm) { server.rename(cm); },
                    })
                    editor.on("cursorActivity", function(cm) { server.updateArgHints(cm); });
                });
            });
        });
        
    }
});

})(teacss.jQuery,teacss.ui);  