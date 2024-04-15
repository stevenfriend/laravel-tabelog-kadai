<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });

        $grid->column('id', __('ID'))->sortable();;
        $grid->column('restaurant_id', __('Restaurant id'))->sortable();
        $grid->column('restaurant.name', __('Restaurant name'));
        $grid->column('user_id', __('User id'))->sortable();
        $grid->column('user.name', __('User name'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('rating', __('Rating'))->sortable();;
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('restaurant.name', '店舗名');
            $filter->like('user.name', '会員氏名');
            $filter->between('rating', '評価');
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
        $show = new Show(Review::findOrFail($id));

        $show->panel()
        ->tools(function ($tools) {
            $tools->disableEdit();
        });

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('restaurant_id', __('Restaurant id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('rating', __('Rating'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
}
