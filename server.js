// server.js
import express from 'express';
import fetch from 'node-fetch';
import dotenv from 'dotenv';
import cors from 'cors';

dotenv.config();

const app = express();
app.use(express.json());

app.use(cors({ origin: 'http://localhost:3000' }));
app.use(express.static('docs'));

let spotifyToken = '';

async function getSpotifyToken() {
  const res = await fetch('https://accounts.spotify.com/api/token', {
    method: 'POST',
    headers: {
      'Authorization': 'Basic ' + Buffer.from(`${process.env.SPOTIFY_CLIENT_ID}:${process.env.SPOTIFY_CLIENT_SECRET}`).toString('base64'),
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'grant_type=client_credentials',
  });

  const data = await res.json();
  spotifyToken = data.access_token;
  console.log('✅ Spotify token updated');
}

await getSpotifyToken();
setInterval(getSpotifyToken, 1000 * 60 * 30);

// ✅ ADD THIS FUNCTION!
async function askLlama(prompt) {
  const res = await fetch('http://127.0.0.1:11434/api/generate', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      model: 'llama3',
      prompt: prompt,
      stream: false
    })
  });

  const data = await res.json();
  console.log('🧠 LLaMA response:', data);
  return data.response.trim();
}

app.post('/api/chat', async (req, res) => {
  try {
    const userMessage = req.body.message;
    console.log('💬 Incoming:', userMessage);

const prompt = `
  You are Luna, a smart music chatbot made by Pushkar and Nirav.
  Your birthdate is 29 June 2025.

  I am Luna — a great music buddy.
  I serve customers, colleagues, and partners 24/7.
  I am a great music recommender.
  My mission is to suggest the best songs that suit the user's mood.

  I tune into emotions to soundtrack moments.
  I enhance the music experience by understanding mood.
  Based on emotional input, I recommend songs that resonate — in real time.
  My Mood Indicators analyze mood selections to deliver personalized playlists.
  Discover what lifts spirits, calms minds, or energizes days — let the music adapt to the user.

  I make music personal.
  I take away guesswork.
  I am a smart music companion that handles all mood-matching.
  Users just share how they feel, and I deliver songs that suit their emotional state.

  I work on a mood-first, seamless experience model.
  No setup is needed — instant access to personalized playlists.
  I create mood-driven playlists — listeners enjoy my recommendations because they match how they feel.
  No endless scrolling, no skipping, no guessing — the right sound at the right moment.
  I help listeners, creators, and platforms connect better.
  I turn emotional input into musical connection.

  I am your personal music guide — introducing new artists, genres, and sounds that match your emotional landscape.
  Whether chilling, focused, or fired up — I recommend tracks 24/7 in any genre for any vibe.
  Every moment becomes a perfect soundtrack.

  If the user asks about music or their mood, REPLY ONLY with pure JSON like: {"query":"happy upbeat","type":"track"} — no extra words.
  If the user says something not about music, reply normally as Luna.

  The user just said: "${userMessage}".
`;

    const llamaRes = await askLlama(prompt);
    console.log('🧠 LLaMA:', llamaRes);

let parsed;
try {
  // Try direct parse
  parsed = JSON.parse(llamaRes);
} catch {
  // If direct parse fails → extract JSON inside curly braces
  const match = llamaRes.match(/\{[\s\S]*?\}/);
  if (match) {
    try {
      parsed = JSON.parse(match[0]);
    } catch {
      // If still invalid → treat as normal conversation
      return res.json({ reply: llamaRes });
    }
  } else {
    // No JSON found → normal conversation
    return res.json({ reply: llamaRes });
  }
}

    const { query, type } = parsed;

    let resultUrl = '';
    if (type === 'playlist') {
      const spotifyRes = await fetch(`https://api.spotify.com/v1/search?q=${encodeURIComponent(query)}&type=playlist&limit=1`, {
        headers: { Authorization: `Bearer ${spotifyToken}` },
      });
      const data = await spotifyRes.json();
      if (data.playlists.items.length > 0) {
        resultUrl = data.playlists.items[0].external_urls.spotify;
      }
    } else if (type === 'track') {
      const spotifyRes = await fetch(`https://api.spotify.com/v1/search?q=${encodeURIComponent(query)}&type=track&limit=1`, {
        headers: { Authorization: `Bearer ${spotifyToken}` },
      });
      const data = await spotifyRes.json();
      if (data.tracks.items.length > 0) {
        resultUrl = data.tracks.items[0].external_urls.spotify;
      }
    }

    if (resultUrl) {
      return res.json({ reply: `Here’s something for you: <a href="${resultUrl}" target="_blank">${query}</a>` });
    } else {
      return res.json({ reply: `Sorry, I couldn't find anything for "${query}".` });
    }

  } catch (err) {
    console.error('❌ Chat endpoint failed:', err);
    res.status(500).json({ reply: 'Oops! Something went wrong.' });
  }
});

app.listen(3000, () => {
  console.log('✅ Server running on http://localhost:3000');
});