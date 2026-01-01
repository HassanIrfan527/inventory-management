<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CompanyInfo extends Component
{
    use WithFileUploads;

    public $companyInfo;

    #[Validate('required|string|max:255')]
    public ?string $companyName = null;

    #[Validate('nullable|string|max:255')]
    public ?string $companyPhone = null;

    #[Validate('nullable|string|email|max:255')]
    public ?string $companyEmail = null;

    #[Validate('nullable|string|max:255')]
    public ?string $companyWebsite = null;

    public ?string $companyLogo = null;

    #[Validate('nullable|image|mimes:jpg,png,webp,jpeg|max:10240')]
    public ?TemporaryUploadedFile $temporaryUploadedFile = null;

    protected function messages()
    {
        return [
            'temporaryUploadedFile.image' => 'The file must be an image.',
            'temporaryUploadedFile.max' => 'The logo must be smaller than 2MB.',
            'temporaryUploadedFile.mimes' => 'Only JPG, JPEG, PNG, and WebP formats are allowed.',
            // This catches generic upload failures
            'temporaryUploadedFile.uploaded' => 'The logo failed to upload. Please try again.',
        ];
    }

    /**
    /**
     * Mount the component.
     */
    public function mount(): void
    {
        if (Auth::user()->companyInfo) {
            $this->companyInfo = Auth::user()->companyInfo;
            $this->companyName = $this->companyInfo->name;
            $this->companyEmail = $this->companyInfo->email;
            $this->companyPhone = $this->companyInfo->phone;
            $this->companyWebsite = $this->companyInfo->website;
            $this->companyLogo = $this->companyInfo->logo;
        }
    }

    public function updateCompanyInformation(): void
    {

        $this->validate();
        if ($this->temporaryUploadedFile) {
            $path = $this->temporaryUploadedFile->store('photos', 'public');
        } else {
            $path = $this->companyInfo->logo;
        }

        $this->companyInfo->update([
            'name' => $this->companyName,
            'email' => $this->companyEmail,
            'phone' => $this->companyPhone,
            'website' => $this->companyWebsite,
            'logo' => $path,
        ]);
        $this->companyInfo->logo = $path;
        $this->showToast('Company information updated successfully', 'success');
        $this->reset('temporaryUploadedFile');
    }

    private function showToast(string $text, string $type): void
    {
        $this->dispatch('toast', message: $text, type: $type);
    }
}
