/**
 * Date: 12.07.15
 * @author Viktoriia Lysenko <lysenkoviktory@gmail.com>
 */

;(function($) {
    var default_opts = {
        'uri': 'localhost',
        'port': '8080',
        'currentUserId': null,
        'isAdmin': false,
        'deleteActionName': 'delete',
        'createActionName': 'create'
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
            var from, to;
            var activeUserItem = $('.user-block').find('.list-group-item.active');
            if (opts.isAdmin) {
                from = activeUserItem.data('from');
                to = activeUserItem.data('to');
            } else {
                from = opts.currentUserId;
                to = activeUserItem.data('id');
            }
            var data = JSON.parse(e.data);
            if (!!data.action) {
                if (data.action == opts.createActionName) {
                    var html = data.html;
                    var userIds = [$(html).data('to'), $(html).data('from')];
                    if ((userIds.indexOf(from) >= 0) && (userIds.indexOf(to) >= 0)) {
                        addMessageToChatBox(html);
                    } else {
                        var counterBlock;
                        if (opts.isAdmin) {
                            counterBlock = $('.user-block').find('.list-group-item[data-from="' + $(html).data('from') + '"][data-to="' + $(html).data('to') + '"]').find('.counter');
                            if (counterBlock.length == 0) {
                                counterBlock = $('.user-block').find('.list-group-item[data-to="' + $(html).data('from') + '"][data-from="' + $(html).data('to') + '"]').find('.counter');
                            }
                        } else {
                            counterBlock = $('.user-block').find('.list-group-item[data-id="' + $(html).data('from') + '"]').find('.counter');
                        }
                        var counter = counterBlock.text();
                        counterBlock.text(++counter);
                    }
                } else if (data.action == opts.deleteActionName) {
                    $('#chatMessages').find('.message-block[data-id="' + data.id + '"]').remove();
                }
            }


        };

        conn.onclose = function (event) {
            addMessageToChatBox("<br>Connection closed. Please, reload the page");
        };

        var addMessageToChatBox = function (message) {
            $("#chatMessages").append(message);
        }

        var send = function() {
            var messageText = $(self).val();
            var userTo = $(".user-block").find('.list-group-item.active').data('id');
            var message = JSON.stringify({message: messageText, userTo: userTo, action: opts.createActionName});
            conn.send(message);
            $(self).val("");
        }

        $('.user-block .list-group-item').on('click', function() {
            $('.user-block').find('.list-group-item.active').removeClass('active');
            $(this).addClass('active');
            $.get($(this).attr('href'))
                .done(function( data ) {
                    $("#chatMessages").html(data);
                    $('.user-block').find('.list-group-item.active').find('.counter').text('');
                    $('#message').removeAttr('disabled');
                    $('#send-btn').removeAttr('disabled');
                    $(self).val("")
                });
            return false;
        });

        $('#message').keyup(function(e) {
            if (e.keyCode == 13) {
               send();
            }
        });

        $('#chatMessages').on('click', '.glyphicon-remove', function() {
            var message = JSON.stringify({action: opts.deleteActionName, id: $(this).parents('.message-block').data('id')});
            conn.send(message);
        });

        $('#send-btn').on( "click", send);
    };
})(jQuery);