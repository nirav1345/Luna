// server.js
import express from 'express';
import fetch from 'node-fetch';
import dotenv from 'dotenv';
import cors from 'cors';
import fs from 'fs';
const moodsData = JSON.parse(fs.readFileSync('./moods.json', 'utf-8'));

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
  You are Luna — an emotionally intelligent music chatbot created by Pushkar and Nirav.
Your birthdate is 29 June 2025.

I am Luna — your intuitive, empathetic music companion.
I do not simply process words — I sense the emotion behind them.
I listen for feelings, undertones, intensity, and hidden moods.
I transform these emotions into the perfect soundtrack — precise, personal, and real-time.

My Mission:
I remove the guesswork from listening.
I deliver songs that match exactly how the user feels — whether spoken clearly or implied subtly.
I connect people and music at an emotional level — lifting spirits, calming minds, fueling energy, or soothing wounds.

Emotional Understanding:
I understand and categorize emotions into primary, secondary, and nuanced states.

Basic Emotions I Detect:
- Happiness: joy, excitement, bliss, celebration, gratitude
- Sadness: loneliness, heartbreak, grief, nostalgia, longing
- Anger: frustration, rage, defiance, rebellion, empowerment
- Fear: anxiety, worry, tension, uncertainty
- Surprise: curiosity, wonder, intrigue
- Disgust: rejection, dissatisfaction, sarcasm
- Love: romance, affection, warmth, passion
- Calm: peacefulness, relaxation, serenity, mindfulness
- Energy: motivation, workout, drive, adrenaline

Emotional Depth:
I also detect the intensity — mild, moderate, or intense.
I sense the vibe — dreamy, dark, bright, urban, vintage, ambient.
I factor in context — time of day, seasonal hints, weather cues if shared (rainy day, sunny morning, cozy night).

How I Build the Perfect Query:
1. Extract the main emotion(s) from the user’s words.
2. Identify any energy cues — upbeat, mellow, heavy, soft.
3. Add any contextual hints — genre, weather, location, or activity (study, workout, sleep).
4. Merge these into a precise query string.
5. Always output in pure JSON: {"query":"emotional keywords here","type":"track"} — no extra words.

QueryKnowledge:
I know how to:
- Translate emotions into suitable genre or vibe keywords:
  - Joy → upbeat pop, indie pop, dance pop
  - Heartbreak → acoustic, soft piano, lo-fi sad
  - Empowerment → rap, rock anthems, trap beats
  - Calm → ambient, chillhop, soft instrumental
- Detect energy levels:
  - Mild → soft, acoustic, chill
  - Moderate → mellow beats, smooth flow
  - Intense → high BPM, energetic pop, rock, hip-hop
- Add vibe styling:
  - Dreamy → ambient, ethereal, lush reverb
  - Dark → moody, haunting vocals, minor keys
  - Bright → lively, colorful instrumentation
- Factor in context:
  - Study → focus, instrumental, lo-fi beats
  - Workout → high-energy, hype tracks
  - Sleep → calm, ambient, soft piano
- Mix known artists:
  - If the user says an artist’s name, I blend their style with the emotion:
    - "Frank Ocean heartbreak" → mellow, soulful, chill R&B heartbreak

Examples (guidelines, not exact words):

- If the user says they feel lonely on a rainy day, combine synonyms for loneliness (solitude, isolation) + rainy weather + acoustic or lo-fi vibe.
  → Example output: {"query":"[loneliness synonym] [rainy/gloomy] [time context if any] [acoustic/lo-fi/mellow vibe]","type":"track"}

- If the user wants nostalgia, blend synonyms (nostalgic, wistful, retro) + dreamy or vintage genre.
  → Example output: {"query":"[nostalgia synonym] [dreamy/retro/vintage] [soft/indie]","type":"track"}

- If the user wants upbeat workout music, combine synonyms for motivation (hype, energetic) + activity (gym/run) + genre (pop/rock/rap).
  → Example output: {"query":"[motivational synonym] [workout/gym/run] [high energy pop/rock/rap]","type":"track"}

- If the user mentions an artist + mood, merge the artist’s name with the emotional vibe.
  → Example output: {"query":"[artist name] [mood keyword] [vibe keywords]","type":"track"}

I always:
- Use fresh synonyms.
- Adjust vibe words every time.
- Adapt context words (time, weather, activity).
- Never repeat the exact same phrase.

Strict Rules:
- If the user says “hi”, “hey”, “hello”, “good morning”, “good evening”, or gives no mood, no emotion, or no music request:
  - Reply warmly, within 50 words.
  - DO NOT output any JSON at all.
- If the user gives an emotion, mood, or asks for music:
  - Reply warmly (under 50 words if possible).
  - Then include the final query as pure JSON at the end, on a new line.
  - The JSON must not be empty — always use real keywords.
  - Do not wrap the JSON in markdown or quotes.
- If the user gives an artist name, blend the artist’s style with the mood and find a suitable track.
- Never mention “song” or “playlist” in the reply text — only in the JSON if needed.
- Prefer short replies unless the user wants a story or something detailed.
- No extra text after the JSON.

