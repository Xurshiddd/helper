<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Permission::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        DB::table('permissions')->insert([
            'name' => $request->name,
            'guard_name' => 'api', // Assuming 'api' is the guard name you want to use
        ]);
        return response()->json(['message' => 'Permission created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name'=> 'string|required']);
        Permission::where('id', $id)->update(['name' => $request->name]);
        return response()->json(['message' => 'Permission updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $per = Permission::find($id);
        $per->delete();
        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
