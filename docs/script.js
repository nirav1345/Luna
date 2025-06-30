// Script.js
const form = document.getElementById('email-form');
const input = document.getElementById('Chat');
const chatBody = document.querySelector('.chatbody');

form.addEventListener('submit', async function (e) {
  e.preventDefault();

  const userMessage = input.value.trim();
  if (!userMessage) return;

  // ✅ User bubble
  const userBubble = document.createElement('div');
  userBubble.className = 'chattext_user';
  userBubble.style.display = 'flex';
  userBubble.innerHTML = `
    <h2 class="chattext user">${userMessage}</h2>
    <div class="avatar user">
      <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f21a7dbff29407b17327d46_UserAvatar.svg" alt="User Avatar">
    </div>
  `;
  chatBody.appendChild(userBubble);
  input.value = '';

  // ✅ Bot bubble
  const botBubble = document.createElement('div');
  botBubble.className = 'chattext_bot';
  botBubble.innerHTML = `
    <div class="avatar bot">
      <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd03f3d83094e45ca0dc53_BrandScotty_Symbol.svg" alt="Bot Avatar">
    </div>
    <h2 class="chattext bot">...</h2>
  `;
  chatBody.appendChild(botBubble);

  const botText = botBubble.querySelector('h2');

  try {
    const baseURL = window.location.hostname === 'localhost'
      ? 'http://localhost:3000'
      : 'https://luna-9xcx.onrender.com';

    const res = await fetch(`${baseURL}/api/chat`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: userMessage }),
    });

    if (!res.ok) {
      throw new Error(`Server error ${res.status}`);
    }

    const data = await res.json();

// ✅ Smart reply
if (data.reply && data.url) {
  botText.innerHTML = `
    ${data.reply}<br>
    <a href="${data.url}" target="_blank">${data.url}</a>
  `;
} else if (data.reply) {
  botText.innerHTML = data.reply;
} else if (data.url) {
  botText.innerHTML = `
    Here’s your song!<br>
    <a href="${data.url}" target="_blank">${data.url}</a>
  `;
} else {
  botText.textContent = `Sorry, I didn't understand that.`;
}

  } catch (err) {
    console.error('❌ Client error:', err);
    botText.textContent = `Oops! Something went wrong. Try again later.`;
  }

  // ✅ Scroll to bottom
  chatBody.scrollTop = chatBody.scrollHeight;
});