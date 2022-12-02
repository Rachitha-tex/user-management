<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Religion;
use App\Models\Month;

use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        return view('home.homepage');
    }
    public function store(Request $request){
        $request->validate([
            'id_number'=>'required|unique:users,id_number',
            'dob'=>'required',
            'age'=>'required',
            'name'=>'required',
            'pnumber'=>'required|digits:10',
            'user_img'=>'required|mimes:jpeg,png,jpg,gif'
        ]);

        $user=new User();
        $user->id_number=$request->id_number;
        $user->dob=$request->dob;
        $user->age=$request->age;
        $user->name=$request->name;
        $user->pnumber=$request->pnumber;
        $user->address=$request->address;
        $user->religion=$request->religion;
        $user->nationality=$request->nationality;

        $image=$request->user_img;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->user_img->move('user_logo',$imagename);
        $user->user_img=$imagename;

         $saved=$user->save();

         if(!$saved){
             Alert::danger('Error in User adding!!!');
         }else{
            Alert::success('User Added Sucecssfully!!','You are added to the users list!!!');
         }

        return redirect()->back();

    }

    public function getUsers(Request $request){
       
        $users=User::where('status','=',0)->paginate(4);
        $getReligions=Religion::all();
        $getMonths=Month::all();        
     
        $users=User::when($request->getAge != null,function($q) use ($request){
            return $q->where('age',$request->getAge);

        }, function ($q) use($users){
            return $q->where('status','=',0);
        })
        ->when($request->getreligion !=null ,function ($q) use ($request){
            return $q->where('religion',$request->getreligion);
        })
        ->when($request->search !=null,function ($q) use ($request){
            return $q->where('name','LIKE',"%{$request->search}%")->orWhere('id_number','LIKE',"%{$request->search}%")->orWhere('age','LIKE',"%{$request->search}%")->orWhere('address','LIKE',"%{$request->search}%")->orWhere('religion','LIKE',"%{$request->search}%");
        })
        ->when($request->getmonths !=null,function ($q) use($request){
            return $q->whereRaw('extract(month from dob) = ?',$request->getmonths);
        })
        ->paginate(4);


        return view('home.getusers',compact('users','getReligions','getMonths'));
    }

  
    public function editUser($id){
        $user=User::find($id);
        return view('home.edituser',compact('user'));
    }

    public function updateUser(Request $request,$id){
        $user=User::find($id);

        $user->id_number=$request->id_number;
        $user->dob=$request->dob;
        $user->age=$request->age;
        $user->name=$request->name;
        $user->pnumber=$request->pnumber;
        $user->address=$request->address;
        $user->religion=$request->religion;
        $user->nationality=$request->nationality;

        $image=$request->user_img;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->user_img->move('user_logo',$imagename);
            $user->user_img=$imagename;
        }

       $updated=$user->save();
       
       if(!$updated){
        Alert::danger('Error in User Updating');
       }else{
        Alert::success('User Updated Successfully','We have updated user to the user list!!!!');
       }
        return redirect()->back();
    }

    public function deleteUser($id){
        $user=User::find($id);
         $user->delete();

        Alert::success('User Deleted Successfully','We have deleted selected user from the list!!!!');
        return redirect()->back(); 
    }
}