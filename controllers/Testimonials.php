<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use FszTeam\MegaCompany\Models\Testimonial;
use Lang;

/**
 * Testimonials Back-end Controller
 */
class Testimonials extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_testimonials'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'testimonials');
    }

    /**
     * Deleted checked testimonials.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $testimonialId) {
                if (!$testimonial = Testimonial::find($testimonialId)) {
                    continue;
                }

                $testimonial->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.testimonials.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.testimonials.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
