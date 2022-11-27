<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate(10);

        return view('banners.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'desc')
            ->pluck('title', 'id')->prepend('', '');

        return view('banners.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'url' => 'required|url',
            'media' => 'required|file|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,jpeg,png,jpg,gif,svg',
            'media_type' => 'required|in:image,video'
        ]);

        $banner = new Banner();

        if ($file = $request->file('media')) {
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            if (!Storage::disk('public')->put(Banner::BANNER_MEDIA_STORAGE_PATH . $filename, $file->getContent())) {
                return redirect()->back()->with('failure', 'There has been a problem saving the file');
            }

            $banner->file_path = $filename;
        }

        $banner->url = $request->get('url');
        $banner->file_type = $request->get('media_type');
        $banner->name = $request->get('name');
        $banner->original_name = $file->getClientOriginalName();

        $banner->save();

        return redirect()->route('banners.show', $banner)->with('success', 'Banner saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  Banner $banner
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Banner $banner)
    {
        return view('banners.show')->with('banner', $banner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Banner  $banner
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Banner  $banner
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'url' => 'required|url',
            'media' => 'sometimes|file|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,jpeg,png,jpg,gif,svg',
            'media_type' => 'required|in:image,video'
        ]);

        if ($file = $request->file('media')) {
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            if (!Storage::disk('public')->put(Banner::BANNER_MEDIA_STORAGE_PATH . $filename, $file->getContent())) {
                return redirect()->back()->with('failure', 'There has been a problem saving the file');
            }
            Storage::disk('public')->delete(Banner::BANNER_MEDIA_STORAGE_PATH . $banner->file_path);
            $banner->file_path = $filename;
        }

        $banner->name = $request->get('name');
        $banner->url = $request->get('url');
        $banner->file_type = $request->get('media_type');

        $banner->save();

        return redirect()->route('banners.show', $banner)->with('success', 'Banner updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Banner  $banner
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete(Banner::BANNER_MEDIA_STORAGE_PATH . $banner->file_path);
        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner ' . $banner->name . ' deleted.');
    }
}
