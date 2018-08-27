<?php

namespace Modules\Ibusiness\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIbusinessSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('ibusiness::businesses.single'), function (Item $item) {
                $item->icon('fa fa-building');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('ibusiness::businesses.title.businesses'), function (Item $item) {
                    $item->icon('fa fa-briefcase');
                    $item->weight(0);
                    $item->append('admin.ibusiness.business.create');
                    $item->route('admin.ibusiness.business.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibusiness.businesses.index')
                    );
                });
                $item->item(trans('ibusiness::userbusinesses.title.userbusinesses'), function (Item $item) {
                    $item->icon('fa fa-users');
                    $item->weight(0);
                    $item->append('admin.ibusiness.userbusiness.create');
                    $item->route('admin.ibusiness.userbusiness.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibusiness.userbusinesses.index')
                    );
                });
                $item->item(trans('ibusiness::orderapprovers.title.orderapprovers'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ibusiness.orderapprovers.create');
                    $item->route('admin.ibusiness.orderapprovers.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibusiness.orderapprovers.index')
                    );
                });
                $item->item(trans('ibusiness::businessproducts.title.businessproducts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ibusiness.businessproduct.create');
                    $item->route('admin.ibusiness.businessproduct.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibusiness.businessproducts.index')
                    );
                });
// append







            });
        });

        return $menu;
    }
}
