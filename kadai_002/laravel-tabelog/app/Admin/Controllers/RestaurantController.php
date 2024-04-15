<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\RestaurantImage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RestaurantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Restaurant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Restaurant());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('category.name', __('Category name'));
        $grid->column('name', __('Name'));
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('description', __('Description'));
        $grid->column('opening_time', __('Opening time'));
        $grid->column('closing_time', __('Closing time'));
        $grid->column('days_closed', __('Days closed'));
        $grid->column('seating_capacity', __('Seating capacity'))->sortable();
        $grid->column('recommend_flag', __('Recommend flag'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');
            $filter->like('address', '店舗住所');
            $filter->like('description', '店舗説明');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
            $filter->equal('recommend_flag', 'おすすめフラグ')->select(['0' => 'false', '1' => 'true']);
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
        $show = new Show(Restaurant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('images', 'Images')->as(function ($images) {
            $paths = json_decode($images, true);
            return array_map(function ($img) {
                return asset($img['file_path']);
            }, $paths);
        })->carousel();
        $show->field('category.name', __('Category name'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('telephone', __('Telephone'));
        $show->field('description', __('Description'));
        $show->field('opening_time', __('Opening time'));
        $show->field('closing_time', __('Closing time'));
        $show->field('days_closed', __('Days closed'));
        $show->field('seating_capacity', __('Seating capacity'));
        $show->field('recommend_flag', __('Recommend flag'));
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
        $form = new Form(new Restaurant());

        $form->text('name', __('Name'));
        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->text('postal_code', __('Postal code'));
        $form->text('address', __('Address'));
        $form->text('telephone', __('Telephone'));
        $form->textarea('description', __('Description'));
        $form->timeRange('opening_time', 'closing_time', __('営業時間'))->default(date('H:i:s'));
        $form->checkbox('days_closed', __('Days closed'))->options([
            'Sunday' => '日', 
            'Monday' => '月',
            'Tuesday' => '火',
            'Wednesday' => '水',
            'Thursday' => '木',
            'Friday' => '金',
            'Saturday' => '土',
        ]);
        $form->number('seating_capacity', __('Seating capacity'));
        $form->switch('recommend_flag', __('Recommend flag'));

        return $form;
    }
}
