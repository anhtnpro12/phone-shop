<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Repositories\Contracts\ShipRepositoryInterface;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    private $shipRepository;

    public function __construct(ShipRepositoryInterface $shipRepository) {
        $this->shipRepository = $shipRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Ship::class);

        $ships = $this->shipRepository->paginate(10);
        return view('ships.index', [
            'ships' => $ships
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Ship::class);

        return view('ships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Ship::class);

        $request->validate([
            'name' => 'required'
        ]);

        $this->shipRepository->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $ships = $this->shipRepository->paginate(10);
        return to_route('ships.index', [
            'page' => $ships->lastPage(),
            'success' => 'Create Shipping Method Successful'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Ship::class);

        $ship = $this->shipRepository->find($id);
        return view('ships.edit', ['ship' => $ship]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Ship::class);

        $request->validate([
            'name' => 'required',
        ]);

        $this->shipRepository->update([
            'name' => $request->name,
            'description' => $request->description,
        ], $id);

        return to_route('ships.edit', [
            'ship' => $id,
            'success' => 'Update Shipping Method Successful'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $this->authorize('forceDelete', Ship::class);

        $ship = $this->shipRepository->find($id);

        if($ship->orders->count() > 0) {
            return to_route('ships.index', [
                'page' => $request->page,
            ])->with('error', 'Delete Failed. Orders are being shipped using this method.');
        }

        $this->shipRepository->delete($id);
        return to_route('ships.index', [
            'page' => $request->page,
            'success' => 'Delete Successful'
        ]);
    }
}
