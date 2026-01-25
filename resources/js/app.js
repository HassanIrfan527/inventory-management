document.addEventListener('livewire:init', () => {
        const scrollToBottom = () => {
             const container = document.getElementById('chat-container');
             if (container) {
                 container.scrollTop = container.scrollHeight;
             }
        };

        Livewire.on('messageSent', () => { setTimeout(scrollToBottom, 50); });

        // Initial scroll
        setTimeout(scrollToBottom, 100);

        // Observer for new messages
        const container = document.getElementById('chat-container');
        if (container) {
            const observer = new MutationObserver(scrollToBottom);
            observer.observe(container, { childList: true, subtree: true });
        }
    });
