<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::orderBy('created_at', 'desc')->get();

        return view('tenants.index', compact('tenants'));
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

        $tenant = Tenant::create($request->all());


        $tenant->domains()->create([
            'domain' => $tenant->id .'.'.'contenedor.test',
        ]);

        return redirect()->back()->with('success', 'Comprobante de pago exitosamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        $tenant->update([
            'id' => $request->get('id'),
        ]);

        $tenant->domains()->update([
            'domain' => $request->get('id') .'.'.'contenedor.test',
        ]);

        return redirect()->back()->with('success', 'Comprobante de pago exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        //
    }

    public function eliminar(Tenant $tenant){

        $tenant->delete();
        return redirect()->back();

    }

}
