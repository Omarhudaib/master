<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Employee;

class ChatController extends Controller
{

    public function index($employeeId)
    {
        $employees = Employee::all();
        $employee = Employee::findOrFail($employeeId);
        $senderId = auth()->user()->employee->id;
        $messages = Message::where(function ($query) use ($senderId, $employeeId) {
            $query->where('sender_id', $senderId)
                  ->where('receiver_id', $employeeId);
        })
        ->orWhere(function ($query) use ($senderId, $employeeId) {
            $query->where('sender_id', $employeeId)
                  ->where('receiver_id', $senderId);
        })
        ->latest()
        ->take(10)
        ->get()
        ->reverse();
        return view('admin.chat', compact('employee', 'employees', 'messages'));
    }

    public function show($employeeId)
    {
        $employees = Employee::all();
        $employee = Employee::findOrFail($employeeId);
        $senderId = auth()->user()->employee->id;

        $messages = Message::where(function ($query) use ($senderId, $employeeId) {
                $query->where('sender_id', $senderId)
                      ->where('receiver_id', $employeeId);
            })
            ->orWhere(function ($query) use ($senderId, $employeeId) {
                $query->where('sender_id', $employeeId)
                      ->where('receiver_id', $senderId);
            })
            ->latest()
            ->take(10)
            ->get()
            ->reverse();

        return view('admin.chat', compact('employee', 'employees', 'messages'));
    }



    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:employees,id', // Validate against employee IDs
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->user()->employee->id, // Use the logged-in user's employee ID as sender_id
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return redirect()->route('chat.show', $request->receiver_id)->with('success', 'Message sent!');
    }
}
