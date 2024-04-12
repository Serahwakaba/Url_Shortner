<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * @var User $user;
         */
        $user = auth()->user();
        $urls = $user->urls()
            ->orderBy('created_at')
            ->get();

        $prefix = \url('') . '/url/show/';

        return Inertia::render('Urls/Index', [
            'urls' => $urls,
            'prefix' => $prefix,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Urls/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $validated = $request->validated();
        $curr = auth()->user()->urls()->firstWhere('original_url', $validated['original_url']);
        if($curr){
            /**
             * If the url is already created, we can ignore it.
             */
            return redirect(route('url.index'));
        }

        $hash = substr(md5($validated['original_url']), 0, 6);
        auth()->user()->urls()->create([
            'name' => $validated['name'],
            'original_url' => $validated['original_url'],
            'short_url' => $hash,
        ]);

        return redirect(route('url.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        return Inertia::render('Urls/Edit', [
            'url' => $url
        ]);
    }


    public function shortLink(Request $request, string $hash)
    {
        $url = Url::query()->firstWhere('short_url', $hash);
        return redirect($url->original_url);
    }
}
