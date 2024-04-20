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
    protected $title = '店舗';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Restaurant());

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', '店舗名');
        $grid->column('category.name', 'カテゴリ');
        $grid->column('postal_code', '郵便番号');
        $grid->column('address', '住所');
        $grid->column('telephone', '電話番号');
        $grid->column('opening_time', '開店時間');
        $grid->column('closing_time', '閉店時間');
        $grid->column('days_closed', '定休日')->display(function ($daysClosed) {
            if (is_array($daysClosed)) {
                return implode(', ', $daysClosed);
            }
            // 配列でない場合は、元の値を返します
            return $daysClosed;
        });
        $grid->column('seating_capacity', '座席数')->sortable();
        $grid->column('recommend_flag', 'おすすめ')->sortable()->bool();
        $grid->column('created_at', '作成日時')->sortable();
        $grid->column('updated_at', '更新日時')->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');
            $filter->like('address', '店舗住所');
            $filter->like('description', '店舗説明');
            $filter->in('category_id', 'カテゴリ')->multipleSelect(Category::all()->pluck('name', 'id'));
            $filter->between('created_at', '作成日時')->datetime();
            $filter->equal('recommend_flag', 'おすすめ')->checkbox(['1' => '']);
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

        $show->field('id', 'ID');
        $show->field('images', '画像')->as(function ($images) {
            // 画像データをJSON形式からデコードし、それぞれの画像ファイルパスを取得
            $paths = json_decode($images, true);
            return array_map(function ($img) {
                return asset($img['file_path']);
            }, $paths);
        })->carousel();
        $show->field('name', '店舗名');
        $show->field('description', '説明');
        $show->field('category.name', 'カテゴリー');
        $show->field('postal_code', '郵便番号');
        $show->field('address', '住所');
        $show->field('telephone', '電話番号');
        $show->field('opening_time', '開店時間');
        $show->field('closing_time', '閉店時間');
        $show->field('days_closed', '定休日')->as(function ($daysClosed) {
            if (is_array($daysClosed)) {
                return implode(', ', $daysClosed);
            }
            // 配列でない場合は、元の値を返します
            return $daysClosed;
        });
        $show->field('seating_capacity', '座席数');
        $show->field('recommend_flag', 'おすすめ');
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
        $form = new Form(new Restaurant());
    
        $form->text('name', '店舗名')->rules('required|max:20', [
            'required' => '店舗名が必要です。',
            'max' => '店舗名は20文字以下である必要があります。',
        ]);
        $form->select('category_id', 'カテゴリ')
             ->options(Category::all()->pluck('name', 'id'))
             ->rules('required', [
            'required' => 'カテゴリが必要です。',
        ]);
        $form->text('postal_code', '郵便番号')->rules('required|regex:/^\d{3}-?\d{4}$/', [
            'required' => '郵便番号が必要です。',
            'regex' => '有効な郵便番号を入力してください。'
        ]);
        $form->text('address', '住所')->rules('required', [
            'required' => '住所が必要です。',
        ]);
        $form->mobile('telephone', '電話番号')
             ->options(['mask' => '999-999-9999'])
             ->rules('required', [
            'required' => '電話番号が必要です。',
        ]);
        $form->textarea('description', '説明')->rules('required|max:255', [
            'required' => '説明が必要です。',
            'max' => '説明は255文字以下である必要があります。',
        ]);
        $form->time('opening_time', '開店時間')
             ->format('HH:mm')
             ->default('11:00')
             ->rules('required', [
           'required' => '開店時間が必要です。',
        ]);
        $form->time('closing_time', '閉店時間')
             ->format('HH:mm')
             ->default('22:00')
             ->rules('required', [
           'required' => '閉店時間が必要です。',
        ]);
        $form->checkbox('days_closed', '定休日')
             ->options([
            '日' => '日曜日', 
            '月' => '月曜日',
            '火' => '火曜日',
            '水' => '水曜日',
            '木' => '木曜日',
            '金' => '金曜日',
            '土' => '土曜日',
        ]);
        $form->number('seating_capacity', '座席数')
             ->min(0)
             ->rules('required', [
            'required' => '座席数が必要です。',
        ]);
        $form->switch('recommend_flag', 'おすすめ');

        return $form;
    }
}
