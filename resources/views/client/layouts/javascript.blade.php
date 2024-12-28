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
            chatbox.style.display = 'block'; // Hiển thị chatbox
        } else {
            chatbox.style.display = 'none'; // Ẩn chatbox
        }
    }

    function sendMessage() {
        const message = $('#user-message').val();
        if (message.trim() === '') return;

        // Thêm tin nhắn của người dùng
        $('#chat-box').append('<div class="message user-message">' + message + '</div>');
        $('#user-message').val('');
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);

        // Gửi tin nhắn đến server
        $.ajax({
            url: '{{ route("chat.send") }}',
            type: 'POST',
            data: {
                message: message,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Thêm tin nhắn của AI
                    $('#chat-box').append('<div class="message ai-message">' + response.response + '</div>');
                } else {
                    $('#chat-box').append('<div class="message ai-message">Có lỗi xảy ra. Vui lòng thử lại!</div>');
                }
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            },
            error: function() {
                $('#chat-box').append('<div class="message ai-message">Có lỗi xảy ra. Vui lòng thử lại!</div>');
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    }
    
</script>