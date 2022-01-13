import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
client_credentials_manager = SpotifyClientCredentials(client_id='f6046cde45a54ae895dfea1dcf09aeb5',
                                                      client_secret='33e06b00af1a4cd69b7b9b0528ce4737')
sp = spotipy.Spotify(client_credentials_manager = client_credentials_manager)
