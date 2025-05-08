<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function sendWhatsAppBlast(Request $request)
    {
        Log::info('Masuk ke method sendWhatsAppBlast');

        $validated = $request->validate([
            'phone_number' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'media_type' => 'required|in:image,document',
            'caption' => 'nullable|string|max:255',
        ]);

        Log::info('Request tervalidasi', $validated);

        $filePath = $request->file('file')->store('lampiran', 'public');
        Log::info('File berhasil disimpan', ['file_path' => $filePath]);

        $waService = new WhatsAppService();
        $mediaId = $waService->uploadMedia($filePath);

        Log::info('Media ID dari uploadMedia', ['media_id' => $mediaId]);

        if (!$mediaId) {
            Log::error('Gagal mendapatkan media ID dari uploadMedia');
            return redirect()->back()->with('error', 'Gagal mengirim lampiran ke WhatsApp.');
        }

        $invoice = Invoice::create([
            'media_type' => $validated['media_type'],
            'file_path' => $filePath,
            'media_id' => $mediaId,
            'caption' => $validated['caption'] ?? 'No caption provided',
            'phone_number' => $validated['phone_number'],
        ]);

        Log::info('Data invoice berhasil disimpan', $invoice->toArray());

        $response = $waService->sendDocument($validated['phone_number'], $mediaId, $validated['caption'] ?? '');

        if ($response->failed()) {
            Log::error('Gagal mengirim WA', [
                'response' => $response->json()
            ]);
            return redirect()->back()->with('error', 'Gagal mengirim pesan ke WhatsApp.');
        }

        Log::info('Pesan berhasil dikirim ke WhatsApp');

        return redirect()->back()->with('success', 'Lampiran berhasil dikirim ke WhatsApp.');
    }
}