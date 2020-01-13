<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Document</title>
<!-- socket.ioを呼び出し（これをしないとapp.jsを読んでくれない） -->
<body>
<script>
        $(function(){
            $('#button').click( //起動するボタンなどのid名を指定
                function(){
                    $.ajax({
                        type:'GET', //GETかPOSTか
                        url:'http://localhost:3000/eth_all',//url+ファイル名 .htmlは省略可
                        dataType:'string',//他にjsonとか選べるとのこと
                    }).done(function (results){
                        $('#text').html(results);//展開したいタグのidを指定
                        alert('ファイルの取得に成功しました。'+results);
                    }).fail(function(jqXHR,textStatus,errorThrown){
                        alert('ファイルの取得に失敗しました。');
                        console.log("ajax通信に失敗しました")
                        console.log(jqXHR.status);
                        console.log(textStatus);
                        console.log(errorThrown.message);
                    });
                }
            );
        });
    </script>

    <input type="button" id="button" value="AjaxTest"><br/>
    <div id="text"></div>
</body></html>
