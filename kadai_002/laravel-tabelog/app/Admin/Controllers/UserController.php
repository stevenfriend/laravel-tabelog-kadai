<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会員';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'お名前');
        $grid->column('furigana', 'フリガナ');
        $grid->column('email', 'メールアドレス');
        $grid->column('email_verified_at', 'メール認証済み')->sortable();
        $grid->column('telephone', '電話番号');
        $grid->column('created_at', '作成日時')->sortable();
        $grid->column('updated_at', '更新日時')->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '氏名');
            $filter->like('furigana', 'フリガナ');
            $filter->like('email', 'メールアドレス');
            $filter->in('subscriptions.stripe_status', '有料会員')->checkbox([
                'active'    => '有料会員',
            ]);

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
        $show = new Show(User::findOrFail($id));

        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
        });

        $show->field('id', 'ID');
        $show->field('name', 'お名前');
        $show->field('furigana', 'フリガナ');
        $show->field('email', 'メールアドレス');
        $show->field('email_verified_at', 'メール認証済み');
        $show->field('telephone', '電話番号');
        $show->field('created_at', '作成日時');
        $show->field('updated_at', '更新日時');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new User());

        return $form;
    }
}
