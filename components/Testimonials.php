<?php namespace FszTeam\MegaCompany\Components;

use FszTeam\MegaCompany\Models\Testimonial;

class Testimonials extends Component
{
    public $table = 'fszteam_company_testimonials';

    public function componentDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.components.testimonials.name',
            'description' => 'fszteam.megacompany::lang.components.testimonials.description',
        ];
    }

    public function onRun()
    {
        
        $this->page['testimonial'] = $this->testimonial();
        $this->page['testimonials'] = $this->testimonials();

        $this->addCss('/plugins/fszteam/megacompany/assets/testimonials/css/testimonial-slider.css');
        $this->addJs('/plugins/fszteam/megacompany/assets/testimonials/js/testimonial-slider.js');
    }

    public function testimonial()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Testimonial::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture')
                ->first();
        }
    }

    public function testimonials()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;
            $testimonials = Testimonial::published()
                ->with('picture')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $testimonials->paginate($this->property('perPage'), $this->property('page')) :
                $testimonials->get();
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();

        $properties['modelIdentifier'] = [
            'title' => 'fszteam.megacompany::lang.misc.model_identifier',
            'description' => 'fszteam.megacompany::lang.descriptions.model_identifier',
            'type' => 'dropdown',
            'options' => ['id' => 'id'],
            'default' => 'id',
        ];
        $properties['backgroundColor'] = [
             'title'             => 'Background color',
             'description'       => 'HEX code value',
             'default'           => '#1b2945',
             'type'              => 'string',
             'validationPattern' => '^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$',
             'validationMessage' => 'Please fill in a valid hex code with the #'
        ];
        $properties['textColor'] = [
             'title'             => 'Text color',
             'description'       => 'HEX code value',
             'default'           => '#3db166',
             'type'              => 'string',
             'validationPattern' => '^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$',
             'validationMessage' => 'Please fill in a valid hex code with the #'
        ];
        return $properties;
    }
}
