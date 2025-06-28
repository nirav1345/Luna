// script.js
const form = document.getElementById('email-form');
const input = document.getElementById('Chat');
const chatBody = document.querySelector('.chatbody');

form.addEventListener('submit', async function (e) {
  e.preventDefault(); // Stop normal form submit

  const userMessage = input.value.trim();
  if (!userMessage) return;

  // Add user message to chat
  chatBody.innerHTML += `
    <div class="chattext_user">
      <h2 class="chattext user">${userMessage}</h2>
      <div class="avatar user">
        <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f21a7dbff29407b17327d46_UserAvatar.svg" alt="">
      </div>
    </div>
  `;

  input.value = ''; // clear input

  // Call your Node backend
  const res = await fetch('/api/chat', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ message: userMessage })
  });

  const data = await res.json();

  // Add Luna's reply
  let replyHTML = '<div class="chattext_bot"><div class="avatar bot"><img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd03f3d83094e45ca0dc53_BrandScotty_Symbol.svg" alt=""></div><h2 class="chattext bot">';

  if (data.playlists && data.playlists.length) {
    replyHTML += "Here are some playlists for you:<br>";
    data.playlists.forEach(p => {
      replyHTML += `<a href="${p.url}" target="_blank">${p.name}</a><br>`;
    });
  } else {
    replyHTML += "Sorry, I couldn't find any playlists right now.";
  }

  replyHTML += '</h2></div>';
  chatBody.innerHTML += replyHTML;

  // Scroll to bottom if needed
  chatBody.scrollTop = chatBody.scrollHeight;
});