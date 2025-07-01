<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportManagementController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('generated_at', 'desc')->get();
        return view('admin.reports', compact('reports'));
    }

        public function generate(Request $request)
    {
        $type = $request->type;
        $data = [];
        $title = ucfirst($type) . ' Report';

        switch ($type) {
            case 'booking':
                $data = \App\Models\Booking::all();
                break;
            case 'guide':
                $data = \App\Models\User::where('role', 'guide')->get();
                break;
            case 'user':
                $data = \App\Models\User::where('role', 'traveler')->get();
                break;
            case 'payment':
                $data = \App\Models\Payment::all();
                break;
            default:
                return redirect()->back()->with('error', 'Invalid report type');
        }

        // Prepare PDF
        $pdf = Pdf::loadView('admin.report-pdf', ['data' => $data, 'type' => $type, 'title' => $title]);

        // Generate filename and path
        $fileName = 'report_' . $type . '_' . now()->format('Ymd_His') . '.pdf';
        $relativePath = 'storage/reports/' . $fileName; // Save this in DB
        $absolutePath = public_path($relativePath); // Use this for saving the file

        // Ensure directory exists
        File::ensureDirectoryExists(public_path('storage/reports'));

        // Save the PDF
        $pdf->save($absolutePath);

        // Save to DB
        Report::create([
            'type' => $type,
            'file_path' => $relativePath, // Only relative path is stored
            'generated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Report generated successfully!');
    }



    public function download($id)
{
    $report = Report::findOrFail($id);

    // Check if file_path is stored correctly
    if (!$report->file_path) {
        return redirect()->back()->with('error', 'Report file path not found.');
    }

    // Convert path to full path
    $filePath = public_path(str_replace(['\\', '|'], '/', $report->file_path)); // Clean any Windows-style slashes

    
    // Check if file exists
    if (file_exists($filePath)) {
        return response()->download($filePath);
    }

    return redirect()->back()->with('error', 'Report file not found.');
}


    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        $report->delete();

        return redirect()->back()->with('success', 'Report deleted successfully!');
    }
}