<?php namespace FszTeam\MegaCompany;

use Backend;
use Backend\Facades\BackendAuth;
use System\Classes\PluginBase;

/**
 * Employees Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.plugin.name',
            'description' => 'fszteam.megacompany::lang.plugin.description',
            'author' => 'FszTeam',
            'icon' => 'icon-building',
        ];
    }

    public function registerNavigation()
    {
        return [
            'megacompany' => [
                'label' => 'fszteam.megacompany::lang.plugin.name',
                'url' => Backend::url('fszteam/megacompany/' . $this->startPage()),
                'icon' => 'icon-building',
                'permissions' => ['fszteam.megacompany.*'],
                'order' => 500,
                'sideMenu' => [
                    'employees' => [
                        'label' => 'fszteam.megacompany::lang.employees.menu_label',
                        'icon' => 'icon-user',
                        'url' => Backend::url('fszteam/megacompany/employees'),
                        'permissions' => ['fszteam.megacompany.access_employees'],
                    ],
                    'roles' => [
                        'label' => 'fszteam.megacompany::lang.roles.menu_label',
                        'icon' => 'icon-briefcase',
                        'url' => Backend::url('fszteam/megacompany/roles'),
                        'permissions' => ['fszteam.megacompany.access_employees'],
                    ],
                    'projects' => [
                        'label' => 'fszteam.megacompany::lang.projects.menu_label',
                        'icon' => 'icon-wrench',
                        'url' => Backend::url('fszteam/megacompany/projects'),
                        'permissions' => ['fszteam.megacompany.access_projects'],
                    ],
                    'services' => [
                        'label' => 'fszteam.megacompany::lang.services.menu_label',
                        'icon' => 'icon-certificate',
                        'url' => Backend::url('fszteam/megacompany/services'),
                        'permissions' => ['fszteam.megacompany.access_services'],
                    ],
                    'galleries' => [
                        'label' => 'fszteam.megacompany::lang.galleries.menu_label',
                        'icon' => 'icon-photo',
                        'url' => Backend::url('fszteam/megacompany/galleries'),
                        'permissions' => ['fszteam.megacompany.access_galleries'],
                    ],
                    'testimonials' => [
                        'label' => 'fszteam.megacompany::lang.testimonials.menu_label',
                        'icon' => 'icon-comment',
                        'url' => Backend::url('fszteam/megacompany/testimonials'),
                        'permissions' => ['fszteam.megacompany.access_testimonials'],
                    ],
                    'links' => [
                        'label' => 'fszteam.megacompany::lang.links.menu_label',
                        'icon' => 'icon-link',
                        'url' => Backend::url('fszteam/megacompany/links'),
                        'permissions' => ['fszteam.megacompany.access_links'],
                    ],
                    'categories' => [
                        'label' => 'fszteam.megacompany::lang.categories.menu_label',
                        'icon' => 'oc-icon-folder-open-o',
                        'url' => Backend::url('fszteam/megacompany/categories'),
                        'permissions' => ['fszteam.megacompany.access_links'],
                    ],                    
                    'tags' => [
                        'label' => 'fszteam.megacompany::lang.tags.menu_label',
                        'icon' => 'icon-tag',
                        'url' => Backend::url('fszteam/megacompany/tags'),
                        'permissions' => ['fszteam.megacompany.access_tags'],
                    ],
                ],
            ],
        ];
    }

    public function startPage($page = 'projects')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));
        if (!isset($user->permissions['superuser']) && $user->hasAccess('fszteam.megacompany.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        return $page;
    }

    public function registerPermissions()
    {
        return [
            'fszteam.megacompany.access_employees' => [
                'label' => 'fszteam.megacompany::lang.employee.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_projects' => [
                'label' => 'fszteam.megacompany::lang.project.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_services' => [
                'label' => 'fszteam.megacompany::lang.service.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_galleries' => [
                'label' => 'fszteam.megacompany::lang.gallery.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_links' => [
                'label' => 'fszteam.megacompany::lang.link.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_testimonials' => [
                'label' => 'fszteam.megacompany::lang.testimonial.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_tags' => [
                'label' => 'fszteam.megacompany::lang.tag.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_categories' => [
                'label' => 'fszteam.megacompany::lang.category.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
            'fszteam.megacompany.access_company' => [
                'label' => 'fszteam.megacompany::lang.megacompany.list_title',
                'tab' => 'fszteam.megacompany::lang.plugin.name',
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'FszTeam\MegaCompany\Components\Employees' => 'Employees',
            'FszTeam\MegaCompany\Components\Roles' => 'Roles',
            'FszTeam\MegaCompany\Components\Projects' => 'Projects',
            'FszTeam\MegaCompany\Components\Services' => 'Services',
            'FszTeam\MegaCompany\Components\Galleries' => 'Galleries',
            'FszTeam\MegaCompany\Components\MegaCompany' => 'MegaCompany',
            'FszTeam\MegaCompany\Components\Testimonials' => 'Testimonials',
            'FszTeam\MegaCompany\Components\Links' => 'Links',
            'FszTeam\MegaCompany\Components\Tags' => 'Tags',
            'FszTeam\MegaCompany\Components\Categories' => 'Categories',
            'FszTeam\MegaCompany\Components\Service' => 'Service',
            'FszTeam\MegaCompany\Components\Project' => 'Project',
            'FszTeam\MegaCompany\Components\Employee' => 'Employee',
            'FszTeam\MegaCompany\Components\GoogleMap' => 'GoogleMap',
        ];
    }

    public function registerSettings()
    {
        return [
            'megacompany' => [
                'label' => 'fszteam.megacompany::lang.plugin.name',
                'description' => 'fszteam.megacompany::lang.settings.description',
                'category' => 'system::lang.system.categories.system',
                'icon' => 'icon-building-o',
                'class' => 'FszTeam\MegaCompany\Models\MegaCompany',
                'order' => 500,
                'keywords' => 'fszteam.megacompany::lang.settings.label',
                'permissions' => ['fszteam.megacompany.access_company'],
            ],
        ];
    }

    public function register()
    {
        set_exception_handler([$this, 'handleException']);
    }

    public function handleException($e)
    {
        if (!$e instanceof Exception) {
            $e = new \Symfony\Component\Debug\Exception\FatalThrowableError($e);
        }
        $handler = $this->app->make('Illuminate\Contracts\Debug\ExceptionHandler');
        $handler->report($e);
        if ($this->app->runningInConsole()) {
            $handler->renderForConsole(new ConsoleOutput, $e);
        } else {
            $handler->render($this->app['request'], $e)->send();
        }
    }
}
