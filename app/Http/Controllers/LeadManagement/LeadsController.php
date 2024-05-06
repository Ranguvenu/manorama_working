<?php

namespace App\Http\Controllers\LeadManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadManagement\Leads\CreateRequest as CreateLeadRequest;
use App\Http\Requests\LeadManagement\Leads\UpdateRequest as UpdateLeadRequest;
use App\Http\Resources\LeadManagement\LeadsResource;
use App\Models\Ecommerce\Coupons;
use App\Models\Ecommerce\Packages;
use App\Models\LeadManagement\InterestedIn;
use App\Models\LeadManagement\Lead;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeadsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-all-leads|view-assigned-leads'])->only('index', 'results');
        $this->middleware(['role_or_permission:assign-agent'])->only('assign');
        $this->middleware(['role_or_permission:create-lead'])->only('store');
        $this->middleware(['role_or_permission:create-lead|edit-lead'])->only('create');
        $this->middleware(['role_or_permission:edit-lead'])->only('update', 'edit');
        $this->middleware(['role_or_permission:delete-lead'])->only('destroy');
    }

    public function index(Category $category, Request $request)
    {
        $sources = Category::where('taxonomy_slug', 'lead_source')->get();
        $packages = Packages::all();

        return Inertia::render('LeadManagement/Leads/index', [
                                'category' => $category,
                                 'sources' => $sources,
                                 'packages' => $packages,
                                 'agents' => [],
                            ]);
    }

    public function results(Category $category, Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $leads = $category->leads()->withRestrictions()->with('leads')->latest()->filterBy($request->all())->paginate($perpage);

        return LeadsResource::collection($leads);
    }

    public function create(Category $category)
    {
        $sources = Taxonomy::findOrFail('lead_source');
        $packages = Packages::all();

        return response()->json([
            'sources' => $sources->categories,
            'packages' => $packages,
        ], 200);
    }

    public function store(Category $category, CreateLeadRequest $request)
    {
        try {
            $data = $request->validated();
            $data['country_code'] = $request->get('phone')['code'];
            $data['phone_number'] = $request->get('phone')['number'];
            $lead = Lead::updateOrCreate(
                ['email' => $request->get('email')],
                $data);
            $lead->interests()->create([
                'tags' => $request->get('tags'),
                'product_id' => $request->get('product_id'),
                'recevied_from' => $request->get('received_from'),
                'source_id' => $request->get('source'),
                'category_id' => $category->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Marketing Lead Created Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(Category $category, InterestedIn $interested)
    {
        return response()->json([
            'data' => [
                'phone' => [
                    'code' => $interested->leads->country_code,
                    'number' => $interested->leads->phone_number,
                ],
                'email' => $interested->leads->email,
                'product_id' => $interested->product_id,
                'tags' => $interested->tags,
                'source' => $interested->source->id,
                'name' => $interested->leads->name,
            ],
        ], 200);
    }

    public function update(Category $category, InterestedIn $interested, UpdateLeadRequest $request)
    {
        try {
            $data = $request->validated();
            $data['country_code'] = $request->get('phone')['code'];
            $data['phone_number'] = $request->get('phone')['number'];

            $update = $interested->update([
                'product_id' => $request->get('product_id'),
                'source_id' => $request->get('source'),
                'tags' => $request->get('tags'),
            ]);
            $interested->leads->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Updated Marketing Lead Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Category $category, InterestedIn $interested)
    {
        $coupons = Coupons::active()->limit(5)->get();

        return response()->json([
            'success' => true,
            'data' => new LeadsResource($interested),
            'coupons' => $coupons,
        ], 200);
    }

    public function assign(Category $category, InterestedIn $interested, User $agent)
    {
        try {
            $assignagent = $interested->assignment()->updateOrCreate(['interested_in_id' => $interested->id], ['assigned_to_id' => $agent->id]);
            $interested->status = 2;
            $interested->save();
            return response()->json([
                'success' => true,
                'message' => 'Agent Assigned',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign agent',
            ], 422);
        }
    }

    public function unassign(Category $category, InterestedIn $interested, User $agent)
    {
        try {
            $assign = $interested->assignment()->where('interested_in_id', $interested->id)->first();
            $assign->delete();

            return response()->json([
                'success' => true,
                'message' => 'Agent Unassigned',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove agent',
            ], 422);
        }
    }

    public function disqualify(Category $category, InterestedIn $lead)
    {
        try {
            $lead->status = 1;
            $lead->save();

            return response()->json([
                'success' => true,
                'message' => 'Lead Disqualified',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function undisqualify(Category $category, InterestedIn $lead)
    {
        try {
            $lead->status = 0;
            $lead->save();

            return response()->json([
                'success' => true,
                'message' => 'Lead Undisqualified',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
