<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use Lang;
use FszTeam\MegaCompany\Models\Link;

/**
 * Links Back-end Controller
 */
class Links extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_links'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'links');
    }

    /**
     * Deleted checked links.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $linkId) {
                if (!$link = Link::find($linkId)) continue;
                $link->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.links.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.links.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
