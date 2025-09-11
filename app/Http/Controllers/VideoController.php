<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $channelId = "UCiwetwoH0TC_OOJN1XBBb4g"; // ganti dengan channel ID YouTube
        $feedUrl   = "https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}";

        $response = Http::get($feedUrl);

        if ($response->ok()) {
            $xml = simplexml_load_string($response->body());
            $videos = [];

            foreach ($xml->entry as $entry) {
                $videos[] = [
                    'title'     => (string) $entry->title,
                    'link'      => (string) $entry->link['href'],
                    'published' => (string) $entry->published,
                ];
            }

            // filter search
            if ($request->has('q')) {
                $query = strtolower($request->q);
                $videos = array_filter($videos, function ($video) use ($query) {
                    return str_contains(strtolower($video['title']), $query);
                });
            }

            // 👉 kalau request API (Postman / fetch / axios)
            if ($request->wantsJson() || $request->query('json') == 1) {
                return response()->json([
                    'status' => 'success',
                    'count'  => count($videos),
                    'videos' => array_values($videos),
                ], 200);
            }

            // 👉 default: tampilkan view Blade
            return view('videos.index', ['videos' => $videos]);
        }

        // error handling
        if ($request->wantsJson() || $request->query('json') == 1) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal ambil data video'
            ], 500);
        }

        return "Gagal ambil data video.";
    }
}
