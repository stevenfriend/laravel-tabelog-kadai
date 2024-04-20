<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'レビュー';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('restaurant_id', '店舗ID')->sortable();
        $grid->column('restaurant.name', '店舗名');
        $grid->column('user_id', '会員ID')->sortable();
        $grid->column('user.name', '会員名');
        $grid->column('title', 'タイトル');
        $grid->column('content', '内容');
        $grid->column('rating', '評価')->sortable();
        $grid->column('created_at', '作成日時')->sortable();
        $grid->column('updated_at', '更新日時')->sortable();

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

        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
        });

        $show->field('id', 'ID');
        $show->field('restaurant_id', '店舗ID');
        $show->field('restaurant.name', '店舗名');
        $show->field('user_id', '会員ID');
        $show->field('user.name', '会員名');
        $show->field('title', 'タイトル');
        $show->field('content', '内容');
        $show->field('rating', '評価');
        $show->field('created_at', '作成日時');
        $show->field('updated_at', '更新日時');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Review());

        return $form;
    }
}
