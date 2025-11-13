<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Preference;
use Illuminate\Http\Request as HttpRequest; // Alias to avoid conflict

class MonitorController extends Controller
{
    public function index()
    {
        // 1. Get field display preferences
        $fieldPreferences = Preference::pluck('shown', 'field_name');

        // 2. Determine if "reviewed" rows should be omitted
        $omitReviewed = $fieldPreferences->get('omit_reviewed_rows', 0); // Assuming 0 is show

        // 3. Fetch data
        $query = Request::orderByDesc('updated_at');

        if ($omitReviewed) {
            $query->where('reviewed', 0);
        }

        $requests = $query->get();

        // Pass everything to the view
        return view('monitor.index', compact('requests', 'fieldPreferences'));
    }

    public function updateComment(HttpRequest $request, $ip_address)
    {
        // Find the record by its primary key
        $monitorRequest = Request::where('ip_address', $ip_address)->firstOrFail();

        // Update logic: comments and reviewed flag
        $comment = $request->input('comments');
        $monitorRequest->comments = $comment;

        // The logic: "reviewed field gets updated to 1 whenever a user updates the comments field to contain a value."
        if (!empty($comment)) {
            $monitorRequest->reviewed = 1;
        }

        $monitorRequest->save();

        return back()->with('success', 'Comment updated successfully.');
    }

    public function updatePreferences(HttpRequest $request)
    {
        // Logic to update the field_name.shown in the preferences table
        // This is complex and requires a loop or upsert for the many fields.
        // For simplicity, we'll focus on the 'omit_reviewed_rows' preference:
        Preference::updateOrCreate(
            ['field_name' => 'omit_reviewed_rows'],
            ['shown' => $request->has('omit_reviewed_rows') ? 1 : 0]
        );

        return back()->with('success', 'Preferences updated successfully.');
    }
}