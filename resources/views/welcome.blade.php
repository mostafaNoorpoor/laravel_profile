<!DOCTYPE html>
<html>
<head>
    <title>Pusher Test</title>
    <style>
        /*---------chat window---------------*/
        .container {
            max-width: 900px;
        }

        .inbox_people {
            background: #fff;
            float: left;
            overflow: hidden;
            width: 30%;
            border-right: 1px solid #ddd;
        }

        .inbox_msg {
            border: 1px solid #ddd;
            clear: both;
            overflow: hidden;
        }

        .top_spac {
            margin: 20px 0 0;
        }

        .recent_heading {
            float: left;
            width: 40%;
        }

        .srch_bar {
            display: inline-block;
            text-align: right;
            width: 60%;
            padding:
        }

        .headind_srch {
            padding: 10px 29px 10px 20px;
            overflow: hidden;
            border-bottom: 1px solid #c4c4c4;
        }

        .recent_heading h4 {
            color: #0465ac;
            font-size: 16px;
            margin: auto;
            line-height: 29px;
        }

        .srch_bar input {
            outline: none;
            border: 1px solid #cdcdcd;
            border-width: 0 0 1px 0;
            width: 80%;
            padding: 2px 0 4px 6px;
            background: none;
        }

        .srch_bar .input-group-addon button {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            padding: 0;
            color: #707070;
            font-size: 18px;
        }

        .srch_bar .input-group-addon {
            margin: 0 0 0 -27px;
        }

        .chat_ib h5 {
            font-size: 15px;
            color: #464646;
            margin: 0 0 8px 0;
        }

        .chat_ib h5 span {
            font-size: 13px;
            float: right;
        }

        .chat_ib p {
            font-size: 12px;
            color: #989898;
            margin: auto;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat_img {
            float: right;
            width: 11%;
        }

        .chat_img img {
            width: 100%;
            border-radius: 50%;
        }

        .chat_ib {
            float: left;
            padding: 0 0 0 15px;
            width: 88%;
        }

        .chat_people {
            overflow: hidden;
            clear: both;
            padding: 5px;
        }

        .chat_list {
            border-bottom: 1px solid #ddd;
            margin: 0;
            padding: 18px 16px 10px;
        }

        .inbox_chat {
            height: 550px;
            overflow-y: scroll;
        }

        .active_chat {
            background: #e8f6ff;
        }

        .incoming_msg_img {
            display: inline-block;
            width: 6%;
        }

        .incoming_msg_img img {
            width: 85%;
            border-radius: 50%;
        }

        .received_msg {
            display: inline-block;
            padding: 0 0 0 10px;
            vertical-align: top;
            width: 92%;
        }

        .received_withd_msg p {
            background: #ebebeb none repeat scroll 0 0;
            border-radius: 0 15px 15px 15px;
            color: #646464;
            font-size: 14px;
            margin: 0;
            padding: 5px 10px 5px 12px;
            width: 100%;
        }

        .time_date {
            color: #747474;
            display: block;
            font-size: 12px;
            margin: 8px 0 0;
        }

        .received_withd_msg {
            width: 57%;
        }

        .mesgs {
            padding: 30px 0 0 0;
            width: 70%;
        }

        .sent_msg p {
            background: #0465ac;
            border-radius: 12px 15px 15px 0;
            font-size: 14px;
            margin: 0;
            color: #fff;
            padding: 5px 10px 5px 12px;
            width: 100%;
        }

        .outgoing_msg {
            overflow: hidden;
            margin: 26px 0 26px;
        }

        .sent_msg {
            float: left;
            width: 46%;
        }

        .input_msg_write input {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            color: #4c4c4c;
            font-size: 15px;
            min-height: 48px;
            width: 100%;
            outline: none;
            padding-right: 45px;
        }

        .type_msg {
            border-top: 1px solid #c4c4c4;
            position: relative;
        }

        .msg_send_btn {
            background: #05728f none repeat scroll 0 0;
            border: none;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            font-size: 15px;
            height: 33px;
            position: absolute;
            right: 0;
            top: 11px;
            width: 33px;
        }

        .messaging {
            padding: 0 0 50px 0;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
        }

        .msg_history {
            height: 516px;
            overflow-y: auto;
        }

        .incoming_msg {
            padding-top: 25px;
        }
    </style>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body dir="rtl">
<div class="messaging">
    <input type="text" style="display: none" id="threadId" value="">
    <div class="inbox_msg">
        <div class="inbox_people">
            <div class="inbox_chat scroll">


            </div>
        </div>
        <div class="mesgs">
            <div class="msg_history" id="ScrollTo">

            </div>
            <div class="type_msg">
                <div class="input_msg_write">
                    <input type="text" id="chatVal" class="write_msg"
                           placeholder="متن خود را تایپ نمایید"/>
                    <button class="msg_send_btn" type="button" onclick="sendChat()"><i
                            class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    String.prototype.escape = function() {
        var tagsToReplace = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;'
        };
        return this.replace(/[&<>]/g, function(tag) {
            return tagsToReplace[tag] || tag;
        });
    };
</script>

