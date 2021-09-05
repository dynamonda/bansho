// ボタンテキスト
const HaveText = '保存';
const NotHaveText = '解除';

// ユーザー所持に登録
window.sendSave = function sendSave(book){
    console.log("保存 book=" + book);
    console.dir(book);

    var isbn = book.isbn;

    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        var response = req.responseText;
        console.log(response);

        var target = document.getElementById('book-botton-' + isbn);
        if(req.readyState == 4){    // 通信の完了時
            if(req.status == 200){  // 通信成功
                // 表示変更
                target.innerText = NotHaveText;
                target.className = "btn btn-primary";

                // Todo: 実行される関数を削除の方に変更
                // にしたいが、ひとまず無効
                target.onclick = "";

            }else{                  // 通信失敗
                target.innerText = "失敗";
            }
        }else{  // 通信中
            target.innerText = "通信中";
        }
    };

    req.open('POST', '/book/ajax/add', true);
    addCsrfHeader(req);
    req.send('data=' + JSON.stringify(book));
}

// ユーザー所持から削除
window.sendDelete = function sendDelete(book){
    console.log("ユーザー所持から削除 book" + book);
    console.dir(book);

    const isbn = book.isbn;
    console.log('isbn=' + isbn);

    // ajaxで送信
    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        var response = req.responseText;
        console.log(response);

        var target = document.getElementById('book-botton-' + isbn);
        if(req.readyState == 4){    // 通信の完了時
            if(req.status == 200){  // 通信成功
                // 表示変更
                target.innerText = HaveText;
                target.className = "btn btn-outline-primary";

                // Todo: 実行される関数を追加の方に変更
                // にしたいが、ひとまず無効
                target.onclick = "";

            }else{                  // 通信失敗
                target.innerText = "失敗";
            }
        }else{  // 通信中
            target.innerText = "通信中";
        }
    };

    req.open('POST', '/book/ajax/delete', true);
    addCsrfHeader(req);
    req.send('isbn=' + isbn);
}

// RequestにCSRFトークン含めヘッダーを追加
function addCsrfHeader(req)
{
    var csrf = document.getElementsByName("csrf-token")[0].content;

    req.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    req.setRequestHeader('X-CSRF-TOKEN', csrf);
}
