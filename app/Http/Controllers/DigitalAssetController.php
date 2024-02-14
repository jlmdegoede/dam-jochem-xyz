<?php

namespace App\Http\Controllers;

use App\Models\DigitalAsset;
use App\Models\Category;
use Illuminate\Http\Request;

class DigitalAssetController extends Controller
{
    public function index()
    {
        $digitalAssets = DigitalAsset::paginate(10); // Adjust the number per page as needed
        return view('digitalAssets.index', compact('digitalAssets'));
    }

    public function create() {
        $categories = Category::all(); // Assuming you want to list categories in your form.
        return view('digitalAssets.create', compact('categories'));
    }

    /**
     * Store a newly created digital asset in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'filename' => 'required|file',
            'category_id' => 'required|exists:categories,id',
            // Add other fields as necessary
        ]);

        // Handle the file upload
        if ($request->hasFile('filename')) {
            $filename = $request->file('filename')->store('public/digitalAssets');

            // Create a new digital asset record
            $digitalAsset = new DigitalAsset([
                'title' => $request->title,
                'filename' => $filename, // Store the path of the uploaded file
                'caption' => $request->caption,
                'alt_text' => $request->alt_text,
                'language' => $request->language,
                'category_id' => $request->category_id,
            ]);

            $digitalAsset->save();

            // Redirect or show a success message
            return redirect()->route('digitalAssets.create')->with('success', 'Digital Asset created successfully.');
        }

        // Handle failure
        return back()->withInput()->withErrors(['filename' => 'File upload failed.']);
    }
}