<script>
    var userId;
    $.ajax({
        type: 'GET',
        url: 'api/auth/user',
        data: '',
        beforeSend: function (xhrObj) {
            xhrObj.setRequestHeader("Authorization", "<?php echo $_COOKIE['token'] ?>");
        },
        success: function (msg) {
            userId = msg.id;
            subscribe(userId);
        }
    });
    $.ajax({
        type: 'GET',
        url: 'api/messages/threads',
        data: '',
        beforeSend: function (xhrObj) {
            xhrObj.setRequestHeader("Authorization", "<?php echo $_COOKIE['token'] ?>");
        },
        success: function (msg) {
            for (var i = 0; i < msg.data.length; i++) {
                $(".inbox_chat").append(' ' +
                    '<div class="chat_list active_chat" style="cursor:pointer;" onclick="getChatById(' + msg.data[i].id + ')">' +
                    '<div class="chat_people">' +
                    '<div class="chat_img"> <img src="" alt="pic"> </div>' +
                    '<div class="chat_ib"> <h5>' + msg.data[i].subject + '</h5> </div>' +
                    '</div>' +
                    '</div>'
                );
            }
        }
    });

    function getChatById(chatId) {
        $('.msg_history').empty();
        $('#threadId').val(chatId);
        $.ajax({
            type: 'GET',
            url: 'api/messages/threads/' + chatId + '/messages/1',
            data: '',
            beforeSend: function (xhrObj) {
                xhrObj.setRequestHeader("Authorization", "<?php echo $_COOKIE['token'] ?>");
            },
            success: function (msg) {
                //  console.log(msg.data.data)
                msg.data.data.reverse();
                for (var i = 0; i < msg.data.data.length; i++) {
                    var date = new Date(msg.data.data[i].created_at);
                    var hour = date.getHours() > 12 ? date.getHours() : (date.getHours() < 10 ? "0" + date.getHours() : date.getHours());
                    var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
                    if (msg.data.data[i].user_id == userId) {
                        $(".msg_history").append(' ' +
                            '<div class="incoming_msg">' +
                            '<div class="incoming_msg_img">' +
                            '<img src=" " alt="pic">' +
                            '</div>' +
                            '<div class="received_msg">' +
                            '<div class="received_withd_msg">' +
                            '<p>' + msg.data.data[i].body.escape() + '</p>' +
                            '<span class="time_date" dir="ltr">' + hour + ':' + minutes + '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    } else {
                        $(".msg_history").append(' ' +
                            '<div class="outgoing_msg">' +
                            '<div class="sent_msg">' +
                            '<p>' + msg.data.data[i].body.escape() + '</p>' +
                            '<span class="time_date" dir="ltr">' + hour + ':' + minutes + '</span>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                    scrollDown();
                }
            }
        });
    }

    function sendChat() {
        var threadId, inputVal;
        inputVal = $('#chatVal').val();
        threadId = $('#threadId').val();
        if (inputVal == "") {
            alert("لطفا متن خود را تایپ نمایید");
            return false;
        } else if (threadId == "") {
            alert("لطفا مخاطب خود را انتخاب نمایید");
            return false;
        } else {
            var objToday = new Date();
            var curHour = objToday.getHours() > 12 ? objToday.getHours() : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours());
            var curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes();
            $.ajax({
                type: 'POST',
                url: 'api/messages/threads/' + threadId + '/messages',
                data: 'message_body=' + inputVal,
                beforeSend: function (xhrObj) {
                    xhrObj.setRequestHeader("Authorization", "<?php echo $_COOKIE['token'] ?>");
                    xhrObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                },
                success: function (msg) {
                    console.log(msg.data)
                    $(".msg_history").append(' ' +
                        '<div class="incoming_msg">' +
                        '<div class="incoming_msg_img">' +
                        '<img src=" " alt="pic">' +
                        '</div>' +
                        '<div class="received_msg">' +
                        '<div class="received_withd_msg">' +
                        '<p>' + inputVal.escape() + '</p>' +
                        '<span class="time_date" dir="ltr">' + curHour + ':' + curMinute + '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                    scrollDownAfter();

                    $('#chatVal').val('');
                }
            });
        }
    }

    function scrollDown() {
        var objDiv = document.getElementById("ScrollTo");
        objDiv.scrollTop = objDiv.scrollHeight;
    }

    function scrollDownAfter() {
        $('#ScrollTo').animate({scrollTop: $('#ScrollTo').prop("scrollHeight")}, 2000);
    }
</script>

<script src="{{asset('js/app.js')}}"></script>
<script>

    function subscribe(channelId) {
        var objToday = new Date();
        var hour = objToday.getHours() > 12 ? objToday.getHours() : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours());
        var minutes = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes();
        Echo.channel('chat.' + channelId)
            .listen('.new.message', (e) => {
                $(".msg_history").append(' ' +
                    '<div class="outgoing_msg">' +
                    '<div class="sent_msg">' +
                    '<p>' + e.message.escape() + '</p>' +
                    '<span class="time_date" dir="ltr">' + hour + ':' + minutes + '</span>' +
                    '</div>' +
                    '</div>'
                );
                scrollDownAfter();
            });
    }

    function unSubscribe() {
        var channelId = document.getElementById('id').value;
        console.log(channelId);

        Echo.leaveChannel('chat.' + channelId);

    }

</script>

</body>
</html>
