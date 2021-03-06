<?php

namespace App\Http\Controllers;
use App\Doctor;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\Customer;
use App\Contact;
use App\Appointment;
use Carbon\Carbon;
use App\Department;
use App\MainDisease;
use App\DiseaseDescript;
use App\CategoryDisease;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctor_info=Doctor::all();
        $disease= MainDisease::all();
        $category_info= CategoryDisease::all();
        $department=Department::all();
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();

        // count how many message are unread from the selected user
        $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.name, users.avatar, users.email");
//              $users=User::where('id','!=',Auth::id())->get();
        return view('home',compact('doctor_info','category_info','department','disease','users'));

       // return view('home', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
     
        
             $my_id=Auth::id();
           // Make read all unread message
         Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
 // Get all message from selected user
     $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->orwhere('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->orwhere('to', $user_id);
        })->get();
       //$messages=Message::where('from',$user_id)->orwhere('to',$my_id)->get();



     return view('messages.index',['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'forceTLS' => true
        );
 
        
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
