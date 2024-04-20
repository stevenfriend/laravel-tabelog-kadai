<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'カテゴリ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'カテゴリ名');
        $grid->column('created_at', '作成日時')->sortable();
        $grid->column('updated_at', '更新日時')->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', 'カテゴリ名');
            $filter->between('created_at', '作成日時')->datetime();
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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', 'カテゴリー名');
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
        $form = new Form(new Category());

        $form->text('name', 'カテゴリー名')->rules('required|max:20|unique:categories,name', [
            'required' => 'カテゴリ名が必要です。',
            'max' => 'カテゴリ名は20文字以下である必要があります。',
            'unique' => 'カテゴリ名は一意でなければなりません。'
        ]);
        
        return $form;
    }
}
