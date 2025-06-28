const form = document.getElementById('email-form');
const input = document.getElementById('Chat');
const chatBody = document.querySelector('.chatbody');

form.addEventListener('submit', async function (e) {
  e.preventDefault();

  const userMessage = input.value.trim();
  if (!userMessage) return;

  // ✅ Create user bubble container
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

  // ✅ Create bot bubble container
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
    const res = await fetch('https://luna-9xcx.onrender.com/api/chat', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: userMessage }),
    });

    if (!res.ok) {
      throw new Error(`Server error ${res.status}`);
    }

    const data = await res.json();

    if (data.playlists && data.playlists.length > 0) {
      botText.innerHTML = `Here are some playlists for you:<br>`;
      data.playlists.forEach((p) => {
        botText.innerHTML += `<a href="${p.url}" target="_blank">${p.name}</a><br>`;
      });
    } else {
      botText.textContent = `Sorry, no playlists found.`;
    }
  } catch (err) {
    console.error('❌ Client error:', err);
    botText.textContent = `Oops! Something went wrong. Try again later.`;
  }

  // ✅ Auto-scroll to newest message
  chatBody.scrollTop = chatBody.scrollHeight;
});