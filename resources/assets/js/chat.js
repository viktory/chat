/**
 * Date: 12.07.15
 * @author Viktoriia Lysenko <lysenkoviktory@gmail.com>
 */

;(function($) {
    var default_opts = {
        'uri': 'localhost',
        'port': '8080',
        'currentUserId': null
    };

    $.fn.chat = function(options) {
        var opts = $.extend({}, default_opts, options);
        var self = this;

        if (!opts.currentUserId) {
            throw "Invalid data";
        }

        var conn = new WebSocket('ws://' + opts.uri + ':' + opts.port);

        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            var to = $('.user-block').find('.list-group-item.active').data('id');
            var html = e.data;
            var userIds = [$(html).data('to'), $(html).data('from')];
            if ((userIds.indexOf(opts.currentUserId) >= 0) && (userIds.indexOf(to) >= 0)) {
                addMessageToChatBox(html);
            } else {
                var counter = $('.user-block').find('.list-group-item[data-id="' + $(html).data('from') + '"]').find('.counter').text()
                $('.user-block').find('.list-group-item[data-id="' + $(html).data('from') + '"]').find('.counter').text(++counter);
            }

        };

        conn.onclose = function (event) {
            //var reason;
            //
            //if (event.code == 1000)
            //    reason = "Normal closure, meaning that the purpose for which the connection was established has been fulfilled.";
            //else if(event.code == 1001)
            //    reason = "An endpoint is \"going away\", such as a server going down or a browser having navigated away from a page.";
            //else if(event.code == 1002)
            //    reason = "An endpoint is terminating the connection due to a protocol error";
            //else if(event.code == 1003)
            //    reason = "An endpoint is terminating the connection because it has received a type of data it cannot accept (e.g., an endpoint that understands only text data MAY send this if it receives a binary message).";
            //else if(event.code == 1004)
            //    reason = "Reserved. The specific meaning might be defined in the future.";
            //else if(event.code == 1005)
            //    reason = "No status code was actually present.";
            //else if(event.code == 1006)
            //    reason = "Abnormal error, e.g., without sending or receiving a Close control frame";
            //else if(event.code == 1007)
            //    reason = "An endpoint is terminating the connection because it has received data within a message that was not consistent with the type of the message (e.g., non-UTF-8 [http://tools.ietf.org/html/rfc3629] data within a text message).";
            //else if(event.code == 1008)
            //    reason = "An endpoint is terminating the connection because it has received a message that \"violates its policy\". This reason is given either if there is no other sutible reason, or if there is a need to hide specific details about the policy.";
            //else if(event.code == 1009)
            //    reason = "An endpoint is terminating the connection because it has received a message that is too big for it to process.";
            //else if(event.code == 1010) // Note that this status code is not used by the server, because it can fail the WebSocket handshake instead.
            //    reason = "An endpoint (client) is terminating the connection because it has expected the server to negotiate one or more extension, but the server didn't return them in the response message of the WebSocket handshake. <br /> Specifically, the extensions that are needed are: " + event.reason;
            //else if(event.code == 1011)
            //    reason = "A server is terminating the connection because it encountered an unexpected condition that prevented it from fulfilling the request.";
            //else if(event.code == 1015)
            //    reason = "The connection was closed due to a failure to perform a TLS handshake (e.g., the server certificate can't be verified).";
            //else
            //    reason = "Unknown reason";
            addMessageToChatBox("<br>Connection closed. Please, reload the page");
        };

        var addMessageToChatBox = function (message) {
            $("#chatMessages").append(message);
        }

        var send = function() {
            var messageText = $(self).val();
            var userTo = $(".user-block").find('.list-group-item.active').data('id');
            var message = JSON.stringify({message: messageText, userTo: userTo});
            conn.send(message);
            $(self).val("");
        }

        $('.user-block .list-group-item').on('click', function() {
            $('.user-block').find('.list-group-item.active').removeClass('active');
            $(this).addClass('active');
            $.get($(this).data('url'))
                .done(function( data ) {
                    $("#chatMessages").html(data);
                    $('.user-block').find('.list-group-item.active').find('.counter').text('');
                    $('#message').removeAttr('disabled');
                    $('#send-btn').removeAttr('disabled');
                });
        });

        $('#message').keyup(function(e) {
            if (e.keyCode == 13) {
               send();
            }
        });

        $('#send-btn').on( "click", send);
    };
})(jQuery);