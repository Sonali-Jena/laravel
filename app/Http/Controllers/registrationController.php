<?php

namespace App\Http\Controllers;

use App\Models\registrationModel;
use Illuminate\Http\Request;

use PDF;



use Illuminate\Support\Facades\DB;

class registrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\registrationModel  $registrationModel
     * @return \Illuminate\Http\Response
     */
    public function show(registrationModel $registrationModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\registrationModel  $registrationModel
     * @return \Illuminate\Http\Response
     */
    public function edit(registrationModel $registrationModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\registrationModel  $registrationModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, registrationModel $registrationModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\registrationModel  $registrationModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(registrationModel $registrationModel)
    {
        //
    }

    public function Register(registrationModel $registrationModel)
    {
        return view('regstration');
    }

    public function Add(registrationModel $registrationModel,Request $request)
    {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users|max:255',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);


        // $con= new registrationModel;
        // $con->name=$request->name;
        // $con->email=$request->email;
        // $con->phone=$request->phone;
        // $con->password=$request->password;
        // $con->save();
        
        // $data = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => $request->password
        // ];
        // $data=$request->all();
        // DB::table('registration')->insert($data);
        // $lastInsertedId = $con->id;

        $lastInsertedId = DB::table('registration')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'password' => $request->password,
        ]);

        return redirect('/View/' . $lastInsertedId)->with('success','Registration Successfully');
    }


    public function View(registrationModel $registrationModel,$id){
        $DataResQry = DB::table('registration')
        ->select("*");
    // $DataResQry	= $DataResQry->leftjoin('t_members as m','m.memberId','=','A.INT_CREATED_BY' );		
    // $DataResQry = $DataResQry->where('A.BIT_DELETED_FLAG', 0)->where('A.INT_PUBLISH_STATUS', 1)->where('A.INT_BLOG_ID', $blogId);
    // $DataResQry = $DataResQry->orderBy('DT_PUBLISH_DATE', 'desc');
    $DataResQry = $DataResQry->where('id',$id);
    $arrRes       = $DataResQry->get();

    // dd($arrRes);

    $this->viewVars['allShowRec'] = $arrRes;
    return view('viewregistration', $this->viewVars);
    }

    public function downloadPdf($id)
    {
        $DataResQry = DB::table('registration')
        ->select("*");
        $DataResQry = $DataResQry->where('id',$id);
        $arrRes       = $DataResQry->get();
        $this->viewVars['allShowRec'] = $arrRes;
        

        $pdf = PDF::loadView('pdfTemplate', $this->viewVars);
        

        return $pdf->download('downloaded_pdf.pdf');
    }
}