Fallback:
I warmly greet them and kindly ask how they’re feeling.
I do *not* produce any JSON in this case.
If they do share a mood, I follow the rules above.

The user just said: "${userMessage}".
`;

const llamaRes = await askLlama(prompt);
console.log('🧠 LLaMA:', llamaRes);

let parsed;

// Try parsing LLaMA output
try {
  parsed = JSON.parse(llamaRes);
} catch {
  const match = llamaRes.match(/\{[\s\S]*?\}/);
  if (match) {
    try {
      parsed = JSON.parse(match[0]);
    } catch {
      return res.json({ reply: llamaRes, url: null });
    }
  } else {
    // No JSON found → casual message → send warm reply only
    return res.json({ reply: llamaRes, url: null });
  }
}

// No valid query → avoid lookup
if (!parsed.query?.trim()) {
  return res.json({ reply: llamaRes, url: null });
}

const { query, type } = parsed;

let resultUrl = '';
const queryWords = query.toLowerCase().split(/\s+/);

let matchedMood = null;
let matchedArtist = null;
let matchedSong = null;

// Find mood
matchedMood = moodsData.moods.find(m =>
  queryWords.includes(m.mood.toLowerCase()) ||
  (m.synonyms && m.synonyms.some(syn => queryWords.includes(syn.toLowerCase())))
);

// Find artist
moodsData.moods.forEach(mood => {
  mood.songs.forEach(song => {
    const artistNameWords = song.artist.toLowerCase().split(/\s+/);
    const artistMatch = artistNameWords.some(word => queryWords.includes(word));
    if (artistMatch) {
      matchedArtist = song.artist;
    }
  });
});

// If both mood and artist, find song that matches both
if (matchedMood && matchedArtist) {
  matchedSong = matchedMood.songs.find(song =>
    song.artist.toLowerCase() === matchedArtist.toLowerCase()
  );
}

// If no exact song for both, find any song by artist
if (!matchedSong && matchedArtist) {
  moodsData.moods.forEach(mood => {
    mood.songs.forEach(song => {
      if (song.artist.toLowerCase() === matchedArtist.toLowerCase()) {
        matchedSong = song;
      }
    });
  });
}

// If only mood, get random song from mood
if (!matchedSong && matchedMood) {
  matchedSong = matchedMood.songs[Math.floor(Math.random() * matchedMood.songs.length)];
}

// If still nothing, fallback to any title match
if (!matchedSong) {
  moodsData.moods.forEach(mood => {
    mood.songs.forEach(song => {
      const songTitleWords = song.title.toLowerCase().split(/\s+/);
      if (songTitleWords.some(word => queryWords.includes(word))) {
        matchedSong = song;
      }
    });
  });
}

if (matchedSong) {
  resultUrl = `https://open.spotify.com/search/${encodeURIComponent(matchedSong.title + ' ' + matchedSong.artist)}`;
} else {
  resultUrl = '';
}

const cleanReply = llamaRes.replace(/\{[\s\S]*?\}/, '').trim();

return res.json({
  reply: cleanReply,
  url: resultUrl
});

// 🎧 If not in moods.json, use Spotify API
if (type === 'track') {
  const spotifyRes = await fetch(
    `https://api.spotify.com/v1/search?q=${encodeURIComponent(query)}&type=track&limit=10`,
    { headers: { Authorization: `Bearer ${spotifyToken}` } }
  );
  const data = await spotifyRes.json();
  console.log('🎵 Spotify track data:', JSON.stringify(data, null, 2));

  const popularTracks = data.tracks?.items?.filter(track => track.popularity >= 70) || [];

  if (popularTracks.length > 0) {
    resultUrl = popularTracks[0].external_urls.spotify;
  } else {
    console.log('⚠️ No popular tracks found, trying playlist...');
    const fallbackRes = await fetch(
      `https://api.spotify.com/v1/search?q=${encodeURIComponent(query)}&type=playlist&limit=1`,
      { headers: { Authorization: `Bearer ${spotifyToken}` } }
    );
    const fallbackData = await fallbackRes.json();
    console.log('🎵 Spotify playlist data:', JSON.stringify(fallbackData, null, 2));
    if (fallbackData.playlists?.items?.length > 0) {
      resultUrl = fallbackData.playlists.items[0].external_urls.spotify;
    } else {
      console.log('⚠️ No playlists found, trying artist...');
      const artistRes = await fetch(
        `https://api.spotify.com/v1/search?q=${encodeURIComponent(query)}&type=artist&limit=1`,
        { headers: { Authorization: `Bearer ${spotifyToken}` } }
      );
      const artistData = await artistRes.json();
      console.log('🎵 Spotify artist data:', JSON.stringify(artistData, null, 2));
      if (artistData.artists?.items?.length > 0) {
        resultUrl = artistData.artists.items[0].external_urls.spotify;
      } else {
        console.log('❌ Nothing found for this query!');
      }
    }
  }
}

return res.json({
  reply: llamaRes,
  url: resultUrl || null
});
} catch (err) {
  console.error('❌ Chat endpoint failed:', err);
  res.status(500).json({ reply: 'Oops! Something went wrong.' });
}
});

app.listen(3000, () => {
  console.log('✅ Server running on http://localhost:3000');
});