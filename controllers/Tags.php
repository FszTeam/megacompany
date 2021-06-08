<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use Lang;
use FszTeam\MegaCompany\Models\Tag;

/**
 * Tags Back-end Controller
 */
class Tags extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_services'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'tags');
    }

    /**
     * Deleted checked tags.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $tagId) {
                if (!$tag = Tag::find($tagId)) continue;
                $tag->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.tags.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.tags.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
