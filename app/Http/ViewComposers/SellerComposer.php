<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Providers\AdminLte;

class SellerComposer
{
    /**
     * @var AdminLte
     */
    private $sellerAdmin;

    public function __construct(AdminLte $sellerAdmin)
    {
        $this->sellerAdmin = $sellerAdmin;
    }

    public function compose(View $view)
    {
        $view->with('seller', $this->sellerAdmin);
    }
}
