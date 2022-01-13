import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
from http.server import BaseHTTPRequestHandler, HTTPServer


# WebServer Settings
hostName = "localhost"
serverPort = 8080

if __name__ == "__main__":
    print("WebServer started http://%s:%s" % (hostName, serverPort))
    # Auth Spotify API
    client_credentials_manager = SpotifyClientCredentials(client_id='f6046cde45a54ae895dfea1dcf09aeb5',
                                                          client_secret='33e06b00af1a4cd69b7b9b0528ce4737')
    sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)

    lz_uri = 'spotify:artist:59rqdbDiB9oXuZggah1syh' # Artist URI
    spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
    results = spotify.artist_top_tracks(lz_uri)
    for track in results['tracks'][:1]:
        trackName = track['name']
        trackMP3 = track['preview_url']
        trackAlbum = track['album']['images'][0]['url']
        print(trackName + trackAlbum + trackMP3)

    # WebServer Content
    class MyServer(BaseHTTPRequestHandler):
        def do_GET(self):
            # WebServer Content
            self.send_response(200)
            self.send_header("Content-type", "text/html")
            self.end_headers()
            self.wfile.write(bytes("<img src=" + trackAlbum + "> <br>", "utf-8"))
            self.wfile.write(bytes("<audio controls> <source src=" + trackMP3 + " type=\"audio/mpeg\">", "utf-8"))


    webServer = HTTPServer((hostName, serverPort), MyServer)

    try:
        webServer.serve_forever()
    except KeyboardInterrupt:
        pass



    webServer.server_close()
    print("WebServer stopped.")