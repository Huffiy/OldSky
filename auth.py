import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
from http.server import BaseHTTPRequestHandler, HTTPServer


# WebServer Settings
hostName = "localhost"
serverPort = 8080

class MyServer(BaseHTTPRequestHandler):
    def do_GET(self):
        # WebServer Content
        self.send_response(200)
        self.send_header("Content-type", "text/html")
        self.end_headers()
        self.wfile.write(bytes("<h1>Test</h1>", "utf-8"))

if __name__ == "__main__":
    webServer = HTTPServer((hostName, serverPort), MyServer)
    print("WebServer started http://%s:%s" % (hostName, serverPort))
    # Auth Spotify API
    client_credentials_manager = SpotifyClientCredentials(client_id='f6046cde45a54ae895dfea1dcf09aeb5',
                                                          client_secret='33e06b00af1a4cd69b7b9b0528ce4737')
    sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)

    # Top 10 tracks of an artists (Includes cover + Link to MP3)
    lz_uri = 'spotify:artist:36QJpDe2go2KgaRleHCDTp' # Artist URI
    spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
    results = spotify.artist_top_tracks(lz_uri)
    for track in results['tracks'][:10]:
        print('track    : ' + track['name'])
        print('audio    : ' + track['preview_url'])
        print('cover art: ' + track['album']['images'][0]['url'])
        print()

    try:
        webServer.serve_forever()
    except KeyboardInterrupt:
        pass

    webServer.server_close()
    print("WebServer stopped.")