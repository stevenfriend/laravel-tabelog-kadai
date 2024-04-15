<?php

namespace App\Admin\Controllers;

use App\Models\RestaurantImage;
use App\Models\Restaurant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RestaurantImageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RestaurantImage';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RestaurantImage());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('file_path', __('Restaurant image'))->image();
        $grid->column('restaurant_id', __('Restaurant id'))->sortable();
        $grid->column('restaurant.name', __('Restaurant id'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->in('restaurant_id', '店舗')->multipleSelect(Restaurant::all()->pluck('name', 'id'));
            $filter->like('restaurant.name', '店舗名');
            $filter->like('description', '画像説明');
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
        $show = new Show(RestaurantImage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('file_path', __('File path'))->image();
        $show->field('restaurant_id', __('Restaurant id'));
        $show->field('restaurant.name', __('Restaurant name'));
        $show->field('description', __('Description'));
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
        $form = new Form(new RestaurantImage());

        $form->select('restaurant_id', __('Restaurant'))->options(Restaurant::all()->pluck('name', 'id'));
        $form->image('file_path', __('File path'))
        ->move('img/uploads', function ($file) {
            // 一意のファイル名を生成する
            return date('Ym/d') . '/' . Str::random(40) . '.' . $file->guessExtension();
        })
        ->removable()
        ->uniqueName();
        $form->text('description', __('Description'));

        return $form;
    }
}
