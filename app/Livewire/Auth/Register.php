<?php

namespace App\Livewire\Auth;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth.register')]
#[Title('Create Account')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public ?string $selectedPlan = null;

    public ?string $pendingPlan = null;

    public bool $showChangePlanModal = false;

    public Collection $plans;

    public function mount(): void
    {
        $this->plans = Plan::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        // Check if plan was pre-selected from pricing page
        if (session()->has('selected_plan')) {
            $this->selectedPlan = session('selected_plan');
        }
    }

    public function selectPlan(string $slug): void
    {
        // If no plan selected yet, select directly
        if ($this->selectedPlan === null) {
            $this->selectedPlan = $slug;

            return;
        }

        // If same plan clicked, do nothing
        if ($this->selectedPlan === $slug) {
            return;
        }

        // Show confirmation modal for plan change
        $this->pendingPlan = $slug;
        $this->showChangePlanModal = true;
    }

    public function confirmPlanChange(): void
    {
        if ($this->pendingPlan) {
            $this->selectedPlan = $this->pendingPlan;
            $this->pendingPlan = null;
        }
        $this->showChangePlanModal = false;
    }

    public function cancelPlanChange(): void
    {
        $this->pendingPlan = null;
        $this->showChangePlanModal = false;
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        event(new Registered($user));

        // Store selected plan in session for Stripe checkout (to be implemented)
        if ($this->selectedPlan) {
            session(['selected_plan' => $this->selectedPlan]);
        } else {
            session()->forget('selected_plan');
        }

        Auth::login($user);

        $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
