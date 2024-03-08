<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserpController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->model(User::class)
         ->whereHas('roles', function ($query) {
             $query->where('slug', 'peminjam');
         });

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('password', __('Password'));
        $grid->column('email', __('Email'));
        $grid->column('name', __('Name'));
        $grid->column('alamat', __('Alamat'));
        $grid->column('telp', __('Telp'));
        $grid->column('roles', trans('admin.roles'))->pluck('name')->label();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->export(function($export) {
            $export->originalValue(['status_pinjam']);
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

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('email', __('Email'));
        $show->field('name', __('Name'));
        $show->field('alamat', __('Alamat'));
        $show->field('telp', __('Telp'));
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
        $form = new Form(new User());

        $userTable = config('admin.database.users_table');
        $connection = config('admin.database.connection');

        $roleModel = config('admin.database.roles_model');

        $form->text('username', trans('admin.username'))
            ->creationRules(['required', "unique:{$connection}.{$userTable}"])
            ->updateRules(['required', "unique:{$connection}.{$userTable},username,{{id}}"]);

        $form->email('email', 'Gmail')
            ->creationRules(['required', "unique:{$connection}.{$userTable}"])
            ->updateRules(['required', "unique:{$connection}.{$userTable},email,{{id}}"]);

        $form->text('name', trans('admin.name'))->rules('required');
        $form->text('telp', 'No Telfon')->creationRules(['required']);
        $form->textarea('alamat', 'Alamat')->creationRules('required');
        // $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->ignore(['password_confirmation']);

        $form->select('roles', trans('admin.roles'))->options($roleModel::where('slug', 'peminjam')->pluck('name', 'id'));

        return $form;
    }
}
