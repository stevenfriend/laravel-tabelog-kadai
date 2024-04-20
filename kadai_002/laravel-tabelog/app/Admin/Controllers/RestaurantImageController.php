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
    protected $title = '店舗の画像';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RestaurantImage());

        $grid->column('id', 'ID')->sortable();
        $grid->column('file_path', '画像')->image();
        $grid->column('restaurant_id', '店舗ID')->sortable();
        $grid->column('restaurant.name', '店舗名');
        $grid->column('description', '説明');
        $grid->column('created_at', '作成日時')->sortable();
        $grid->column('updated_at', '更新日時')->sortable();

        $grid->filter(function($filter) {
            $filter->like('restaurant.name', '店舗名')->multipleSelect(Restaurant::all()->pluck('name', 'id'));
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

        $show->field('id', 'ID');
        $show->field('file_path', '画像')->image();
        $show->field('restaurant_id', '店舗ID');
        $show->field('restaurant.name', '店舗名');
        $show->field('description', '説明');
        $show->field('created_at', '作成日時');
        $show->field('updated_at', '更新日時');

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

        $form->select('restaurant_id', '店舗')->options(Restaurant::all()->pluck('name', 'id'))             ->rules('required', [
            'required' => '店舗を選択してください。',
        ]);;
        $form->image('file_path', '画像')
             ->move('img/uploads', function ($file) {
                 // 一意のファイル名を生成する
                 return date('Ym/d') . '/' . Str::random(40) . '.' . $file->guessExtension();
             })
             ->removable()
             ->uniqueName()
             ->rules('required', [
                'required' => '画像が必要です。',
            ]);;
        $form->text('description', '説明');

        return $form;
    }
}
