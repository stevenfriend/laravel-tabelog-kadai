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
    protected $title = '予約';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reservation());

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('restaurant_id', '店舗ID')->sortable();
        $grid->column('restaurant.name', '店舗名');
        $grid->column('user_id', '会員ID')->sortable();
        $grid->column('user.name', '会員名');
        $grid->column('reservation_date', '予約日付')->sortable();
        $grid->column('reservation_time', '予約時間');
        $grid->column('number_of_people', '人数')->sortable();
        $grid->column('created_at', '作成日時')->sortable();
        $grid->column('updated_at', '更新日時')->sortable();

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

        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
        });

        $show->field('id', 'ID');
        $show->field('restaurant_id', '店舗ID');
        $show->field('restaurant.name', '店舗名');
        $show->field('user_id', '会員ID');
        $show->field('user.name', '会員名');
        $show->field('reservation_date', '予約日付');
        $show->field('reservation_time', '予約時間');
        $show->field('number_of_people', '人数');
        $show->field('created_at', '作成日時');
        $show->field('updated_at', '更新日時');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Reservation());

        return $form;
    }
}
