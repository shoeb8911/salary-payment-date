<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PaymentDatesTest extends TestCase
{
    /** @test */
    public function it_generates_payment_dates_csv_for_a_given_year()
    {
        $year = 2025;
        
        // Run the command
        Artisan::call('generate:payment-dates', ['year' => $year]);

        // Get the expected file path
        $filePath = "payment_dates_{$year}.csv";

        // Assert the file exists in the storage
        Storage::disk('local')->assertExists($filePath);

        // Load the CSV content
        $content = Storage::disk('local')->get($filePath);
        
        // Perform assertions on the CSV content
        $this->assertStringContainsString('January', $content);
        $this->assertStringContainsString('February', $content);
        // Add more assertions as needed

        // Clean up
        Storage::disk('local')->delete($filePath);
    }
}
