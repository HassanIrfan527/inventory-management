<?php

namespace App\Livewire;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Invoices')]
class Invoices extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    public $filterType = '';

    public $filterStatus = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function download($id)
    {
        $invoice = Invoice::with(['order.contact', 'order.products'])->findOrFail($id);

        $pdf = Pdf::loadView('invoice.modern', ['invoice' => $invoice]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $invoice->invoice_number.'.pdf');
    }

    public function render()
    {
        $query = Invoice::query()
            ->with(['order.contact'])
            ->when($this->search, function ($query) {
                $query->where('invoice_number', 'like', '%'.$this->search.'%')
                    ->orWhereHas('order.contact', function ($q) {
                        $q->where('name', 'like', '%'.$this->search.'%');
                    });
            })
            ->when($this->filterType, function ($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->latest();

        $stats = [
            'total' => Invoice::count(),
            'revenue' => Invoice::where('type', InvoiceType::CUSTOMER->value)->where('status', InvoiceStatus::PAID->value)->sum('total_amount'),
            'pending' => Invoice::where('status', InvoiceStatus::PENDING->value)->count(),
            'overdue' => Invoice::where('status', InvoiceStatus::OVERDUE->value)->count(),
        ];

        return view('livewire.invoices', [
            'invoices' => $query->paginate(10),
            'stats' => $stats,
        ]);
    }
}
