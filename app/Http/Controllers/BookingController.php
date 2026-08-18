<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Concerns\FormatsWhatsAppNumber;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    use FormatsWhatsAppNumber;
    public function create(Request $request): \Illuminate\View\View
    {
        $rawNumber = setting('whatsapp', '6281234567890');
        $whatsappNumber = $this->formatWhatsAppNumber($rawNumber);

        return view('pages.booking', [
            'title' => 'Book a Tattoo',
            'description' => 'Book your tattoo consultation at Ananniti Tattoo Bali. Fill in the form and we will contact you via WhatsApp.',
            'whatsappNumber' => $whatsappNumber,
            'preselectedService' => $request->query('service', ''),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:100'],
            'service' => ['required', 'in:studio,home_service'],
            'tattoo_style' => ['required', 'string', 'max:100'],
            'budget' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'placement' => ['nullable', 'string', 'max:100'],
            'size' => ['nullable', 'string', 'max:100'],
            'preferred_date' => ['nullable', 'string', 'max:50'],
            'preferred_time' => ['nullable', 'string', 'max:50'],
            'hotel' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'maps' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'has_reference' => ['boolean'],
        ], [
            'name.required' => 'Please enter your name.',
            'country.required' => 'Please enter your country.',
            'service.required' => 'Please select a service.',
            'service.in' => 'Please select a valid service.',
            'tattoo_style.required' => 'Please enter your tattoo style.',
            'budget.required' => 'Please enter your estimated budget.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        // Save to database
        Booking::create($validated);

        $message = $this->buildWhatsAppMessage($validated);

        $whatsappNumber = $request->input('whatsapp_number', '6281234567890');
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);

        $url = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($message);

        return redirect()->away($url);
    }

    protected function buildWhatsAppMessage(array $data): string
    {
        $serviceLabel = $data['service'] === 'studio' ? 'Studio Tattoo' : 'Home Service';

        $lines = [
            '━━━━━━━━━━━━━━━━━━━━━━',
            '',
            'NEW BOOKING REQUEST',
            '',
            '━━━━━━━━━━━━━━━━━━━━━━',
            '',
            'PERSONAL',
            'Name : ' . $data['name'],
            'Country : ' . $data['country'],
            'Phone : ' . ($data['phone'] ?? '—'),
            'Email : ' . ($data['email'] ?? '—'),
            '',
            '━━━━━━━━━━━━━━━━━━━━━━',
            '',
            'SERVICE',
            $serviceLabel,
            'Tattoo Style : ' . $data['tattoo_style'],
            'Placement : ' . ($data['placement'] ?? '—'),
            'Size : ' . ($data['size'] ?? '—'),
            'Budget : ' . $data['budget'],
        ];

        if ($data['service'] === 'home_service') {
            $lines[] = '';
            $lines[] = '━━━━━━━━━━━━━━━━━━━━━━';
            $lines[] = '';
            $lines[] = 'LOCATION';
            $lines[] = 'Hotel : ' . ($data['hotel'] ?? '—');
            $lines[] = 'Address : ' . ($data['address'] ?? '—');
            $lines[] = 'Maps : ' . ($data['maps'] ?? '—');
        }

        $lines[] = '';
        $lines[] = '━━━━━━━━━━━━━━━━━━━━━━';
        $lines[] = '';
        $lines[] = 'DATE';
        $lines[] = 'Preferred Date : ' . ($data['preferred_date'] ?? '—');
        $lines[] = 'Preferred Time : ' . ($data['preferred_time'] ?? '—');
        $lines[] = '';
        $lines[] = '━━━━━━━━━━━━━━━━━━━━━━';
        $lines[] = '';
        $lines[] = 'NOTES';
        $lines[] = ($data['notes'] ?? '....');
        $lines[] = '';
        $lines[] = '━━━━━━━━━━━━━━━━━━━━━━';
        $lines[] = '';
        $lines[] = 'Reference Images : ' . (!empty($data['has_reference']) ? 'YES' : 'NO');
        $lines[] = '';
        $lines[] = '━━━━━━━━━━━━━━━━━━━━━━';
        $lines[] = '';
        $lines[] = 'Sent from';
        $lines[] = 'Ananniti Tattoo Bali Website';

        return implode("\n", $lines);
    }
}
