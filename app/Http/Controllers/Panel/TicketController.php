<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

use App\Models\Department;
use App\Models\Like;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Kavenegar\KavenegarApi;


class TicketController extends Controller
{
    public function tickets(){

        $tickets = null;
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)->whereNull('parent_id')->orderBy('id','DESC')->get();
        return view('site.panel.ticket.list')
            ->with('user',$user)
            ->with('tickets',$tickets);
    }
    public function ticketDetail($id){
        $user = Auth::user();
        $start = Ticket::find($id);
        $end = Ticket::where('parent_id' , $id)->orderBy('created_at')->get();
        return view('site.panel.ticket.detail')
            ->with('user',$user)
            ->with('start' , $start)
            ->with('end' , $end);
    }
    public function getNewTicket(){
        $user = Auth::user();
        $departments = Department::all();
        return view('site.panel.ticket.new-ticket')
            ->with('departments',$departments)
            ->with('user',$user);
    }

    public function postNewTicket(Request $request){
        $input = $request->all();

        $input['user_id'] = Auth::id();
        if ($request->hasFile('file')) {
            $pathMain = "assets/uploads/content/ticket";
            $extension = $request->file('file')->getClientOriginalName();
            $fileName = random_int(1000 , 9999). "$extension";
            $request->file('file')->move($pathMain, $fileName);
            $input['file'] = $fileName;
        }
        $ticket = Ticket::create($input);

        return Redirect::action('Panel\TicketController@tickets')->with('success','تیکت شما با موفقیت ثبت شد.');
    }

    public function postTicketDetails(Request $request)
    {
        $start = Ticket::find($request->parent_id);

        $start->update([
           'status'=>0,
        ]);
        $input['user_id'] = Auth::id();
        $input['parent_id'] = $request->get('parent_id');
        $input['message'] = $request->get('message');
        $input['subject'] = $start->subject;
        $input['department_id'] = $start->department_id;
        $input['status'] = 0 ;
        $ticket = Ticket::create($input);
        return redirect()->back();
    }
    public function ticketStatus($id)
    {
        $ticket = \App\Models\Ticket::find($id);
        $ticket->update([
            'status'=> '2',
        ]);
        return Redirect::action('Panel\TicketController@tickets')->with('success','  با موفقیت ثبت شد.');
    }
    public function getReturn($itemId){
        $user = Auth::user();
        $order_item=OrderItem::where('id',$itemId)->first();
        $product=Product::where('id',$order_item->product_id)->first();
        return view('site.panel.tickets.newreturn')
            ->with('user',$user)
            ->with('itemId',$itemId)
            ->with('product',$product);
    }
//    public function postReturn($itemId,Request $request)
//    {
//        $user = Auth::user();
//        $product = Product::where('id', $itemId)->first();
//        $input['use_idr']=$user['id'];
//        $input['order_item_id']=$product['id'];
//        $input['deprtment_id']='1';
//        if ($request->hasFile('file')) {
//            $pathMain = "assets/uploads/ticket";
//            $extension = $request->file('file')->getClientOriginalExtension();
//            $fileName = md5(microtime()) . ".$extension";
//            $request->file('file')->move($pathMain, $fileName);
//            $input['file'] = $fileName;
//        } else {
//            return Redirect::back()->with('error', 'عکس ارسالی صحیح نیست.');
//        }
//
//        return Redirect::back()->with('success','درخواست شما با موفقیت ارسال شد.');
//    }
}
