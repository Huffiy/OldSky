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
        artistImgURL = "None"
        artistTrackURL = "None"
        artistURI = "None"
        textboxInput = request.form['text']
        searchInput = textboxInput
        spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
        results = spotify.search(q='artist:' + searchInput, type='artist')
        print(results)
        print("1")
        items = results['artists']['items']
        print("1")
        if len(items) > 0:
            print("1")
            artist = items[0]
            artistImgURL = artist['images'][0]['url']
            artistURI = artist['uri']

            print(artistURI)
            results_uri = spotify.artist_top_tracks(artistURI)
            for track in results_uri['tracks'][:1]:
                artistTrackURL = track['preview_url']
        # ---

        return render_template('index.html', img=artistImgURL, mp3=artistTrackURL)


    app.run(host="::1", port=8080, debug=True)