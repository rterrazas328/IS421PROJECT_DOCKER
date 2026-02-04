<?php namespace App\Http\Controllers;
use RequestF;
use DB;

class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //make sure user is authenticated else redirect to login
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function adminPage(){

        $userlist = DB::select('SELECT * from users');

        return view('admin', ['data' => $userlist, 'page_name' => 'admin']);
    }

    public function updateRoles(){
        //first update roles in DB
        $data=RequestF::all();

        $adminRoles = array();//1
        $userRoles = array();//0

        foreach ($data as $name => $val){

            if ($val == "on"){
                $id = $name;
                $role=$data[$id."Role"];

                if($role == "user"){
                    array_push($userRoles, $id);
                }
                else if($role == "admin"){
                    array_push($adminRoles, $id);
                }
            }
        }
        //update all selected admins
        if(count($adminRoles) > 0){
            $makeAdminQuery = "update users set userlevel = 1 where id =";

            foreach ($adminRoles as $userId){
                $makeAdminQuery .= " ? OR";
            }
            $makeAdminQuery = substr($makeAdminQuery, 0, -3);//trim last 3 chars

            DB::update($makeAdminQuery, $adminRoles);
        }
        //update all selected users
        if(count($userRoles) > 0){
            $makeUserQuery = "update users set userlevel = 0 where id =";

            foreach ($userRoles as $userId) {
                $makeUserQuery .= " ? OR";
            }
            $makeUserQuery = substr($makeUserQuery, 0, -3);//trim last 3 chars

            DB::update($makeUserQuery, $userRoles);
        }
        //then display page

        $userlist = DB::select('SELECT * from users');

        return view('admin', ['data' => $userlist, 'page_name' => 'admin']);
    }

}
