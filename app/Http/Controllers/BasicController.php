<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoryExport;
use PDF;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::orderBy('seq', 'asc')->paginate(7);

        return view('basic.index')->with('data', $data);
    }

    public function exportPDF()
    {
        $data = Category::all();

        $pdf = PDF::loadView('pdf.pdf', array('data' => $data))->setPaper('a4', 'potrait');
        return $pdf->download();
    }

    public function exportExcel()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'nullable',
            'seq'=>'required',
        ]);
        $data = [
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'seq'=>$request->input('seq'),
        ];
        Category::create($data);
        return redirect('basic')->with('message', 'Add Data Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::where('id', $id)->first();
        
        return view('/basic/edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Category::findOrFail($id);

        $validasi = $request->validate([
             'name'=>'required',
             'description'=>'nullable',
             'seq'=>'required',
             'status'=>$data->status === 'inactive' ? 'required|in:Active,Inactive' : 'in:Active,Inactive'
         ]);
 
             if($data->status === 'Inactive' && $validasi['status'] === 'Active') {
                 $data->status = 'Active';
                 $data->is_deleted = false;
             }
 
             $data->save();
 
         $data = [
             'name'=>$request->input('name'),
             'description'=>$request->input('description'),
             'seq'=>$request->input('seq')
         ];
         Category::where('id', $id)->update($data);
         return redirect('/basic')->with('message', 'Succes edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        if ($data->status === 'Active') {
            $data->status = 'Inactive';
            $data->is_deleted = true;
            $data->save();
            return redirect('/basic')->with('success', 'Data is inactive');
        }
    }
}
