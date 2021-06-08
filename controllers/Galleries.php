<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use FszTeam\MegaCompany\Models\Gallery;
use Lang;

/**
 * Galleries Back-end Controller
 */
class Galleries extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_galleries'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'galleries');
    }

    /**
     * Deleted checked galleries.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $galleryId) {
                if (!$gallery = Gallery::find($galleryId)) {
                    continue;
                }

                $gallery->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.galleries.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.galleries.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
