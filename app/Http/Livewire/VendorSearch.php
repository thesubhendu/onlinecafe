<?php

namespace App\Http\Livewire;

use App\Repositories\SearchRepository;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Livewire\Component;

class VendorSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $currentPage = 1;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search'      => ['except' => '', 'as' => 's'],
        'currentPage' => ['except' => '', 'as' => 't'],
    ];

    public function render(SearchRepository $searchRepository)
    {
        return view('livewire.vendor-search')->layout('layouts.app')->with([
            'vendors' => $searchRepository->get($this->search)
        ]);
    }

    public function setPage($page): void
    {
        $this->currentPage = $page;
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
