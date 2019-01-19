<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Managers\ClientService;
class ClientController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new ClientService;
    }

    public function add(Request $request)
    {
        return $this->client->add($request);
    }

    public function update(Request $request, $id)
    {
        return $this->client->update($request, $id);
    }

    public function show($id)
    {
        return $this->client->show($id);
    }
    public function lists()
    {
        return $this->client->lists();
    }
    public function destroy($id)
    {
        return $this->client->destroy($id);
    }
}
