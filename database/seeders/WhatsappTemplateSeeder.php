<?php

namespace Database\Seeders;

use App\Models\WhatsappTemplate;
use Illuminate\Database\Seeder;

class WhatsappTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Home Service',
                'type' => 'home_service',
                'template' => "Halo {customer_name},\n\nTerima kasih telah melakukan booking home service di Ananniti Tattoo Bali.\n\nDetail Booking:\n- Tanggal: {preferred_date}\n- Jam: {preferred_time}\n- Lokasi: {location}\n- Layanan: {service}\n- Catatan: {notes}\n\nTim kami akan menghubungi Anda untuk konfirmasi.\n\nTerima kasih,\nAnanniti Tattoo Bali",
                'is_active' => true,
            ],
            [
                'name' => 'Consultation',
                'type' => 'consultation',
                'template' => "Halo {customer_name},\n\nTerima kasih telah menghubungi Ananniti Tattoo Bali untuk konsultasi.\n\nKami siap membantu Anda mendesain tattoo impian.\n\nSilakan datang ke studio kami atau hubungi via WhatsApp untuk membuat janji.\n\nTerima kasih,\nAnanniti Tattoo Bali",
                'is_active' => true,
            ],
            [
                'name' => 'Shop Product',
                'type' => 'shop',
                'template' => "Halo {customer_name},\n\nTerima kasih telah membeli {product} di Ananniti Tattoo Bali.\n\nDetail Pesanan:\n- Produk: {product}\n- Jumlah: {quantity}\n- Total: {total_price}\n\nPesanan Anda sedang diproses. Kami akan mengirimkan nomor resi segera.\n\nTerima kasih,\nAnanniti Tattoo Bali",
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            WhatsappTemplate::updateOrCreate(
                ['name' => $template['name']],
                $template
            );
        }
    }
}
