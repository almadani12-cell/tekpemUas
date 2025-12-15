<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Pillar;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display the materi index page with type selection.
     */
    public function index()
    {
        $pillars = Pillar::orderBy('order')->get();
        
        return view('materi.index', compact('pillars'));
    }

    /**
     * Display material content for a specific pillar and type.
     */
    public function show(Pillar $pillar, string $type)
    {
        if (!in_array($type, ['text', 'video'])) {
            abort(404);
        }

        // Check if content file exists
        $contentPath = "materi.content.{$type}.{$pillar->slug}";
        if (!view()->exists($contentPath)) {
            // Fallback to empty materials if content file doesn't exist yet
            $materials = collect([]);
            $allPillars = Pillar::orderBy('order')->get();
            return view('materi.show', compact('pillar', 'materials', 'type', 'allPillars'));
        }

        $allPillars = Pillar::orderBy('order')->get();
        $hasContent = true;
        
        return view('materi.show', compact('pillar', 'type', 'allPillars', 'hasContent', 'contentPath'));
    }

    /**
     * Display CP & TP page.
     */
    public function cptp()
    {
        $pillars = Pillar::orderBy('order')->get();
        
        return view('materi.cptp', compact('pillars'));
    }
}
