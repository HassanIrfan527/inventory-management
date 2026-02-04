<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'description' => 'For established freelancers who need more power and flexibility.',
                'stripe_product_id' => env('STRIPE_PRO_PRODUCT_ID', 'prod_xxx'),
                'stripe_monthly_price_id' => env('STRIPE_PRO_MONTHLY_PRICE_ID', 'price_xxx'),
                'stripe_yearly_price_id' => null,
                'monthly_price' => 1200,
                'yearly_price' => null,
                'features' => [
                    'contacts' => -1,
                    'invoices_per_month' => 100,
                    'products' => 250,
                    'orders_per_month' => 200,
                    'team_members' => 1,
                    'api_requests_per_month' => 1000,
                    'webhooks' => 5,
                    'integrations' => 2,
                    'api_access' => 'limited',
                    'support' => 'email',
                    'support_response_hours' => 48,
                    'custom_fields' => 10,
                    'tags' => 25,
                    'csv_import' => true,
                    'bulk_actions' => true,
                    'custom_templates' => true,
                    'remove_branding' => true,
                    'white_label' => false,
                ],
                'is_active' => 1,
                'sort_order' => 1,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'For growing teams and businesses with advanced needs.',
                'stripe_product_id' => env('STRIPE_BUSINESS_PRODUCT_ID', 'prod_xxx'),
                'stripe_monthly_price_id' => env('STRIPE_BUSINESS_MONTHLY_PRICE_ID', 'price_xxx'),
                'stripe_yearly_price_id' => null,
                'monthly_price' => 2900,
                'yearly_price' => null,
                'features' => [
                    'contacts' => -1,
                    'invoices_per_month' => -1,
                    'products' => -1,
                    'orders_per_month' => -1,
                    'team_members' => 5,
                    'api_requests_per_month' => 10000,
                    'webhooks' => -1,
                    'integrations' => -1,
                    'api_access' => 'full',
                    'support' => 'priority',
                    'support_response_hours' => 24,
                    'custom_fields' => -1,
                    'tags' => -1,
                    'csv_import' => true,
                    'bulk_actions' => true,
                    'custom_templates' => true,
                    'remove_branding' => true,
                    'white_label' => true,
                ],
                'is_active' => 1,
                'sort_order' => 2,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }
    }
}
