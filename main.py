import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
import requests

if __name__ == "__main__":
    # Auth Spotify API
    client_credentials_manager = SpotifyClientCredentials(client_id='f6046cde45a54ae895dfea1dcf09aeb5',
                                                          client_secret='33e06b00af1a4cd69b7b9b0528ce4737')
    sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)

    lz_uri = 'spotify:artist:6NJpuZla7aHLZEfMBSMcH8' # Artist URI
    spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
    results = spotify.artist_top_tracks(lz_uri)
    for track in results['tracks'][:1]:
        urltrackName = track['name']
        urltrackMP3 = track['preview_url']
        urltrackAlbum = track['album']['images'][0]['url']

        # Save files to /downloads directory
        getTrackImg = requests.get(urltrackAlbum)
        getTrackMP3 = requests.get(urltrackMP3)
        open('downloads/img/r.png', 'wb').write(getTrackImg.content)
        open('downloads/mp3/r.mp3', 'wb').write(getTrackMP3.content)