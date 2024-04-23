<?php

namespace App\Http\Controllers\Admin;

use App\Models\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Email::all();
        return view('admin.email.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.email.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'objective' => 'required',
        ]);
        if($this->isOnline()){
            $mail_data = [
                'objective'=>$request->objective,
                'recipient'=>$request->email,
                'fromEmail'=>'justcsebd@gmail.com',
                'fromName'=>$request->name,
                'subject'=>$request->subject,
                'body'=>$request->message
            ];
            \Mail::send('admin.email.email-template',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'],$mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
            //Data save to Database 
            $data = new Email();
            $data->staff_id = 0;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->subject = $request->subject;
            $data->message = $request->message;
            $data->objective = $request->objective;
            $data->save();
            //Data Saved
            return redirect('admin/email')->with('success','Email Sent Successfully!');
        }else{

            return redirect()->back()->withInput()->with('error','No Internet Connection');
        }
        
    }
    //Check internet Connections
    public function isOnline($site = 'https://youtube.com'){
        if(@fopen($site,'r')){
            return true;
        }else{
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
        return view('admin.email.show',['data'=>$data]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Email::find($id);
        $data->delete();
        return redirect('admin/email')->with('danger','Email Data has been deleted Successfully!');
    }
}
