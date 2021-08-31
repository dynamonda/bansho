window.sendSave = function sendSave(isbn){
    console.log("保存 isbn=" + isbn);

    var csrf = document.getElementsByName("csrf-token")[0].content;
    console.log('CSRF=' + csrf);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        var response = req.responseText;
        console.log(response);

        var target = document.getElementById('book-botton-' + isbn);
        if(req.readyState == 4){    // 通信の完了時
            if(req.status == 200){  // 通信成功
                target.innerText = "成功";
            }else{                  // 通信失敗
                target.innerText = "失敗";
            }
        }else{  // 通信中
            target.innerText = "通信中";
        }
    };

    req.open('POST', '/book/search/ajax/add', true);
    req.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    req.setRequestHeader('X-CSRF-TOKEN', csrf);
    req.send('isbn=' + isbn);
}
