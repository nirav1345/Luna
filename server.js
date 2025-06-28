import express from 'express';
import fetch from 'node-fetch';
import dotenv from 'dotenv';

dotenv.config();

const app = express();
app.use(express.json());
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

app.post('/api/chat', async (req, res) => {
  try {
    console.log('💬 Incoming:', req.body.message);

    const moodQuery = 'chill lofi'; // hardcoded for test
    console.log('🎵 Mood Query:', moodQuery);

    const spotifyRes = await fetch(
      `https://api.spotify.com/v1/search?q=${encodeURIComponent(moodQuery)}&type=playlist&limit=3`,
      {
        headers: {
          Authorization: `Bearer ${spotifyToken}`,
        },
      }
    );

    const spotifyData = await spotifyRes.json();
    console.log('👉 Spotify Status:', spotifyRes.status);
    console.log('👉 Spotify raw:', spotifyData);

    if (!spotifyData.playlists) {
      console.log('❌ Spotify API returned no playlists:', spotifyData);
      return res.status(500).json({ playlists: [], moodQuery, error: 'Spotify API error' });
    }

    const playlists = spotifyData.playlists.items
      .filter(item => item !== null && item !== undefined)
      .map(item => ({
        name: item.name,
        url: item.external_urls.spotify
      }));

    console.log('✅ Playlists:', playlists);

    res.json({ playlists, moodQuery });

  } catch (err) {
    console.error('❌ Chat endpoint failed:', err);
    res.status(500).json({ playlists: [], moodQuery: '', error: 'Server error' });
  }
});

app.listen(3000, () => {
  console.log('✅ Server running on http://localhost:3000');
});