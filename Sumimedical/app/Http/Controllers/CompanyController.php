<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index(Request $request)
    {
        $company = company::all();
        return $company;
        
    }

    public function showCompaniesAll(){
        return response()->json(company::get());
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'website' => 'required',
        'email' => 'required'
    ]);

    company::create($request->all());
    return;
}
    public function show(Request $request)
    {
        $company = company::findOrFail($request->id);
        return $company;
        
    }

    public function update(Request $request)
    {
        $company = company::findOrFail($request->id);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        $company->save();

        return $company;
        
       
    }

    public function destroy(Request $request)
    {
        $company = company::destroy($request->id);
        return $company;
       
    }
}