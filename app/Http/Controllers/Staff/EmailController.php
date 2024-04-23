<?php

namespace App\Http\Controllers\Staff;

use App\Models\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $staff_id = Auth::guard('staff')->user()->id;
        $data = Email::all()->where('staff_id', $staff_id);
        return view('staff.email.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('staff.email.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formFields = $request->validate([
            'staff_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'objective' => 'required',
        ]);

        if ($this->isOnline()) {
            $mail_data = [
                'objective' => $request->objective,
                'recipient' => $request->email,
                'fromEmail' => 'justcsebd@gmail.com',
                'fromName' => $request->name,
                'subject' => $request->subject,
                'body' => $request->message
            ];
            \Mail::send('staff.email.email-template', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
            });

            //Data save to Database 
            $data = new Email();
            $data->staff_id = $request->staff_id;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->subject = $request->subject;
            $data->message = $request->message;
            $data->objective = $request->objective;
            $data->save();
            //Data Saved
            return redirect()->route('staff.email.index')->with('success', 'Email Sent Successfully!');
        } else {

            return redirect()->back()->withInput()->with('error', 'No Internet Connection');
        }
    }
    //Check internet Connections
    public function isOnline($site = 'https://youtube.com')
    {
        if (@fopen($site, 'r')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Email::find($id);
        if ($data->staff_id == 0) {
            return redirect('staff/email')->with('danger', 'Warning! You are Not Allowed!');
        } else {
            return view('staff.email.show', ['data' => $data]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Email::find($id);
        if ($data->staff_id == 0) {
            return redirect('staff/email')->with('danger', 'Warning! You are Not Allowed to Delete!');
        } else {
            $data->delete();
            return redirect()->route('staff.email.index')->with('danger', 'Email Data has been deleted Successfully!');
        }
    }
}
