<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller //Controller resource
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Session::flash('chave','valor');
        $clients = \App\Client::paginate(50);
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clientType = Client::getClientType($request->client_type);
        return view('admin.clients.create', ['client' => new Client(), 'clientType' => $clientType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $data = $request->only(array_keys($request->rules()));
        $data['defaulter'] = $request->has('defaulter');
        $data['client_type'] = Client::getClientType($request->client_type);
        Client::create($data);
        //\Session::flash('message','Cliente cadastrado com sucesso');
        return redirect()->route('clients.index')
            ->with('message','Cliente cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client) //Route Model Binding Implicito
    {
        $clientType = $client->client_type;
        return view('admin.clients.edit', compact('client', 'clientType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $data = $request->only(array_keys($request->rules()));
        $data['defaulter'] = $request->has('defaulter');
        $client->fill($data);
        $client->save();
        //\Session::flash('message','Cliente alterado com sucesso');
        return redirect()->route('clients.index')
            ->with('message','Cliente alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
            ->with('message','Cliente excluído com sucesso');
    }
}
