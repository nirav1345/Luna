import express from 'express';
import fetch from 'node-fetch';
import OpenAI from 'openai';
import dotenv from 'dotenv';

dotenv.config();

const app = express();
app.use(express.json());
app.use(express.static('docs')); // serve index.html + script.js

const openai = new OpenAI({
  apiKey: process.env.OPENAI_API_KEY,
});

// Get Spotify Token
let spotifyToken = '';

async function getSpotifyToken() {
  const res = await fetch('https://accounts.spotify.com/api/token', {
    method: 'POST',
    headers: {
      'Authorization': 'Basic ' + Buffer.from(`${process.env.SPOTIFY_CLIENT_ID}:${process.env.SPOTIFY_CLIENT_SECRET}`).toString('base64'),
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: 'grant_type=client_credentials'
  });

  const data = await res.json();
  spotifyToken = data.access_token;
  console.log("Spotify token updated");
}

await getSpotifyToken();

// Chat endpoint
app.post('/api/chat', async (req, res) => {
  const userMessage = req.body.message;

  // Get mood query from OpenAI
  const aiResponse = await openai.chat.completions.create({
    model: "gpt-4o",
    messages: [
      {
        role: "system",
        content: "You help detect mood and generate a Spotify search query."
      },
      {
        role: "user",
        content: `User says: "${userMessage}". Reply ONLY with a short search term I can use for Spotify.`
      }
    ],
  });

  const moodQuery = aiResponse.choices[0].message.content.trim();
  console.log("AI Query:", moodQuery);

  // Use Spotify Search API
  const spotifyRes = await fetch(`https://api.spotify.com/v1/search?q=${encodeURIComponent(moodQuery)}&type=playlist&limit=3`, {
    headers: {
      'Authorization': `Bearer ${spotifyToken}`
    }
  });

  const data = await spotifyRes.json();

  const playlists = data.playlists.items.map(item => ({
    name: item.name,
    url: item.external_urls.spotify
  }));

  res.json({ playlists, moodQuery });
});

app.listen(3000, () => {
  console.log("✅ Luna AI server running on http://localhost:3000");
});