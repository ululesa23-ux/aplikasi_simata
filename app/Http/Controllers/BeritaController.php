<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function getNews(Request $request)
    {
        // Kalau request minta JSON (misalnya Postman / fetch API)
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'url' => 'https://www.detik.com/edu'
            ]);
        }

        // Kalau diakses via browser, langsung redirect ke website
        return redirect()->away('https://www.detik.com/edu');
    }
}
