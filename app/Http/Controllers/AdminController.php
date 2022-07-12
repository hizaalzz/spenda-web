<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Matapelajaran;
use App\DataTables\AdminDataTable;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Admin::class, 'admin');
    }

    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.index');
    }

    public function create()
    {
        $listMatapelajaran = Matapelajaran::select('id', 'nama')->get();

        return view('pages.guru.create', compact('listMatapelajaran'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
