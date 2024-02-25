<?php

namespace App\Http\Controllers;

use App\Models\DigitalAsset;
use App\Models\Category;
use App\Services\FilenameService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DigitalAssetController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    private $filenameService;

    public function __construct(FilenameService $filenameService)
    {
        $this->filenameService = $filenameService;
    }

    public function index(): Renderable
    {
        $digitalAssets = DigitalAsset::paginate(10);
        return view('digitalAssets.index', compact('digitalAssets'));
    }

    public function create() : Renderable
    {
        $categories = Category::all();
        return view('digitalAssets.create', compact('categories'));
    }

    public function edit($id) : Renderable
    {
        $asset = DigitalAsset::findOrFail($id);
        $categories = Category::all();
        return view('digitalAssets.edit', compact('asset', 'categories'));
    }

    public function view($id): Renderable
    {
        $digitalAsset = DigitalAsset::findOrFail($id);
        return view('digitalAssets.view', compact('digitalAsset'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'alt_text' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $digitalAsset = DigitalAsset::findOrFail($id);
        $digitalAsset->title = $request->title;
        $digitalAsset->caption = $request->caption;
        $digitalAsset->alt_text = $request->alt_text;
        $digitalAsset->language = $request->language;
        $digitalAsset->category_id = $request->category_id;

        if ($request->hasFile('filename')) {
            $file = $request->file('filename');
            $filename = $this->filenameService->generateUniqueFilename($file);
            $savedFile = $file->storeAs('public/digitalAssets', $filename);
            $digitalAsset->filename = $savedFile;
        }

        $digitalAsset->save();
        return redirect()->route('digitalAssets.view', $digitalAsset->id)->with('success', 'Digital Asset created successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'alt_text' => 'required',
            'filename' => 'required|file',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle the file upload
        if ($request->hasFile('filename')) {

            print($request->category_id);

            $file = $request->file('filename');
            $filename = $this->filenameService->generateUniqueFilename($file);
            $savedFile = $file->storeAs('public', $filename);

            $digitalAsset = new DigitalAsset([
                'title' => $request->title,
                'filename' => $savedFile,
                'caption' => $request->caption,
                'alt_text' => $request->alt_text,
                'language' => $request->language,
                'category_id' => $request->category_id,
            ]);

            $digitalAsset->save();
            return redirect()->route('digitalAssets.view', $digitalAsset->id)->with('success', 'Digital Asset created successfully.');
        }

        return back()->withInput()->withErrors(['filename' => 'File upload failed.']);
    }
}
