<?php

namespace App\Admin\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReservationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reservation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reservation());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('reservation_date', __('Reservation date'))->sortable();
        $grid->column('reservation_time', __('Reservation time'));
        $grid->column('restaurant_id', __('Restaurant id'))->sortable();
        $grid->column('restaurant.name', __('Restaurant name'));
        $grid->column('number_of_people', __('Number of people'))->sortable();
        $grid->column('user.name', __('User'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('restaurant.name', '店舗名');
            $filter->like('user.name', '会員名');
            $filter->between('reservation_date', '予約日付');
            $filter->between('created_at', '作成日時');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Reservation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('reservation_date', __('Reservation date'));
        $show->field('reservation_time', __('Reservation time'));
        $show->field('number_of_people', __('Number of people'));
        $show->field('restaurant_id', __('Restaurant id'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Reservation());

        $form->date('reservation_date', __('Reservation date'))->default(date('Y-m-d'));
        $form->time('reservation_time', __('Reservation time'))->default(date('H:i:s'));
        $form->number('number_of_people', __('Number of people'));

        return $form;
    }
}
