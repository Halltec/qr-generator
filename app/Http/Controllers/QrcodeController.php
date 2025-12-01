<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQrcodeRequest;
use App\Http\Requests\UpdateQrcodeRequest;
use App\Models\Qrcode;
use App\Services\QrCodeService;

use function Pest\Laravel\json;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginate the QR codes (10 per page), newest first
        $qrcodes = Qrcode::orderBy('created_at', 'desc')->paginate(10);

        return view('qrcode.index', compact('qrcodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('qrcode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQrcodeRequest $request, QrCodeService $qrCodeService)
    {
        $validated = $request->validated();

        $dataUri = $qrCodeService->generate($validated['url']);

        Qrcode::create([
            ...$validated,
            'qr_code' => $dataUri,
        ]);
        return redirect()->route('qrcode.index')->with('success', 'QR Code created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Qrcode $qrcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qrcode $qrcode)
    {
        return view('qrcode.edit', compact('qrcode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQrcodeRequest $request, Qrcode $qrcode, QrCodeService $qrCodeService)
    {
        $validated = $request->validated();

        $dataUri = $qrCodeService->generate($validated['url']);

        $qrcode->update([
            ...$validated,
            'qr_code' => $dataUri,
        ]);

        return redirect()->route('qrcode.index')->with('success', 'QR Code updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qrcode $qrcode)
    {
        //
    }
}
