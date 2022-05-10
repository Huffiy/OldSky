from flask import Flask, render_template, request
import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
import json

if __name__ == "__main__":
    # Auth Spotify API
    client_credentials_manager = SpotifyClientCredentials(client_id='f6046cde45a54ae895dfea1dcf09aeb5',
                                                          client_secret='33e06b00af1a4cd69b7b9b0528ce4737')
    sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)

    # Serves variables to flask webserver
    app = Flask(__name__)

    @app.route('/artistname', methods=['GET'])
    def searchTrack():
        artistImgURL = "None"
        artistTrackURL = "None"
        artistURI = "None"
        textboxInput = request.args.get('artistName')

        searchInput = textboxInput
        spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
        results = spotify.search(q='artist:' + searchInput, type='artist')
        items = results['artists']['items']
        if len(items) > 0:
            artist = items[0]
            artistImgURL = artist['images'][0]['url']
            artistURI = artist['uri']
            results_uri = spotify.artist_top_tracks(artistURI)

            searchResultsOut = []
            for track in results_uri['tracks'][:10]:
                searchResultsOut.append([track['name']])
                artistTrackURL = track['preview_url']
        # ---
        return format(artistTrackURL)
        # return render_template('index.html', img=artistImgURL, mp3=artistTrackURL, searchResults=searchResultsOut)

    @app.route('/songsearch', methods=['GET'])
    def searchArtist():
        artistsearchgetinput = request.args.get('artistsearch')
        spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
        results = spotify.search(q='track:' + artistsearchgetinput, type='track')

        # search tracks
        searchResultsOut = {}
        for track in results['tracks']['items'][:1]:
            trackName = track['name']
            trackMP3 = track['preview_url']
            trackImg = track['album']['images'][0]['url']
            searchResultsOut = '{"trackName": "' + trackName + '","trackMP3": "' + trackMP3 + '", "trackImg": "' + trackImg + '"}'
        
        return format(searchResultsOut)

    app.run(host="::1", port=8080, debug=True) 