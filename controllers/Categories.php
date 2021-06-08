<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use Lang;
use FszTeam\MegaCompany\Models\Category;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_services'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'categories');
    }

    /**
     * Deleted checked categories.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $categoryId) {
                if (!$category = Category::find($categoryId)) continue;
                $category->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.categories.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.categories.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
