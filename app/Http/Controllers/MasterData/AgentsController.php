<?php

namespace App\Http\Controllers\MasterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\Agents\CreateRequest as CreateAgentRequest;
use App\Http\Requests\MasterData\Agents\UpdateRequest as UpdateAgentRequest;
use App\Http\Resources\MasterData\AgentResource;
use App\Models\MasterData\Agent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-field-agent'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-field-agent'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-field-agent'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-field-agent'])->only('destroy');
    }

    public function index(Request $request)
    {
        return Inertia::render('MasterData/Agents/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $agents = Agent::filterBy($request->all())->latest()->paginate($perpage);

        return AgentResource::collection($agents);
    }

    public function create()
    {
        return Inertia::render('MasterData/Agents/create', ['edit' => false]);
    }

    public function store(CreateAgentRequest $request)
    {
        try {
            $create = Agent::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Created Agent Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(Agent $agent)
    {
        return response()->json([
            'data' => $agent,
        ], 200);
    }

    public function update(Agent $agent, UpdateAgentRequest $request)
    {
        try {
            $update = $agent->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated Agent Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Agent $agent)
    {
        try {
            $delete = $agent->delete();

            return response()->json([
             'success' => true,
             'message' => 'Deleted Agent Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
