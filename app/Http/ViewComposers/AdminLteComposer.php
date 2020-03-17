<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Providers\AdminLte;

class AdminLteComposer
{
    /**
     * @var AdminLte
     */
    private $adminlte;

    public function __construct(AdminLte $adminlte)
    {
        $this->adminlte = $adminlte;
    }

    public function compose(View $view)
    {
        $view->with('adminlte', $this->adminlte);
        $view->with('seller', $this->adminlte);
    }
}
