<?php

namespace App\Http\Controllers\Dashboard;

use App\Modeles\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Clients\ClientRequest;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_clients')->only('index');
        $this->middleware('permission:create_clients')->only('create');
        $this->middleware('permission:update_clients')->only('edit');
        $this->middleware('permission:delete_clients')->only('destroy');
    }

    public function index(Request $request)
    {
        $clients = Client::search($request)->latest()->paginate(10);

        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        $client = new Client();
        return view('dashboard.clients.create', compact('client'));
    }

    public function store(ClientRequest $request)
    {
        $data = $request->all();
        $data['phone'] = array_filter($request->phone);
        Client::create($data);
        return redirect()->route('dashboard.clients.index')->with('message', __('dashboard.added_successfullu'));
    }

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }


    public function update(ClientRequest $request, Client $client)
    {
        $data = $request->all();
        $data['phone'] = array_filter($request->phone);
        $client->update($data);
        return redirect()->route('dashboard.clients.index')->with('message', __('dashboard.updated_successfullu'));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->back()->with('message', __('dashboard.deleted_successfullu'));
    }
}
