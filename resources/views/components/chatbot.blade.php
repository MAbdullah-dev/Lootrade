<style>
#chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
}

.chatbot-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.chatbot-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 380px;
    max-width: calc(100vw - 40px);
    height: 500px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-window.active {
    display: flex;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbot-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
}

.chatbot-close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.2s;
}

.chatbot-close-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: #f8f9fa;
}

.chatbot-message {
    margin-bottom: 16px;
    display: flex;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message-content {
    max-width: 80%;
    padding: 12px 16px;
    border-radius: 12px;
    line-height: 1.6;
    word-wrap: break-word;
    white-space: pre-wrap;
}

.bot-message .message-content {
    background: white;
    color: #333;
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
}

.user-message {
    justify-content: flex-end;
}

.user-message .message-content {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-bottom-right-radius: 4px;
}

.chatbot-input-area {
    display: flex;
    padding: 16px;
    background: white;
    border-top: 1px solid #e9ecef;
    gap: 8px;
}

.chatbot-input {
    flex: 1;
    border: 1px solid #dee2e6;
    border-radius: 24px;
    padding: 10px 16px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
}

.chatbot-input:focus {
    border-color: #667eea;
}

.chatbot-send-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s;
}

.chatbot-send-btn:hover {
    transform: scale(1.1);
}

.chatbot-send-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.chatbot-loading {
    padding: 10px 20px;
    background: white;
    border-top: 1px solid #e9ecef;
}

.typing-indicator {
    display: flex;
    gap: 4px;
    align-items: center;
}

.typing-indicator span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #667eea;
    animation: typing 1.4s infinite;
}

.typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes typing {
    0%, 60%, 100% {
        transform: translateY(0);
        opacity: 0.7;
    }
    30% {
        transform: translateY(-10px);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .chatbot-window {
        width: calc(100vw - 40px);
        height: 70vh;
        bottom: 80px;
    }
}
</style>

<div id="chatbot-container">
    <!-- Chatbot Toggle Button -->
    <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Open chatbot">
        <i class="fas fa-comments"></i>
    </button>

    <!-- Chatbot Window -->
    <div id="chatbot-window" class="chatbot-window">
        <!-- Header -->
        <div class="chatbot-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-robot me-2"></i>
                <span>Lootraiders Assistant</span>
            </div>
            <button id="chatbot-close" class="chatbot-close-btn" aria-label="Close chatbot">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Messages Container -->
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="chatbot-message bot-message">
                <div class="message-content">
                    👋 Welcome to Lootraiders! I'm here to help you with raffles, tickets, tasks, and more. What would you like to know?
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="chatbot-input-area">
            <input 
                type="text" 
                id="chatbot-input" 
                class="chatbot-input" 
                placeholder="Type your message..."
                maxlength="1000"
            >
            <button id="chatbot-send" class="chatbot-send-btn" aria-label="Send message">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>

        <!-- Loading Indicator -->
        <div id="chatbot-loading" class="chatbot-loading" style="display: none;">
            <div class="typing-indicator">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initChatbot);
    } else {
        initChatbot();
    }

    function initChatbot() {
        const chatbotToggle = document.getElementById('chatbot-toggle');
        const chatbotWindow = document.getElementById('chatbot-window');
        const chatbotClose = document.getElementById('chatbot-close');
        const chatbotInput = document.getElementById('chatbot-input');
        const chatbotSend = document.getElementById('chatbot-send');
        const chatbotMessages = document.getElementById('chatbot-messages');
        const chatbotLoading = document.getElementById('chatbot-loading');

        if (!chatbotToggle || !chatbotWindow) {
            console.error('Chatbot elements not found');
            return;
        }

        let conversationHistory = [];

        // Toggle chatbot window
        chatbotToggle.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Chatbot toggle clicked');
            chatbotWindow.classList.toggle('active');
            if (chatbotWindow.classList.contains('active')) {
                chatbotInput.focus();
            }
        });

        // Close chatbot
        chatbotClose.addEventListener('click', function(e) {
            e.preventDefault();
            chatbotWindow.classList.remove('active');
        });

        // Send message on button click
        chatbotSend.addEventListener('click', sendMessage);

        // Send message on Enter key
        chatbotInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        function sendMessage() {
            const message = chatbotInput.value.trim();
            if (!message) return;

            // Add user message to UI
            addMessage(message, 'user');
            chatbotInput.value = '';

            // Add to conversation history
            conversationHistory.push({
                role: 'user',
                content: message
            });

            // Show loading
            chatbotLoading.style.display = 'block';
            chatbotSend.disabled = true;

            // Send to backend
            fetch('/api/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message: message,
                    conversation_history: conversationHistory
                })
            })
            .then(response => response.json())
            .then(data => {
                chatbotLoading.style.display = 'none';
                chatbotSend.disabled = false;

                if (data.success && data.message) {
                    addMessage(data.message, 'bot');
                    conversationHistory.push({
                        role: 'assistant',
                        content: data.message
                    });
                } else {
                    addMessage('Sorry, I encountered an error. Please try again.', 'bot');
                }
            })
            .catch(error => {
                console.error('Chatbot error:', error);
                chatbotLoading.style.display = 'none';
                chatbotSend.disabled = false;
                addMessage('Sorry, I\'m having trouble connecting. Please try again later.', 'bot');
            });
        }

        function addMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `chatbot-message ${sender}-message`;
            
            const contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            
            // Format text with proper line breaks and structure
            const formattedText = text
                .replace(/\n/g, '<br>')
                .replace(/(\d+\.\s)/g, '<br>$1')
                .replace(/^<br>/, ''); // Remove leading break
            
            contentDiv.innerHTML = formattedText;
            
            messageDiv.appendChild(contentDiv);
            chatbotMessages.appendChild(messageDiv);
            
            // Scroll to bottom
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }
    }
})();
</script>
