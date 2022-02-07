from flask import Flask, render_template, request
import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
import requests

if __name__ == "__main__":
    # Auth Spotify API
    client_credentials_manager = SpotifyClientCredentials(client_id='f6046cde45a54ae895dfea1dcf09aeb5',
                                                          client_secret='33e06b00af1a4cd69b7b9b0528ce4737')
    sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)

    # Serves variables to flask webserver
    app = Flask(__name__)
    @app.route('/')
    def index():
        return render_template('index.html')


    @app.route('/', methods=['POST'])
    def my_form_post():
        lz_uri = 'spotify:artist:6NJpuZla7aHLZEfMBSMcH8'  # Artist URI
        spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
        results = spotify.artist_top_tracks(lz_uri)
        for track in results['tracks'][:1]:
            urltrackName = track['name']
            urltrackMP3 = track['preview_url']
            urltrackAlbum = track['album']['images'][0]['url']

        # Saves obtained URLs into variables
        getTrackImg = requests.get(urltrackAlbum)
        getTrackMP3 = requests.get(urltrackMP3)

        # ---
        textboxInput = request.form['text']
        URIinput = textboxInput.upper()
        print(URIinput)
        return render_template('index.html', img=urltrackAlbum, mp3=urltrackMP3)


    app.run(host="::1", port=8080, debug=True)