<script src="/template/client/js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="/template/client/js/plugins.js"></script>
<script src="/template/client/js/script.js"></script>
<script>
    document.getElementById('category-select').addEventListener('change', function() {
        const selectedValue = this.value;
        if (selectedValue) {
            window.location.hash = selectedValue;
        }
    });
</script>
<script>
    function toggleChat() {
        const chatbox = document.getElementById('chatbox');
        if (chatbox.style.display === 'none' || chatbox.style.display === '') {
            chatbox.style.display = 'block';
            $('#chat-box').append('<div class="message ai-message">' + message + '</div>');
        } else {
            chatbox.style.display = 'none';
        }
    }

    $(document).ready(function() {
        $('#user-message').on('keypress', function(e) {
            if (e.which === 13) { // Kiểm tra nếu người dùng nhấn phím Enter (keyCode 13)
                e.preventDefault();
                sendMessage();
            }
        });

        $('#send-button').on('click', function() {
            sendMessage();
        });

        function sendMessage() {
            const message = $('#user-message').val();
            if (message.trim() === '') return;

            $('#chat-box').append('<div class="message user-message">' + message + '</div>');
            $('#user-message').val('');
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);

            $.ajax({
                url: '{{ route("chat.send") }}',
                type: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#chat-box').append('<div class="message ai-message">' + response.response + '</div>');
                    } else {
                        $('#chat-box').append('<div class="message ai-message">Có lỗi xảy ra. Vui lòng thử lại!</div>');
                    }
                    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                },
                error: function() {
                    $('#chat-box').append('<div class="message ai-message">Vui lòng đăng nhập để thực hiện tính năng này!</div>');
                    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                }
            });
        }
    });


    function clearHistory() {
        $.ajax({
            url: '{{ route("chat.clearHistory") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                $('#chat-box').empty();
            },
            error: function() {
                alert('Có lỗi xảy ra khi xóa lịch sử!');
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            url: '{{ route("chat.history") }}',
            type: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    const messages = response.messages;

                    messages.forEach(msg => {
                        if (msg.role === 'user') {
                            $('#chat-box').append('<div class="message user-message">' + msg.content + '</div>');
                        } else if (msg.role === 'assistant') {
                            $('#chat-box').append('<div class="message ai-message">' + msg.content + '</div>');
                        }
                    });
                }
            },
            error: function() {
                console.error('Không thể tải lịch sử chat.');
            }
        });
    });
</script>